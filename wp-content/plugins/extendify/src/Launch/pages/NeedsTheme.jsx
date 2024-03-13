import { __ } from '@wordpress/i18n';
import { Title } from '@launch/components/Title';
import { PageLayout } from '@launch/layouts/PageLayout';

export const NeedsTheme = () => {
	return (
		<PageLayout includeNav={false}>
			<div className="grow px-6 py-8 md:py-16 md:px-32 overflow-y-scroll">
				<Title
					title={__('One more thing before we start.', 'extendify-local')}
				/>
				<div className="w-full relative max-w-xl mx-auto">
					<p className="text-base">
						{__(
							'Hey there, Launch is powered by Extendable and is required to proceed. You can install it from the link below and start over once activated.',
							'extendify-local',
						)}
					</p>
					<a
						className="text-base text-design-main font-medium underline mt-4"
						href={`${window.extOnbData.site}/wp-admin/theme-install.php?theme=extendable`}>
						{__('Take me there', 'extendify-local')}
					</a>
				</div>
			</div>
		</PageLayout>
	);
};
