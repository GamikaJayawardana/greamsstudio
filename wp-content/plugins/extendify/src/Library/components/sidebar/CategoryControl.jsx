import { PanelBody, PanelRow, Spinner } from '@wordpress/components';
import { useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import classNames from 'classnames';
import { useCategories } from '@library/hooks/useCategories';
import { useCacheStore } from '@library/state/cache';
import { useSiteSettingsStore } from '@library/state/site';

export const CategoryControl = () => {
	const { category, siteType, setCategory } = useSiteSettingsStore();
	const { data, isLoading, errorCount } = useCategories();
	const { categories, setCategories } = useCacheStore();

	useEffect(() => {
		if (isLoading || errorCount) return;
		setCategories(data);
	}, [data, isLoading, setCategories, errorCount]);

	useEffect(() => {
		// Don't steal focus if no site type is selected
		const focus = (slug) =>
			siteType?.name &&
			document.querySelector(`#extendify-library-category-${slug}`)?.focus();
		// Wait for categories to be available
		if (!categories?.length) return;
		if (category) {
			// If category is all, focus all
			if (category === 'all') return focus('all');
			// If category is already set, make sure it's a valid category
			if (categories?.find(({ slug }) => slug === category)) {
				return focus(category);
			}
		}
		setCategory('all');
		focus('all');
	}, [category, setCategory, categories, siteType?.name]);

	return (
		<PanelBody
			title={__('Design Type', 'extendify-local')}
			className="ext-type-control p-0"
			initialOpen={!!siteType?.name}>
			<PanelRow>
				<CategoryList
					categories={categories}
					errorCount={errorCount}
					current={category}
					setCurrent={setCategory}
				/>
			</PanelRow>
		</PanelBody>
	);
};

const CategoryList = ({ categories, errorCount, current, setCurrent }) => {
	const classes = (slug) =>
		classNames(
			'text-sm w-full text-left px-3 py-1 mb-0.5 block cursor-pointer rounded',
			{
				'bg-design-main text-design-text': current === slug,
				'bg-transparent text-gray-900 hover:bg-gray-100': current !== slug,
			},
		);
	// If we have categories, return early no matter the error
	if (categories?.length) {
		return (
			<ul className="m-0 w-full py-2 px-1 border border-gray-300 overflow-y-auto max-h-half -mt-1.5 rounded-b">
				<li className="m-0 p-0">
					<button
						type="button"
						id="extendify-library-category-all"
						onClick={() => setCurrent('all')}
						className={classes('all')}>
						{__('All', 'extendify-local')}
					</button>
				</li>
				{categories.map(({ slug, id, name }) => {
					return (
						<li key={id} className="m-0 p-0">
							<button
								type="button"
								id={`extendify-library-category-${slug}`}
								onClick={() => setCurrent(slug)}
								className={classes(slug)}>
								{name}
							</button>
						</li>
					);
				})}
			</ul>
		);
	}

	if (errorCount > 1) {
		return (
			<div className="flex flex-col w-full justify-center items-center gap-2 border-t border-gray-300 -mt-1 p-2">
				<span>{__('Retrying...', 'extendify-local')}</span>
				<Spinner />
			</div>
		);
	}

	return (
		<div className="flex w-full justify-center border-t border-gray-300 -mt-1 p-2">
			<span className="sr-only">{__('Fetching...', 'extendify-local')}</span>
			<Spinner />
		</div>
	);
};
