import { Spinner } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useKnowledgeBaseStore } from '@assist/state/KnowledgeBase.js';

export const SearchResults = ({ searchResponse }) => {
	const { data: results, loading, error } = searchResponse;

	if (loading) {
		return (
			<div className="p-8 text-base text-center">
				<Spinner />
			</div>
		);
	}

	if (error) {
		return (
			<div className="p-8 text-base text-center">
				{__('There was an error loading articles', 'extendify-local')}
				<br />
				{error}
			</div>
		);
	}

	if (!results?.length) {
		return (
			<div className="p-8 text-base text-center" data-test="no-results">
				{__("Sorry, we couldn't find anything", 'extendify-local')}
			</div>
		);
	}

	return (
		<div className="flex items-center flex-wrap justify-center">
			<div
				className="max-w-4xl w-full flex flex-col gap-2"
				data-test="search-results">
				{results.map((result) => (
					<ResultListItem key={result.id} {...result} />
				))}
			</div>
		</div>
	);
};

const filterItems = (text) =>
	text
		?.replaceAll(__('Go to the list of Blocks', 'extendify-local'), '')
		?.replaceAll(__('Go back to the list of Blocks', 'extendify-local'), '')
		?.replace(/<\/?p>/g, '');

const ResultListItem = ({ slug, title, summary }) => {
	const { pushArticle } = useKnowledgeBaseStore();
	return (
		<button
			aria-label={__('Show all', 'extendify-local')}
			type="button"
			className="p-4 flex flex-col gap-1 no-underline bg-transparent w-full cursor-pointer text-gray-900 hover:bg-gray-100 focus:outline-none ring-design-main focus:ring-wp focus:ring-offset-1 focus:ring-offset-white"
			onClick={() => {
				pushArticle({ slug, title });
			}}>
			<h3 className="font-semibold text-lg text-left m-0">{title}</h3>
			<div
				className="text-sm text-left"
				dangerouslySetInnerHTML={{
					__html: filterItems(summary),
				}}
			/>
		</button>
	);
};
