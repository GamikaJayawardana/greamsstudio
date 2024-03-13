import apiFetch from '@wordpress/api-fetch';
import { create } from 'zustand';
import { persist, createJSONStorage } from 'zustand/middleware';

const path = '/extendify/v1/library/settings';
const storage = {
	getItem: async () => await apiFetch({ path }),
	setItem: async (_name, state) =>
		await apiFetch({ path, method: 'POST', data: { state } }),
};

const startingState = {
	siteType: {},
	category: '',
	totalImports: 0,
};

export const useSiteSettingsStore = create(
	persist(
		(set) => ({
			...startingState,
			...(window.extLibraryData?.siteInfo?.state ?? {}),
			setSiteType: async (siteType) => {
				set({ siteType });
				await apiFetch({
					path: `${path}/single`,
					method: 'POST',
					data: {
						key: 'extendify_siteType',
						value: siteType,
					},
				});
			},
			setCategory: (category) => set({ category }),
			incrementImports: () =>
				set((state) => ({ totalImports: state.totalImports + 1 })),
		}),
		{
			name: 'extendify_library_site_data',
			storage: createJSONStorage(() => storage),
			skipHydration: true,
		},
	),
);
