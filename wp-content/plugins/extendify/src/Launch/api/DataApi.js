import { useUserSelectionStore } from '@launch/state/UserSelections';
import { PATTERNS_HOST, AI_HOST } from '../../constants';
import { getHeadersAndFooters } from './WPApi';
import { Axios as api } from './axios';

export const getUserSelectionData = () => api.get('launch/user-selection-data');
export const saveUserSelectionData = (data) =>
	api.post('launch/user-selection-data', { data });

const fetchTemplates = async (type, siteType) => {
	const { wpLanguage, wpVersion, showLocalizedCopy } = window.extOnbData;
	const { goals, plugins } = useUserSelectionStore.getState();
	const url = new URL(`${PATTERNS_HOST}/api/${type}-templates`);
	url.searchParams.append('siteType', siteType?.slug);
	wpVersion && url.searchParams.append('wpVersion', wpVersion);
	wpLanguage && url.searchParams.append('lang', wpLanguage);
	goals?.length && url.searchParams.append('goals', JSON.stringify(goals));
	plugins?.length &&
		url.searchParams.append('plugins', JSON.stringify(plugins));
	showLocalizedCopy && url.searchParams.append('showLocalizedCopy', true);
	const res = await fetch(url.toString(), {
		headers: { 'Content-Type': 'application/json' },
	});
	if (!res.ok) throw new Error('Bad response from server');
	return await res.json();
};

export const getHomeTemplates = async (siteType) => {
	const styles = await fetchTemplates('home', siteType);
	const { headers, footers } = await getHeadersAndFooters();
	if (!styles?.length) {
		throw new Error('Could not get styles');
	}
	return styles.map(({ id, patterns }, index) => {
		// Cycle through the headers and footers
		const header = headers[index % headers.length];
		const footer = footers[index % footers.length];
		return {
			id,
			code: patterns.map(({ code }) => code).flat(),
			headerCode: header?.content?.raw?.trim() ?? '',
			footerCode: footer?.content?.raw?.trim() ?? '',
		};
	});
};
export const getPageTemplates = async (siteType) => {
	const pages = await fetchTemplates('page', siteType);
	if (!pages?.recommended) {
		throw new Error('Could not get pages');
	}
	return {
		recommended: pages.recommended.map(({ slug, ...rest }) => ({
			...rest,
			slug,
			id: slug,
		})),
		optional: pages.optional.map(({ slug, ...rest }) => ({
			...rest,
			slug,
			id: slug,
		})),
	};
};

export const getGoals = async () => {
	const goals = await api.get('launch/goals');
	if (!goals?.data) {
		throw new Error('Could not get goals');
	}
	return goals.data;
};
export const getSuggestedPlugins = async () => {
	const suggested = await api.get('launch/suggested-plugins');
	if (!suggested?.data) {
		throw new Error('Could not get suggested plugins');
	}
	return suggested.data;
};

// Optionally add items to request body
const allowList = [
	'partnerId',
	'devbuild',
	'version',
	'siteId',
	'wpLanguage',
	'wpVersion',
];
const extraBody = {
	...Object.fromEntries(
		Object.entries(window.extOnbData).filter(([key]) =>
			allowList.includes(key),
		),
	),
};

export const generateCustomPatterns = async (page, userState) => {
	const res = await fetch(`${AI_HOST}/api/patterns`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({
			...extraBody,
			page,
			userState,
		}),
	});

	if (!res.ok) throw new Error('Bad response from server');
	return await res.json();
};

export const pingServer = () => api.get('launch/ping');
