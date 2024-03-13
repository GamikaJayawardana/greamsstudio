import { create } from 'zustand';
import { persist, devtools, createJSONStorage } from 'zustand/middleware';
import {
	getUserSelectionData,
	saveUserSelectionData,
} from '@launch/api/DataApi';

const key = `extendify-site-selection-${window.extOnbData.siteId}`;
const defaultState = {
	siteType: {},
	siteInformation: {
		title: undefined,
	},
	businessInformation: {
		description: undefined,
		tones: [],
		acceptTerms: false,
	},
	// for somewhat legacy reasons, this includes the home page, header,
	// and footer code + the style (variation)
	style: null,
	pages: undefined,
	plugins: undefined,
	goals: undefined,
};
const initialState = {
	...defaultState,
	siteTypeSearch: [],
	...(JSON.parse(localStorage.getItem(key) || '{}')?.state ?? {}),
};

const state = (set, get) => ({
	...initialState,
	setSiteType(siteType) {
		// Reset the user's selections when site type changes
		set({ ...defaultState, siteType });
	},
	setSiteTypeSearch(search) {
		set((state) => ({
			// only keep last 10 searches
			siteTypeSearch: [...state.siteTypeSearch, search].slice(-10),
		}));
	},
	setSiteInformation(name, value) {
		const siteInformation = { ...get().siteInformation, [name]: value };
		set({ siteInformation });
	},
	setBusinessInformation(name, value) {
		const businessInformation = { ...get().businessInformation, [name]: value };
		set({ businessInformation });
	},
	has(type, item) {
		if (!item?.id) return false;
		return (get()?.[type] ?? [])?.some((t) => t.id === item.id);
	},
	add(type, item) {
		if (get().has(type, item)) return;
		set({ [type]: [...(get()?.[type] ?? []), item] });
	},
	addMany(type, items, options = {}) {
		if (options.clearExisting) {
			set({ [type]: items });
			return;
		}
		set({ [type]: [...(get()?.[type] ?? []), ...items] });
	},
	remove(type, item) {
		set({ [type]: get()?.[type]?.filter((t) => t.id !== item.id) });
	},
	removeMany(type, items) {
		set({
			[type]: get()?.[type]?.filter((t) => !items.some((i) => i.id === t.id)),
		});
	},
	toggle(type, item) {
		if (get().has(type, item)) {
			get().remove(type, item);
			return;
		}
		get().add(type, item);
	},
	setStyle(style) {
		set({ style });
	},
	canLaunch() {
		// The user can launch if they have a complete selection
		return (
			Object.keys(get()?.siteType ?? {})?.length > 0 &&
			Object.keys(get()?.style ?? {})?.length > 0
		);
	},
	resetState() {
		set(defaultState);
	},
});

const storage = {
	getItem: async () => JSON.stringify(await getUserSelectionData()),
	setItem: async (k, value) => {
		localStorage.setItem(k, value);
		// Stash here so we can use it on reload optimistically
		await saveUserSelectionData(value);
	},
	removeItem: () => undefined,
};

export const useUserSelectionStore = create(
	persist(devtools(state, { name: 'Extendify User Selection' }), {
		name: key,
		storage: createJSONStorage(() => storage),
	}),
	state,
);
