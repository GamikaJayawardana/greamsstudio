import { generateCustomPatterns } from '@launch/api/DataApi';
import {
	updateOption,
	createPage,
	updateThemeVariation,
} from '@launch/api/WPApi';

export const createWordpressPages = async (pages) => {
	const pageIds = {};

	for (const page of pages) {
		pageIds[page.slug] = await createPage({
			title: page.name,
			status: 'publish',
			content: page.patterns?.map(({ code }) => code)?.join(''),
			template: 'no-title',
			meta: { made_with_extendify_launch: true },
		});
	}

	// When we have home, set reading setting
	if (pageIds?.home) {
		await updateOption('show_on_front', 'page');
		await updateOption('page_on_front', pageIds.home.id);
	}
	// When we have blog, set reading setting
	if (pageIds?.blog) {
		await updateOption('page_for_posts', pageIds.blog.id);
	}

	return pageIds;
};

const createWordpressPage = async (page) => {
	const pageId = {};

	pageId[page.slug] = await createPage({
		title: page.name,
		status: 'publish',
		content: page.patterns?.map(({ code }) => code)?.join(''),
		template: 'no-title',
		meta: { made_with_extendify_launch: true },
	});

	// When we have home, set reading setting
	if (pageId?.home) {
		await updateOption('show_on_front', 'page');
		await updateOption('page_on_front', pageId.home.id);
	}
	// When we have blog, set reading setting
	if (pageId?.blog) {
		await updateOption('page_for_posts', pageId.blog.id);
	}

	return pageId;
};

export const createPages = async (pages, userState) => {
	// Either didn't see the ai copy page or skipped it
	if (!userState.businessInformation.description) {
		return await createWordpressPages(pages);
	}

	const { siteId, partnerId, wpLanguage, wpVersion } = window.extOnbData;
	return (
		(
			await Promise.allSettled(
				pages.map((page) =>
					generateCustomPatterns(page, {
						...userState,
						siteId,
						partnerId,
						siteVersion: wpVersion,
						language: wpLanguage,
					})
						.then((response) => createWordpressPage(response))
						.catch(() => createWordpressPage(page)),
				),
			)
		)
			?.filter((page) => page.value)
			// Transform data back into object from array of pages
			// from `[{ value: { services: {} } }, { value: { home: {} } }]`
			// to   `{ services: {}, home: {} }`
			?.reduce((acc, page) => ({ ...acc, ...page.value }), {})
	);
};

export const updateGlobalStyleVariant = (variation) =>
	updateThemeVariation(window.extOnbData.globalStylesPostID, variation);
