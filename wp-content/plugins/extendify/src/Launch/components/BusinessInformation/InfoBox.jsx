import { __ } from '@wordpress/i18n';

export const InfoBox = ({ description, setDescription }) => (
	<>
		<label
			htmlFor="extendify-business-info-input"
			className="text-lg md:text-base leading-8 md:leading-10 m-0 text-gray-900 font-semibold after:content-['*'] after:ml-0.5 after:text-red-500">
			{__('Website description', 'extendify-local')}
		</label>
		<textarea
			data-test="business-info-input"
			autoComplete="off"
			autoFocus={true}
			rows="4"
			name="business-info-input"
			id="extendify-business-info-input"
			className={
				'w-full rounded-lg border border-gray-300 h-40 p-2 input-focus ring-offset-0 placeholder:italic placeholder:text-md placeholder:opacity-50'
			}
			value={description ?? ''}
			onChange={(e) => setDescription(e.target.value)}
			placeholder={__(
				'E.g., We are a yoga studio in Lakewood, CO with professionally trained instructors with focus on hot yoga for therapeutic purposes.',
				'extendify-local',
			)}
		/>
	</>
);
