import { useEffect, useState } from '@wordpress/element';
import { useGlobalStore } from '@launch/state/Global';
import { usePagesStore } from '@launch/state/Pages';
import { useUserSelectionStore } from '@launch/state/UserSelections';
import { INSIGHTS_HOST } from '../../constants';

// Dev note: This entire section is opt-in only when partnerID is set as a constant
export const useTelemetry = () => {
	const {
		goals,
		pages: selectedPages,
		plugins: selectedPlugins,
		siteType,
		style: selectedStyle,
		siteTypeSearch,
	} = useUserSelectionStore();
	const { generating } = useGlobalStore();
	const { pages, currentPageIndex } = usePagesStore();
	const [stepProgress, setStepProgress] = useState([]);
	const [viewedStyles, setViewedStyles] = useState(new Set());

	useEffect(() => {
		const p = [...pages].map((p) => p[0]);
		// Add pages as they move around
		setStepProgress((progress) =>
			progress?.at(-1) === p[currentPageIndex]
				? progress
				: [...progress, p[currentPageIndex]],
		);
	}, [currentPageIndex, pages]);

	useEffect(() => {
		if (!generating) return;
		// They pressed Launch
		setStepProgress((progress) => [...progress, 'launched']);
	}, [generating]);

	useEffect(() => {
		if (!Object.keys(selectedStyle ?? {})?.length) return;
		// Add selectedStyle to the set
		setViewedStyles((styles) => {
			const newStyles = new Set(styles);
			newStyles.add(selectedStyle);
			return newStyles;
		});
	}, [selectedStyle]);

	useEffect(() => {
		let id = 0;
		let innerId = 0;
		const timeout = currentPageIndex ? 1000 : 0;
		id = window.setTimeout(() => {
			const controller = new AbortController();
			innerId = window.setTimeout(() => {
				controller.abort();
			}, 900);
			fetch(`${INSIGHTS_HOST}/api/v1/launch`, {
				method: 'POST',
				headers: {
					'Content-type': 'application/json',
					Accept: 'application/json',
					'X-Extendify': 'true',
				},
				signal: controller.signal,
				body: JSON.stringify({
					siteType: siteType.slug,
					siteCreatedAt: window.extOnbData?.siteCreatedAt,
					style: selectedStyle?.variation?.title,
					pages: selectedPages?.map((p) => p.slug),
					goals: goals?.map((g) => g.slug),
					lastCompletedStep: stepProgress?.at(-1),
					progress: stepProgress,
					stylesViewed: [...viewedStyles]
						.filter((s) => s?.variation)
						.map((s) => s.variation.title),
					siteTypeSearches: siteTypeSearch,
					insightsId: window.extOnbData?.siteId,
					activeTests:
						window.extOnbData?.activeTests?.length > 0
							? JSON.stringify(window.extOnbData?.activeTests)
							: undefined,
					hostPartner: window.extOnbData?.partnerId,
					language: window.extOnbData?.wpLanguage,
					siteURL: window.extOnbData?.home,
				}),
			}).catch(() => undefined);
		}, timeout);
		return () => [id, innerId].forEach((i) => window.clearTimeout(i));
	}, [
		selectedPages,
		selectedPlugins,
		selectedStyle,
		pages,
		stepProgress,
		viewedStyles,
		siteTypeSearch,
		currentPageIndex,
		goals,
		siteType,
	]);
};
