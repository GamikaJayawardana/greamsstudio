import useSWRInfinite from 'swr/infinite';
import { PATTERNS_HOST } from '../../constants';

const fetcher = (url) => fetch(url).then((res) => res.json());

export const usePatterns = (incomingParams) => {
	const params = {
		siteType: undefined,
		category: undefined,
		wpVersion: window.extLibraryData.wpVersion,
		lang: window.extLibraryData.wpLanguage || null,
		showLocalizedCopy: window.extLibraryData.showLocalizedCopy || null,
		...incomingParams,
	};

	const getKey = (pageIndex, previousPageData) => {
		if (!params.category) return null;
		if (previousPageData && !previousPageData.length) return null;

		const urlParams = new URLSearchParams({ page: pageIndex + 1 });

		Object.entries(params)
			.filter(([, value]) => value !== undefined)
			.forEach(([key, value]) => {
				urlParams.append(key, value);
			});

		return `${PATTERNS_HOST}/api/patterns?${urlParams.toString()}`;
	};

	const { data, error, isLoading, isValidating, mutate, size, setSize } =
		useSWRInfinite(getKey, fetcher, {
			initialSize: 2,
			revalidateFirstPage: false,
			revalidateIfStale: false,
			revalidateOnFocus: false,
			revalidateOnReconnect: false,
		});

	return {
		data,
		error,
		isLoading,
		isValidating,
		mutate,
		size,
		setSize,
	};
};
