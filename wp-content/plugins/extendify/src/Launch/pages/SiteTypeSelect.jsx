import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { updateOption } from '@launch/api/WPApi';
import { LoadingIndicator } from '@launch/components/LoadingIndicator';
import { Title } from '@launch/components/Title';
import { useSiteTypes } from '@launch/hooks/useSiteTypes';
import { PageLayout } from '@launch/layouts/PageLayout';
import { usePagesStore } from '@launch/state/Pages';
import { useUserSelectionStore } from '@launch/state/UserSelections';
import { pageState } from '@launch/state/factory';
import { Checkmark, RightCaret } from '@launch/svg';

export const state = pageState('Site Industry', () => ({
	title: __('Site Industry', 'extendify-local'),
	showInSidebar: true,
	ready: false,
}));

export const SiteTypeSelect = () => {
	const { loading } = useUserSelectionStore();
	return (
		<PageLayout>
			<div className="grow px-6 py-8 md:py-16 md:px-32 overflow-y-scroll">
				<Title
					title={__('What is your WordPress site about?', 'extendify-local')}
					description={__(
						'We will help you create your WordPress website quickly.',
						'extendify-local',
					)}
				/>
				<div className="w-full relative max-w-xl mx-auto">
					{loading ? <LoadingIndicator /> : <SiteTypeSelector />}
				</div>
			</div>
		</PageLayout>
	);
};

const SiteTypeSelector = () => {
	const { nextPage } = usePagesStore();
	const { siteType, setSiteType, setSiteTypeSearch } = useUserSelectionStore();
	const [search, setSearch] = useState('');
	const [searchDebounced, setSearchDebounced] = useState('');
	const { data, loading } = useSiteTypes(searchDebounced);
	const { siteTypes } = data ?? {};

	const handleSetSiteType = ({ slug, name, language }) => {
		nextPage();
		setSiteType({ slug, name, language });
		updateOption('extendify_siteType', { slug, name, language });
	};

	useEffect(() => {
		state.setState({ ready: !!siteType?.slug });
	}, [siteType]);

	useEffect(() => {
		if (!search) return;
		// Fetch data after 300ms but wait 1s to set the search history
		const timer = setTimeout(() => setSearchDebounced(search), 300);
		const timer2 = setTimeout(() => setSiteTypeSearch(search), 1000);
		return () => {
			clearTimeout(timer);
			clearTimeout(timer2);
		};
	}, [search, setSiteTypeSearch]);

	return (
		<>
			<div className="relative">
				<input
					autoFocus
					data-test="site-type-search"
					className="w-full h-14 px-4 m-0 input-focus ring-offset-0 focus:bg-white relative z-20 rounded border border-gray-300 shadow-sm outline-none"
					autoComplete="off"
					spellCheck={false}
					placeholder={__('Search for your business type', 'extendify-local')}
					onChange={(event) => setSearch(event.target.value)}
				/>
			</div>
			{loading && search && (
				<div className="mt-5 text-sm">
					{__('Searching...', 'extendify-local')}
				</div>
			)}
			<div className="mt-5 flex flex-col gap-3" data-test="site-type-list">
				{siteType?.name && (!loading || !search) && (
					<div
						className={
							'group gap-2 flex justify-between items-center py-2.5 px-3 text-base relative overflow-hidden border border-gray-200 rounded bg-gray-100 transition-all duration-100 ease-in-out'
						}>
						{siteType.name}
						<Checkmark className="h-5 w-5" />
					</div>
				)}
				{siteTypes?.map((item) => (
					<button
						key={item.id}
						type="button"
						className={
							'group gap-2 flex justify-between items-center py-2.5 px-3 text-base bg-gray-50 relative overflow-hidden border border-gray-200 rounded cursor-pointer hover:bg-gray-100 transition-all duration-100 ease-in-out'
						}
						onClick={() => handleSetSiteType(item)}>
						{item.name}
						<RightCaret className="h-5 w-5 invisible group-hover:visible" />
					</button>
				))}
			</div>
		</>
	);
};
