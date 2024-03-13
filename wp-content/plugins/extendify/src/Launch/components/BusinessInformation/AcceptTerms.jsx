import { __, sprintf } from '@wordpress/i18n';

export const AcceptTerms = ({ setAcceptTerms, acceptTerms, termsUrl }) => {
	if (!termsUrl) return null;
	return (
		<label
			htmlFor="accept-terms"
			className="text-lg ml-1 flex items-center focus-within:text-design-mains after:content-['*'] after:ml-0.5 after:text-red-500">
			<span className="relative">
				<input
					id="accept-terms"
					className="h-5 w-5 rounded-sm focus:ring-0 focus:ring-offset-0"
					type="checkbox"
					onChange={() => setAcceptTerms(!acceptTerms)}
					checked={acceptTerms}
				/>
				<svg
					className="absolute block inset-0 h-6 w-5 text-white"
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
			<span
				className="ml-1"
				dangerouslySetInnerHTML={{
					__html: sprintf(
						// translators: at the end of the sentence, there is a link to the terms of use
						__(
							'I agree to the %1$sAI terms and conditions%2$s',
							'extendify-local',
						),
						`<a href="${termsUrl}" target="_blank" class="text-design-main opacity-90 no-underline hover:underline hover:underline-offset-4 hover:opacity-100" rel="noreferrer">`,
						'</a>',
					),
				}}
			/>
		</label>
	);
};
