import { __ } from '@wordpress/i18n';

export const RestartLaunch = () => {
	const launchURL =
		window.extAssistData.adminUrl + 'admin.php?page=extendify-launch';

	return (
		<div className="flex flex-col" id="assist-settings-module-restart-launch">
			<h3 className="m-0 mb-1 mt-6 text-lg">
				{__('Start over?', 'extendify-local')}
			</h3>
			<p className="my-0">
				{__(
					'Go through the onboarding process again to create a new site.',
					'extendify-local',
				)}
			</p>
			<div className="mt-5">
				<button
					className="h-10 px-4 py-2 leading-tight min-w-20 min-h-10 button-focus bg-gray-100 hover:bg-gray-200 focus:shadow-button text-gray-900 rounded-sm cursor-pointer no-underline text-sm"
					type="button"
					onClick={() => (window.location = launchURL)}>
					{__('Start over', 'extendify-local')}
				</button>
			</div>
		</div>
	);
};
