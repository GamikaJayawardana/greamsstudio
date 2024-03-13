import { __, sprintf } from '@wordpress/i18n';
import { CloseButton } from './CloseButton';

export const Topbar = ({ openOnNewPage, updateUserOption, onClose }) => {
	return (
		<div className="flex gap-6 items-center justify-end px-8 h-16 mb-2 flex-shrink-0">
			<label
				className="flex gap-2 items-center mt-4"
				htmlFor="extendify-open-on-new-pages"
				title={sprintf(
					// translators: %s: Extendify Library term
					__('Toggle %s on new pages', 'extendify-local'),
					'Extendify Library',
				)}>
				<input
					id="extendify-open-on-new-pages"
					className="border border-solid border-gray-900 rounded-sm m-0"
					type="checkbox"
					checked={openOnNewPage}
					onChange={(e) => updateUserOption('openOnNewPage', e.target.checked)}
				/>
				<span>{__('Open for new pages', 'extendify-local')}</span>
			</label>
			<div className="mt-4">
				<CloseButton onClose={onClose} />
			</div>
		</div>
	);
};
