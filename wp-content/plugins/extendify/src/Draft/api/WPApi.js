import apiFetch from '@wordpress/api-fetch';

export const updateUserMeta = (user, option, value) =>
	apiFetch({
		path: '/extendify/v1/draft/update-user-meta',
		method: 'POST',
		data: { user, option, value },
	});
