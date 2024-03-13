import { __ } from '@wordpress/i18n';
import { AI_HOST } from '../../constants.js';

// Additional data to send with requests
const allowList = [
	'siteId',
	'partnerId',
	'wpVersion',
	'wpLanguage',
	'devbuild',
	'isBlockTheme',
	'showAIConsent',
	'userGaveConsent',
	'userId',
	'globalState',
];
const extraBody = {
	...Object.fromEntries(
		Object.entries(window.extDraftData).filter(([key]) =>
			allowList.includes(key),
		),
	),
};

export const completion = async (
	prompt,
	promptType,
	systemMessageKey,
	details,
) => {
	const response = await fetch(`${AI_HOST}/api/draft/completion`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({
			prompt,
			promptType,
			systemMessageKey,
			details,
			...extraBody,
		}),
	});

	if (!response.ok) {
		if (response.status === 429) {
			throw new Error(__('Service temporarily unavailable', 'extendify-local'));
		}
		throw new Error(`Server error: ${response.status}`);
	}

	return response;
};
