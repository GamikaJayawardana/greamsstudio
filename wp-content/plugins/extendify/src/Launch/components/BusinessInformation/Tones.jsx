import { __ } from '@wordpress/i18n';
import classNames from 'classnames';
import { useUserSelectionStore } from '@launch/state/UserSelections.js';

export const SiteTones = () => {
	const { businessInformation, setBusinessInformation } =
		useUserSelectionStore();

	const tones = [
		{
			label: __('Professional', 'extendify-local'),
			value: 'professional',
		},
		{
			label: __('Friendly', 'extendify-local'),
			value: 'friendly',
		},
		{
			label: __('Inspirational', 'extendify-local'),
			value: 'inspirational',
		},
		{
			label: __('Informative', 'extendify-local'),
			value: 'informative',
		},
		{
			label: __('Persuasive', 'extendify-local'),
			value: 'persuasive',
		},
	];

	const handleTonesToggle = (tone) => {
		let { tones } = businessInformation;
		const isSelected = !!tones?.find(({ value }) => value === tone.value);
		const newTones = isSelected
			? tones?.filter(({ value }) => value !== tone.value)
			: [...tones, tone];
		setBusinessInformation('tones', newTones);
	};

	return (
		<>
			<label
				htmlFor="extendify-business-info-tone"
				className="text-lg md:text-base leading-8 md:leading-10 m-0 text-gray-900 font-semibold">
				{__("Select your site's tone", 'extendify-local')}
			</label>
			<div className="flex justify-left w-full flex-wrap gap-2">
				{tones.map((tone) => {
					const selected = businessInformation.tones?.find(
						({ value }) => value === tone.value,
					);

					return (
						<div
							key={tone.value}
							className={classNames('relative border rounded border-gray-300', {
								'bg-gray-100': selected,
								'border-gray-300': !selected,
							})}>
							<label
								htmlFor={tone.value}
								className="w-full flex items-center justify-between text-gray-900 p-2 h-full">
								<div className="flex items-center flex-auto">
									<span className="w-4 h-4 relative inline-block mr-1 align-middle">
										<input
											id={tone.value}
											className="h-4 w-4 rounded-sm focus:ring-0 focus:ring-offset-0"
											type="checkbox"
											onChange={() => handleTonesToggle(tone)}
											checked={
												!!businessInformation.tones?.find(
													({ value }) => value === tone.value,
												)
											}
										/>
										<svg
											className="absolute block h-4 w-4 -mt-px inset-0 text-white"
											viewBox="1 0 20 20"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
											role="presentation">
											<path
												d="M8.72912 13.7449L5.77536 10.7911L4.76953 11.7899L8.72912 15.7495L17.2291 7.24948L16.2304 6.25073L8.72912 13.7449Z"
												fill="currentColor"
											/>
										</svg>
									</span>
									<span className="text-sm font-small">{tone.label}</span>
								</div>
							</label>
						</div>
					);
				})}
			</div>
		</>
	);
};
