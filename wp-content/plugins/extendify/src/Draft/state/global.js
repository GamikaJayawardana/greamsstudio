import apiFetch from '@wordpress/api-fetch';
import { create } from 'zustand';
import { devtools, persist, createJSONStorage } from 'zustand/middleware';

const path = '/extendify/v1/draft/user-settings';
const storage = {
	getItem: async () => await apiFetch({ path }),
	setItem: async (_name, state) =>
		await apiFetch({ path, method: 'POST', data: { state } }),
};
// Values added here should also be added to Admin.php ln ~200
const startingState = {};
const store = () => ({
	...startingState,
	...(window.extDraftData?.globalState?.state ?? {}),
});
const withDevtools = devtools(store, { name: 'Extendify Draft Globals' });
const withPersist = persist(withDevtools, {
	name: 'extendify_draft_settings',
	storage: createJSONStorage(() => storage),
	skipHydration: true,
});
export const useGlobalStore = create(withPersist);
