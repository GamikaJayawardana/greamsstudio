import { __ } from '@wordpress/i18n';
import { Icon, chevronRightSmall } from '@wordpress/icons';
import { useRouter } from '@assist/hooks/useRouter';
import { useKnowledgeBaseStore } from '@assist/state/KnowledgeBase';
import { arrowTurnRight } from '@assist/svg';

export const KnowledgeBase = () => {
	const articles = window.extAssistData.resourceData.supportArticles;
	const { navigateTo } = useRouter();
	const { pushArticle, clearArticles, reset } = useKnowledgeBaseStore();

	if (articles && articles?.length === 0) {
		return (
			<div className="assist-knowledge-base-module w-full bg-white p-4 lg:p-8">
				{__('No support articles found...', 'extendify-local')}
			</div>
		);
	}

	// Sort the articles and get the first five based on the id not the priority
	const firstFiveArticles = JSON.parse(JSON.stringify(articles))
		.sort((a, b) => a.id - b.id)
		.slice(0, 5);

	return (
		<div
			id="assist-knowledge-base-module"
			className="w-full bg-white p-4 lg:p-8 text-base">
			<div className="flex justify-between items-center gap-2">
				<h3 className="text-lg leading-tight m-0 flex-1">
					{__('Knowledge Base', 'extendify-local')}
				</h3>
				<a
					onClick={reset}
					href="admin.php?page=extendify-assist#knowledge-base"
					className="inline-flex items-center no-underline hover:underline text-sm text-design-main">
					{__('Show all', 'extendify-local')}
					<Icon icon={chevronRightSmall} className="fill-current" />
				</a>
			</div>
			<div
				className="w-full mx-auto text-sm mt-4 flex flex-col gap-2"
				id="assist-knowledge-base-module-list">
				{firstFiveArticles.map(({ slug, title }) => (
					<button
						aria-label={title}
						type="button"
						key={slug}
						onClick={(e) => {
							e.preventDefault();
							clearArticles();
							pushArticle({ slug, title });
							navigateTo('knowledge-base');
						}}
						className="flex items-center gap-2 no-underline hover:underline hover:text-design-main bg-transparent p-0 w-full cursor-pointer">
						<Icon
							icon={arrowTurnRight}
							className="text-gray-600 fill-current"
						/>
						<span className="leading-snug text-left -mt-px">{title}</span>
					</button>
				))}
			</div>
		</div>
	);
};
