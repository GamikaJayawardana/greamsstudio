import { Spinner } from '@wordpress/components';
import { useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { chevronRightSmall, Icon } from '@wordpress/icons';
import classNames from 'classnames';
import { Breadcrumbs } from '@assist/components/support-articles/Breadcrumbs';
import { SearchForm } from '@assist/components/support-articles/SearchForm';
import { SearchResults } from '@assist/components/support-articles/SearchResults';
import { SupportArticle } from '@assist/components/support-articles/SupportArticle';
import { router } from '@assist/hooks/useRouter';
import { useSearchArticles } from '@assist/hooks/useSearchArticles';
import { useKnowledgeBaseStore } from '@assist/state/KnowledgeBase';
import { arrowTurnRight } from '@assist/svg';

export const SupportArticles = () => {
	const { setSearchTerm, searchTerm, reset, articles, activeCategory } =
		useKnowledgeBaseStore();
	const searchResponse = useSearchArticles(searchTerm);

	const handelSearchFormSubmission = (term) => {
		if (term === searchTerm) return;
		reset();
		setSearchTerm(term);
	};

	useEffect(() => {
		// Reset when the user navigates away
		router.onRouteChange(reset);
		return () => router.removeOnRouteChange(reset);
	}, [reset]);

	return (
		<div className="my-4">
			<div className="bg-design-main p-8 m-0 rounded-t flex gap-3 flex-col md:flex-row justify-between">
				<h2 className="m-0">
					<button
						onClick={reset}
						title={__('Back to Knowledge Base home', 'extendify-local')}
						type="button"
						className="text-design-text text-xl cursor-pointer font-normal focus:outline-none bg-transparent p-0 m-0">
						{__('Knowledge Base', 'extendify-local')}
					</button>
				</h2>
				<SearchForm handleSubmission={handelSearchFormSubmission} />
			</div>

			{(articles?.length > 0 ||
				activeCategory ||
				searchResponse?.data?.length > 0) && <Breadcrumbs />}
			<div
				className="flex flex-col w-full bg-white border border-gray-300 p-4 lg:p-8 min-h-half"
				data-test="kb-content">
				<ContentToShow
					articles={articles}
					search={searchTerm}
					searchResponse={searchResponse}
				/>
			</div>
		</div>
	);
};

const ContentToShow = ({ articles, search, searchResponse }) => {
	if (articles?.length > 0) return <SupportArticle />;
	if (search?.length > 2)
		return <SearchResults searchResponse={searchResponse} />;

	return <ArticlesList articles={articles} />;
};

const ArticlesList = () => {
	const { activeCategory, setActiveCategory, pushArticle } =
		useKnowledgeBaseStore();
	const categories = window.extAssistData.resourceData.supportArticleCategories;
	const articlesList = window.extAssistData.resourceData.supportArticles;

	if (!categories) {
		return (
			<div className="p-8 text-base text-center">
				<Spinner />
			</div>
		);
	}

	if (articlesList && articlesList?.length === 0) {
		return (
			<div className="p-8 text-base text-center">
				{__('No support articles found...', 'extendify-local')}
			</div>
		);
	}

	const categoriesList = categories?.map((category) => {
		const articlesForCategory = articlesList?.filter((article) =>
			article.cats?.includes(category.slug),
		);
		return { ...category, articles: articlesForCategory };
	});

	return (
		<>
			<div
				className="grid md:grid-cols-2 xl:grid-cols-3 gap-x-4 gap-y-8"
				data-test="kb-cats-list">
				{categoriesList
					.filter(({ slug }) => !activeCategory || slug === activeCategory.slug)
					.map((category) => (
						<div key={category.slug}>
							<button
								aria-label={category.title}
								type="button"
								className={classNames(
									'mt-0 mb-4 text-base font-semibold no-underline bg-transparent p-0',
									{
										'hover:underline': !activeCategory,
										'hover:text-design-main': !activeCategory,
										'cursor-pointer': !activeCategory,
									},
								)}
								onClick={() =>
									setActiveCategory({
										title: category.title,
										slug: category.slug,
									})
								}>
								{category.title}
							</button>
							{category.articles
								.filter((_, index) => activeCategory || index < 5)
								.map(({ slug, title }) => (
									<button
										aria-label={title}
										key={slug}
										type="button"
										className="flex items-center gap-2 no-underline hover:underline hover:text-design-main bg-transparent mb-3 p-0 w-full cursor-pointer"
										onClick={() => {
											setActiveCategory(category);
											pushArticle({ slug, title });
										}}>
										<Icon
											icon={arrowTurnRight}
											className="text-gray-600 fill-current"
										/>
										<span className="leading-tight font-normal text-left text-sm -mt-px">
											{title}
										</span>
									</button>
								))}
							{!activeCategory && category.articles.length > 5 && (
								<button
									aria-label={__('Show all', 'extendify-local')}
									type="button"
									className="text-left no-underline hover:underline hover:text-design-main bg-transparent mb-3 mt-4 p-0 w-full cursor-pointer font-semibold text-design-main flex items-center"
									onClick={() => {
										setActiveCategory({
											title: category.title,
											slug: category.slug,
										});
									}}>
									{__('Show all', 'extendify-local')}
									<Icon icon={chevronRightSmall} className="fill-current" />
								</button>
							)}
						</div>
					))}
			</div>
		</>
	);
};
