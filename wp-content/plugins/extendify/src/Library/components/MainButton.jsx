import { __ } from '@wordpress/i18n';
import { Icon } from '@wordpress/icons';
import { extendifyLogo } from '@library/icons/extendify-logo';
import { useGlobalsStore } from '@library/state/global';

export const MainButton = () => {
	const { setOpen } = useGlobalsStore();
	const handleClick = () => setOpen(true);

	return (
		<div
			role="button"
			onClick={handleClick}
			className="components-button has-icon is-primary cursor-pointer h-8 xs:h-9 px-1 min-w-0 xs:pl-2 xs:pr-3 sm:ml-2">
			<Icon icon={extendifyLogo} size={24} />
			<span className="hidden xs:inline ml-1">
				{__('Design Library', 'extendify-local')}
			</span>
		</div>
	);
};
