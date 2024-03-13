import apiFetch from '@wordpress/api-fetch';
import { Spinner } from '@wordpress/components';
import { useEffect, useState, forwardRef, useRef } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { Dialog } from '@headlessui/react';
import classnames from 'classnames';
import { AnimatePresence, motion } from 'framer-motion';

export const RestartLaunchModal = ({ setPage, resetState }) => {
	const oldPages = window.extOnbData.oldPagesIds ?? [];
	const [open, setOpen] = useState(false);
	const [processing, setProcessing] = useState(false);
	const initialFocus = useRef(null);
	const handleExit = () =>
		(window.location.href = `${window.extOnbData.adminUrl}admin.php?page=extendify-assist`);

	const handleOk = async () => {
		setProcessing(true);
		resetState();
		for (const pageId of oldPages) {
			await apiFetch({
				path: `/wp/v2/pages/${pageId}`,
				method: 'DELETE',
			});
		}
		setOpen(false);
	};

	useEffect(() => {
		if (oldPages.length > 0) {
			setOpen(true);
			setPage(0);
		}
	}, [oldPages.length, setOpen, setPage]);

	return (
		<AnimatePresence>
			{open && (
				<Dialog
					initialFocus={initialFocus}
					static
					open={open}
					as={motion.div}
					initial={false}
					animate={{ opacity: 1 }}
					exit={{ opacity: 0 }}
					data-test="confirmation-launch"
					className="extendify-launch extendify-launch-modal"
					onClose={() => null}>
					<div className="mx-auto md:p-8 w-full flex justify-center items-center h-screen absolute top-0">
						<div
							className="fixed inset-0 bg-black/30"
							style={{ backdropFilter: 'blur(2px)', zIndex: 99999 }}
							aria-hidden="true"
						/>
						<div
							style={{ zIndex: 99999 + 100 }}
							className="sm:flex rounded relative shadow-2xl sm:overflow-hidden bg-white max-w-screen-3xl">
							<Dialog.Panel className="my-6 mx-8 flex flex-col gap-8">
								<Dialog.Title className="m-0 text-gray-900 text-xl flex items-center">
									{__('Start over?', 'extendify-local')}
								</Dialog.Title>
								<div className="text-left relative">
									<p className="text-lg m-0 mb-2">
										{__(
											'Go through the onboarding process again to create a new site.',
											'extendify-local',
										)}
									</p>
									<p className="text-base m-0">
										<strong>
											{sprintf(
												// translators: %3$s is the number of old pages
												__(
													'%s pages created in the prior onboarding session will be deleted.',
													'extendify-local',
												),
												oldPages.length,
											)}
										</strong>
									</p>
								</div>
								<div className="flex justify-end space-x-4">
									<NavigationButton
										data-test="modal-exit-button"
										onClick={handleExit}
										disabled={processing}
										className="bg-white text-design-main border-gray-200 hover:bg-gray-50 focus:bg-gray-50">
										{__('Exit', 'extendify-local')}
									</NavigationButton>
									<NavigationButton
										onClick={handleOk}
										disabled={processing}
										className="bg-design-main text-design-text border-design-main"
										data-test="modal-continue-button">
										{!processing ? (
											__('Continue', 'extendify-local')
										) : (
											<div className="flex items-center justify-center">
												<Spinner />
												<div>{__('Processing', 'extendify-local')}</div>
											</div>
										)}
									</NavigationButton>
								</div>
							</Dialog.Panel>
						</div>
					</div>
				</Dialog>
			)}
		</AnimatePresence>
	);
};

const NavigationButton = forwardRef((props, ref) => {
	return (
		<button
			ref={ref}
			{...props}
			className={classnames(
				'rounded flex items-center px-6 py-3 leading-6 button-focus border',
				{
					'opacity-50 cursor-not-allowed': props.disabled,
				},
				props.className,
			)}
			type="button">
			{props.children}
		</button>
	);
});
