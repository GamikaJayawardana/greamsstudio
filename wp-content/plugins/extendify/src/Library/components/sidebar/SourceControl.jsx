import {
	__experimentalToggleGroupControl as ToggleGroupControl,
	__experimentalToggleGroupControlOption as ToggleGroupControlOption,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export const SourceControl = () => (
	<ToggleGroupControl
		onChange={(source) => console.log({ source })}
		value={'patterns'}
		__nextHasNoMarginBottom
		isBlock>
		<ToggleGroupControlOption
			value="patterns"
			label={__('Patterns', 'extendify-local')}
		/>
		<ToggleGroupControlOption
			value="templates"
			label={__('Templates', 'extendify-local')}
		/>
	</ToggleGroupControl>
);
