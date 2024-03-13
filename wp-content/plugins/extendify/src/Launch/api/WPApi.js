import { __ } from '@wordpress/i18n';
import { Axios as api } from './axios';

const wpRoot = window.extOnbData.wpRoot;

export const updateOption = (option, value) =>
	api.post('launch/options', { option, value });

export const getOption = async (option) => {
	const { data } = await api.get('launch/options', {
		params: { option },
	});
	return data;
};

export const createPage = (pageData) =>
	api.post(`${wpRoot}wp/v2/pages`, pageData);

export const getPageById = (pageId) =>
	api.get(`${wpRoot}wp/v2/pages/${pageId}`);

export const installPlugin = async (plugin) => {
	// Fail silently if no slug is provided
	if (!plugin?.wordpressSlug) return;

	try {
		// Install plugin and try to activate it.
		const response = await api.post(`${wpRoot}wp/v2/plugins`, {
			slug: plugin.wordpressSlug,
			status: 'active',
		});
		if (!response.ok) return response;
	} catch (e) {
		// Fail gracefully for now
	}

	try {
		// Try and activate it if the above fails
		return await activatePlugin(plugin);
	} catch (e) {
		// Fail gracefully for now
	}
};

export const activatePlugin = async (plugin) => {
	const endpoint = new URL(`${wpRoot}wp/v2/plugins`);
	const params = new URLSearchParams(endpoint.searchParams);
	params.set('search', plugin.wordpressSlug);
	endpoint.search = params.toString();
	const response = await api.get(endpoint.toString());
	const pluginSlug = response?.[0]?.plugin;
	if (!pluginSlug) {
		throw new Error('Plugin not found');
	}
	// Attempt to activate the plugin with the slug we found
	return await api.post(`${wpRoot}wp/v2/plugins/${pluginSlug}`, {
		status: 'active',
	});
};

export const updateTemplatePart = (part, content) =>
	api.post(`${wpRoot}wp/v2/template-parts/${part}`, {
		slug: `${part}`,
		theme: 'extendable',
		type: 'wp_template_part',
		status: 'publish',
		// See: https://github.com/extendify/company-product/issues/833#issuecomment-1804179527
		// translators: Launch is the product name. Unless otherwise specified by the glossary, do not translate this name.
		description: __('Added by Launch', 'extendify-local'),
		content,
	});

const allowedHeaders = [
	'header',
	'header-with-center-nav-and-social',
	'header-title-social-nav',
];
const allowedFooters = [
	'footer',
	'footer-social-icons',
	'footer-with-center-logo-and-menu',
];

export const getHeadersAndFooters = async () => {
	let patterns = await getTemplateParts();
	patterns = patterns?.filter((p) => p.theme === 'extendable');
	const headers = patterns?.filter((p) => allowedHeaders.includes(p?.slug));
	const footers = patterns?.filter((p) => allowedFooters.includes(p?.slug));
	return { headers, footers };
};

const getTemplateParts = () => api.get(wpRoot + 'wp/v2/template-parts');

export const getThemeVariations = async () => {
	const variations = await api.get(
		wpRoot + 'wp/v2/global-styles/themes/extendable/variations',
	);
	if (!Array.isArray(variations)) {
		throw new Error('Could not get theme variations');
	}
	// Randomize
	return [...variations].sort(() => Math.random() - 0.5);
};

export const updateThemeVariation = (id, variation) =>
	api.post(`${wpRoot}wp/v2/global-styles/${id}`, {
		id,
		settings: variation.settings,
		styles: variation.styles,
	});

export const addLaunchPagesToNav = (
	pages,
	pageIds,
	rawCode,
	replace = null,
) => {
	if (!replace)
		replace =
			/(<!--\s*wp:navigation\b[^>]*>)([^]*?)(<!--\s*\/wp:navigation\s*-->)/gi;

	const pageListItems = pages
		.filter((page) => Boolean(pageIds[page.slug]?.id))
		.filter(({ slug }) => slug !== 'home')
		.map((page) => {
			const { id, title, link, type } = pageIds[page.slug];
			return `<!-- wp:navigation-link { "label":"${title.rendered}", "type":"${type}", "id":"${id}", "url":"${link}", "kind":"post-type", "isTopLevelLink":true } /-->`;
		})
		.join('');
	return rawCode.replace(replace, `$1${pageListItems}$3`);
};

export const getActivePlugins = () => api.get('launch/active-plugins');

export const prefetchAssistData = async () =>
	await api.get('launch/prefetch-assist-data');
