import { createSlotFill } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { RestartLaunch } from '@assist/components/dashboard/RestartLaunch';

const { Slot } = createSlotFill('Extendify/Assist/Settings');

export const Settings = () => (
	<Slot>
		{(fills) =>
			(fills.length > 0 || window.extAssistData.canSeeRestartLaunch) && (
				<div
					id="assist-settings-module"
					className="extendify-assist-settings w-full border border-gray-300 p-4 md:p-8 bg-white rounded mt-6">
					<h2 className="text-lg leading-tight m-0">
						{__('Settings', 'extendify-local')}
					</h2>
					<div className="grid grid-cols-1 divide-y">
						{fills}
						{window.extAssistData.canSeeRestartLaunch && <RestartLaunch />}
					</div>
				</div>
			)
		}
	</Slot>
);
