import { Icon, Dropdown, MenuGroup, MenuItem } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { moreVertical, check } from '@wordpress/icons';
import { updateOptions } from '@chat/api/Data';
import { chevron, robot } from '@chat/svg';

export const Header = ({
	question,
	reset,
	experienceLevel,
	setExperienceLevel,
	showHistory,
	setShowChat,
}) => {
	const experienceLevels = {
		beginner: __('Beginner', 'extendify-local'),
		intermediate: __('Intermediate', 'extendify-local'),
		advanced: __('Advanced', 'extendify-local'),
	};

	const updateExperienceLevel = (value) => {
		setExperienceLevel(value);
		updateOptions({ experienceLevel: value });
	};

	const hideChat = () => {
		setShowChat(false);
		updateOptions({ showChat: false });
	};

	return (
		<header className="flex items-center gap-2 justify-between">
			<div className="flex items-center gap-2">
				{(question || showHistory) && (
					<button
						type="button"
						onClick={reset}
						className="bg-transparent border-none p-0 cursor-pointer">
						<Icon
							icon={chevron}
							className="text-design-text fill-current h-4 rotate-90"
						/>
					</button>
				)}
				{showHistory && (
					<div className="text-white p-2 flex items-center">
						{__('Recent History', 'extendify-local')}
					</div>
				)}
			</div>
			{showHistory || (
				<div className="flex gap-2 items-center">
					<div className="rounded-full bg-white p-2 flex items-center">
						<Icon
							icon={robot}
							className="text-design-main fill-current w-4 h-4"
						/>
					</div>

					<Dropdown
						className="flex"
						contentClassName="origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
						position="bottom right"
						popoverProps={{ placement: 'bottom-start' }}
						renderToggle={({ onToggle }) => (
							<Icon
								icon={moreVertical}
								onClick={onToggle}
								className="text-design-text fill-current w-6 h-6 p-1 rounded cursor-pointer hover:bg-white/10"
							/>
						)}
						renderContent={() => (
							<MenuGroup
								label={__('WordPress Comfort Level', 'extendify-local')}>
								{Object.entries(experienceLevels).map(([key, label]) => (
									<MenuItem
										key={key}
										isSelected={experienceLevel === key}
										onClick={() => updateExperienceLevel(key)}
										icon={experienceLevel === key ? check : null}>
										{label}
									</MenuItem>
								))}
								<hr />
								<MenuItem onClick={hideChat}>
									{__('Hide the chat bot', 'extendify-local')}
								</MenuItem>
							</MenuGroup>
						)}
					/>
				</div>
			)}
		</header>
	);
};
