import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import classNames from 'classnames';
import { getGoals, getSuggestedPlugins } from '@launch/api/DataApi';
import { CheckboxInputCard } from '@launch/components/CheckboxInputCard';
import { LoadingIndicator } from '@launch/components/LoadingIndicator';
import { Title } from '@launch/components/Title';
import { useFetch } from '@launch/hooks/useFetch';
import { PageLayout } from '@launch/layouts/PageLayout';
import { usePagesStore } from '@launch/state/Pages';
import { useUserSelectionStore } from '@launch/state/UserSelections';
import { pageState } from '@launch/state/factory';
import * as IconComponents from '@launch/svg';

export const goalsFetcher = () => getGoals();
export const goalsParams = () => ({ key: 'goals' });
export const pluginsFetcher = () => getSuggestedPlugins();
export const pluginsParams = () => ({ key: 'plugins' });

export const state = pageState('Goals', () => ({
	title: __('Goals', 'extendify-local'),
	default: undefined,
	showInSidebar: true,
	ready: false,
	// If no goals are selected
	isDefault: () => useUserSelectionStore.getState().goals?.length === 0,
}));

export const Goals = () => {
	const { loading: goalsLoading } = useFetch(goalsParams, goalsFetcher);
	const { loading: pluginsLoading } = useFetch(pluginsParams, pluginsFetcher);

	return (
		<PageLayout>
			<div className="grow px-6 py-8 md:py-16 md:px-32 overflow-y-scroll">
				<Title
					title={__('What are your goals for your website?', 'extendify-local')}
					description={__(
						"We'll make sure your website has what it needs to achieve your goals.",
						'extendify-local',
					)}
				/>
				<div className="w-full relative max-w-3xl mx-auto">
					{goalsLoading || pluginsLoading ? (
						<LoadingIndicator />
					) : (
						<GoalsSelector />
					)}
				</div>
			</div>
		</PageLayout>
	);
};

const GoalsSelector = () => {
	const { addMany, toggle, goals: selected } = useUserSelectionStore();
	const [selectedGoals, setSelectedGoals] = useState(selected ?? []);
	const { data: goals } = useFetch(goalsParams, goalsFetcher);
	const { data: suggestedPlugins } = useFetch(pluginsParams, pluginsFetcher);
	const nextPage = usePagesStore((state) => state.nextPage);

	useEffect(() => {
		state.setState({ ready: true });
	}, []);

	const handleGoalToggle = (goal) => {
		const alreadySelected = !!selectedGoals?.find(
			({ slug }) => slug === goal.slug,
		);
		const newSeletedGoals = alreadySelected
			? selectedGoals?.filter(({ slug }) => slug !== goal.slug)
			: [...selectedGoals, goal];
		setSelectedGoals(newSeletedGoals);
	};

	useEffect(() => {
		state.setState({ ready: false });
		const timer = setTimeout(() => {
			addMany('goals', selectedGoals, { clearExisting: true });
			const goalSlugs = selectedGoals?.map((goal) => goal.slug);
			// Select all plugins that match the selected goals
			const plugins = suggestedPlugins?.filter((p) =>
				p.goals.find((goalSlug) => goalSlugs?.includes(goalSlug)),
			);
			addMany('plugins', plugins, { clearExisting: true });
			state.setState({ ready: true });
		}, 750);
		return () => clearTimeout(timer);
	}, [selectedGoals, addMany, toggle, suggestedPlugins]);

	return (
		<form
			data-test="goals-form"
			onSubmit={(e) => {
				e.preventDefault();
				nextPage();
			}}
			className="w-full grid xl:grid-cols-2 gap-4 goal-select">
			{/* Added so forms can be submitted by pressing Enter */}
			<input type="submit" className="hidden" />
			{goals?.map((goal, index) => {
				const selected = selectedGoals?.find(({ slug }) => slug === goal.slug);
				const Icon = IconComponents[goal.icon];
				return (
					<div
						key={goal.id}
						className={classNames(
							'relative border rounded-lg border-gray-300',
							{
								'bg-gray-100': selected,
							},
						)}
						data-test="goal-item">
						<div className="flex items-center gap-4 h-full">
							<CheckboxInputCard
								autoFocus={index === 0}
								label={goal.title}
								id={`goal-${goal.slug}`}
								description={goal.description}
								checked={
									!!selectedGoals?.find(({ slug }) => slug === goal.slug)
								}
								onChange={() => handleGoalToggle(goal)}
								Icon={Icon}
							/>
						</div>
					</div>
				);
			})}
		</form>
	);
};
