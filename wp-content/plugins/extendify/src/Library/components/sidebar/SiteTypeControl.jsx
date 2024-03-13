import {
	PanelBody,
	PanelRow,
	Spinner,
	SearchControl,
} from '@wordpress/components';
import { useEffect, useState, useRef } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { useSiteTypes } from '@library/hooks/useSiteTypes';
import { useSiteSettingsStore } from '@library/state/site';

export const SiteTypeControl = () => {
	const { siteType, setSiteType } = useSiteSettingsStore();
	const hasSiteType = !!siteType?.name;
	const [isOpen, setIsOpen] = useState(!hasSiteType);
	const [search, setSearch] = useState('');
	const [searchDebounced, setSearchDebounced] = useState('');
	const [searching, setSearching] = useState(false);
	const { data, loading } = useSiteTypes(searchDebounced);
	const searchRef = useRef();

	useEffect(() => {
		if (!isOpen) return;
		setSearch('');
		searchRef.current?.focus();
	}, [isOpen]);

	useEffect(() => {
		if (!data && !loading) return setSearching(false);
		setSearching(loading);
	}, [loading, data]);

	useEffect(() => {
		if (!search) return setSearching(false);
		setSearching(true);
		const id = setTimeout(() => setSearchDebounced(search), 300);
		return () => clearTimeout(id);
	}, [search]);

	return (
		<PanelBody
			title={
				hasSiteType
					? sprintf(
							// translators: %s is the site type name
							__('Site Type: %s', 'extendify-local'),
							siteType.name,
					  )
					: __('Site Type', 'extendify-local')
			}
			className="ext-type-control p-0"
			onToggle={setIsOpen}
			opened={isOpen}
			initialOpen={isOpen}>
			<PanelRow className="m-0 w-full p-4 border border-gray-300 overflow-y-auto max-h-half -mt-1.5 rounded-b flex flex-col gap-2">
				<SearchControl
					ref={searchRef}
					className="w-full"
					label={__('Search for your business type', 'extendify-local')}
					placeholder={__('Search for your business type', 'extendify-local')}
					value={search}
					onChange={setSearch}
				/>
				{searching && (
					<div className="flex w-full justify-center p-2">
						<span className="sr-only">
							{__('Fetching...', 'extendify-local')}
						</span>
						<Spinner />
					</div>
				)}
				{data?.siteTypes?.length > 0 && !searching && (
					<ul className="m-0 w-full pb-2 px-0 overflow-y-auto">
						{data.siteTypes.slice(0, 5).map((siteType) => (
							<li key={siteType.id} className="m-0 p-0">
								<button
									type="button"
									id={`site-type-${siteType.id}`}
									onClick={() => {
										setSiteType(siteType);
										setSearch('');
										setIsOpen(false);
									}}
									className="text-sm w-full text-left px-3 py-1 mb-0.5 block cursor-pointer rounded bg-transparent text-gray-900 hover:bg-gray-100">
									{siteType.name}
								</button>
							</li>
						))}
					</ul>
				)}
			</PanelRow>
		</PanelBody>
	);
};
