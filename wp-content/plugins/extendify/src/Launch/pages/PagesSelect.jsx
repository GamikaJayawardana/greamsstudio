import { useState, useRef, useEffect, useMemo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { getPageTemplates } from '@launch/api/DataApi';
import { PagePreview } from '@launch/components/PagePreview';
import { PageSelectButton } from '@launch/components/PageSelectButton';
import { Title } from '@launch/components/Title';
import { useFetch } from '@launch/hooks/useFetch';
import { PageLayout } from '@launch/layouts/PageLayout';
import { useUserSelectionStore } from '@launch/state/UserSelections';
import { pageState } from '@launch/state/factory';

export const fetcher = ({ siteType }) => getPageTemplates(siteType);
export const fetchData = (siteType) => ({
	key: 'pages-list',
	siteType: siteType ?? useUserSelectionStore?.getState().siteType,
});

export const state = pageState('Pages', () => ({
	title: __('Pages', 'extendify-local'),
	showInSidebar: true,
	ready: true,
}));

export const PagesSelect = () => {
	const { data: availablePages, loading } = useFetch(fetchData, fetcher);
	const [previewing, setPreviewing] = useState();
	const [expandMore, setExpandMore] = useState();
	const { pages, remove, add, has, style } = useUserSelectionStore();
	const pagePreviewRef = useRef();

	const homePage = useMemo(
		() => ({
			id: 'home-page',
			slug: 'home-page',
			name: __('Home page', 'extendify-local'),
			patterns: style?.code.map((code, i) => ({
				name: `pattern-${i}`,
				code,
			})),
		}),
		[style],
	);
	const styleMemo = useMemo(
		() => ({
			...style,
			code: previewing
				? previewing.patterns.map(({ code }) => code).join('')
				: '',
		}),
		[style, previewing],
	);

	const handlePageToggle = (page) => {
		if (has('pages', page)) {
			remove('pages', page);
			return;
		}
		add('pages', page);
		return setPreviewing(page);
	};

	useEffect(() => {
		// This needs two frames before the code is rendered
		let raf2;
		const id = requestAnimationFrame(() => {
			raf2 = requestAnimationFrame(() => {
				pagePreviewRef?.current?.scrollTo(0, 0);
			});
		});
		return () => {
			cancelAnimationFrame(id);
			cancelAnimationFrame(raf2);
		};
	}, [previewing]);

	useEffect(() => {
		if (previewing) return;
		setPreviewing(homePage);
	}, [previewing, homePage]);

	useEffect(() => {
		// If no pages have been set, then add the recommended pages
		if (pages) return;
		if (!availablePages?.recommended) return;
		availablePages.recommended.forEach((page) => add('pages', page));
	}, [pages, availablePages?.recommended, add]);

	return (
		<PageLayout>
			<div className="grow lg:flex overflow-y-scroll space-y-4 lg:space-y-0">
				<div className="h-full bg-gray-100 grow pt-0 px-4 lg:pb-0 l6:px-16 xl:px-32 overflow-y-hidden min-h-screen lg:min-h-0">
					<div className="h-full flex flex-col">
						<h3 className="text-base lg:text-lg font-medium text-gray-700 text-center my-2 lg:my-4">
							{previewing?.name}
						</h3>
						<div
							ref={pagePreviewRef}
							className="h-full lg:h-auto grow rounded-t-lg relative lg:overflow-y-scroll">
							{previewing && !loading && (
								<PagePreview ref={pagePreviewRef} style={styleMemo} />
							)}
						</div>
					</div>
				</div>
				<div className="flex items-center w-full lg:max-w-lg flex-col px-6 py-8 lg:py-16 lg:px-12 overflow-y-auto">
					<Title
						title={__(
							'Pick the pages to add to your website',
							'extendify-local',
						)}
						description={__(
							'We already selected the most common pages for your type of website.',
							'extendify-local',
						)}
					/>
					<div
						className="flex flex-col gap-4 pb-4 w-full"
						data-test="recommended-pages">
						<PageSelectButton
							page={homePage}
							previewing={homePage.id === previewing?.id}
							onPreview={() => setPreviewing(homePage)}
							checked={true}
							forceChecked={true}
							onChange={() => undefined}
						/>
						{availablePages?.recommended?.map((page) => (
							<PageSelectButton
								key={page.id}
								page={page}
								previewing={page.id === previewing?.id}
								onPreview={() => setPreviewing(page)}
								checked={has('pages', page)}
								onChange={() => handlePageToggle(page)}
							/>
						))}
					</div>
					<div className="flex items-center justify-center">
						<button
							type="button"
							data-test="expand-more"
							onClick={setExpandMore}
							className="bg-transparent text-sm text-center font-medium text-gray-900 my-4 cursor-pointer hover:text-design-main button-focus">
							{__('View more pages', 'extendify-local')}
						</button>
					</div>
					{expandMore && (
						<div
							className="flex flex-col gap-4 pb-4 w-full"
							data-test="optional-pages">
							{availablePages?.optional?.map((page) => (
								<PageSelectButton
									key={page.id}
									page={page}
									previewing={page.id === previewing?.id}
									onPreview={() => setPreviewing(page)}
									checked={pages?.some((p) => p.id === page.id)}
									onChange={() => handlePageToggle(page)}
								/>
							))}
						</div>
					)}
				</div>
			</div>
		</PageLayout>
	);
};
