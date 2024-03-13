import apiFetch from '@wordpress/api-fetch';
import { Button } from '@wordpress/components';
import { useEffect, useRef } from '@wordpress/element';
import { useState } from '@wordpress/element';
import { createRoot } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Icon, close } from '@wordpress/icons';
import { Dialog } from '@headlessui/react';
import './library.css';

const path = '/extendify/v1/library/settings/add-utils-to-global-styles';
const importGlobalStyles = () => apiFetch({ path, method: 'POST' });

const DeactivationPrompt = () => {
	const [isOpen, setIsOpen] = useState(false);
	const shouldDeactivate = useRef(false);
	const initialFocusRef = useRef(null);
	const selector = '#deactivate-extendify';

	const closeAndDeactivate = () => {
		shouldDeactivate.current = true;
		setIsOpen(false);
		document.querySelector(selector).click();
	};

	useEffect(() => {
		const element = document.querySelector(selector);
		if (!element) return;
		const handle = (event) => {
			if (shouldDeactivate.current) return;
			event.preventDefault();
			setIsOpen(true);
		};
		element.addEventListener('click', handle);
		return () => {
			element.removeEventListener('click', handle);
		};
	}, [setIsOpen]);

	return (
		<Dialog
			as="div"
			className="extendify-library extendify-deactivation-prompt-modal"
			open={isOpen}
			initialFocus={initialFocusRef}
			onClose={() => setIsOpen(false)}>
			<div className="fixed top-0 mx-auto w-full h-full overflow-hidden p-2 md:p-6 md:flex justify-center items-center z-high">
				<div
					className="fixed inset-0 bg-black bg-opacity-40 transition-opacity"
					aria-hidden="true"
				/>
				<div className="sm:flex relative shadow-2xl sm:overflow-hidden mx-auto bg-white flex flex-col sm:min-w-md rounded-sm">
					<div className="flex items-center justify-between">
						<Dialog.Title className="m-0 px-6 text-base text-gray-900">
							{__('Keep styles?', 'extendify-local')}
						</Dialog.Title>
						<Button
							className="border-0 cursor-pointer m-4"
							onClick={() => setIsOpen(false)}
							icon={<Icon icon={close} size={24} />}
							label={__('Close Modal', 'extendify-local')}
							showTooltip={false}
						/>
					</div>
					<div className="m-0 p-6 pt-0 text-left relative max-w-lg">
						<p className="mt-0">
							{__(
								'We detected that you have added some designs from the Site Launcher or Design Library. Click "yes" below to add the styles to your theme (as Additional CSS) so they continue to display properly on your site.',
								'extendify-local',
							)}
						</p>

						<div className="flex justify-end gap-4">
							<Button
								className="components-button is-secondary"
								onClick={closeAndDeactivate}
								showTooltip={false}>
								{__('Deactivate only', 'extendify-local')}
							</Button>
							<Button
								ref={initialFocusRef}
								className="components-button is-primary"
								onClick={() => importGlobalStyles().finally(closeAndDeactivate)}
								showTooltip={false}>
								{__('Yes, add styles', 'extendify-local')}
							</Button>
						</div>
					</div>
				</div>
			</div>
		</Dialog>
	);
};

(() => {
	const promptWrap = document.createElement('div');
	const className = 'extendify-library';
	const id = 'extendify-library-deactivation-prompt';
	const prompt = Object.assign(promptWrap, { id, className });
	document.body.append(prompt);
	createRoot(prompt).render(<DeactivationPrompt />);
})();
