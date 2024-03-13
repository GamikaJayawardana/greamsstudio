import { dispatch } from '@wordpress/data';
import { useLayoutEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Dialog } from '@headlessui/react';
import { motion } from 'framer-motion';
import { useGlobalsStore } from '@library/state/global';
import { useSiteSettingsStore } from '@library/state/site';
import { useUserStore } from '@library/state/user';
import { insertBlocks } from '@library/util/insert';
import { ModalContent } from './ModalContent';
import { Sidebar } from './sidebar/Sidebar';
import { Topbar } from './topbar/Topbar';

const isNewPage = window?.location?.pathname?.includes('post-new.php');

export const Modal = () => {
	const { open, setOpen } = useGlobalsStore();
	const { updateUserOption, openOnNewPage } = useUserStore();
	const { category, siteType, incrementImports } = useSiteSettingsStore();
	const { createNotice } = dispatch('core/notices');

	const onClose = () => setOpen(false);
	const insertPattern = async (blocks) => {
		await insertBlocks(blocks);
		incrementImports();
		onClose();
		createNotice('info', __('Pattern added', 'extendify-local'), {
			isDismissible: true,
			type: 'snackbar',
		});
	};

	useLayoutEffect(() => {
		if (openOnNewPage && isNewPage) {
			setOpen(true);
			return;
		}
		const search = new URLSearchParams(window.location.search);
		if (search.has('ext-open')) {
			setOpen(true);
		}
	}, [openOnNewPage, setOpen]);

	if (!open) return null;

	return (
		<Dialog
			className="extendify-library extendify-library-modal"
			open={open}
			static
			onClose={onClose}>
			<div className="absolute mx-auto w-full h-full md:p-8">
				<div
					className="fixed inset-0 bg-black/30"
					style={{ backdropFilter: 'blur(2px)' }}
					aria-hidden="true"
				/>
				<motion.div
					key="library-modal"
					initial={{ y: 30, opacity: 0 }}
					animate={{ y: 0, opacity: 1 }}
					exit={{ y: 0, opacity: 0 }}
					transition={{ duration: 0.3 }}
					className="sm:flex h-full w-full relative shadow-2xl sm:overflow-hidden mx-auto bg-white max-w-screen-3xl">
					<Dialog.Title className="sr-only">
						{__('Design Patterns', 'extendify-local')}
					</Dialog.Title>
					<Sidebar />
					<div className="flex flex-col w-full relative bg-[#FAFAFA]">
						<Topbar
							openOnNewPage={openOnNewPage}
							updateUserOption={updateUserOption}
							onClose={onClose}
						/>
						<div className="overflow-y-auto flex-grow">
							<ModalContent
								insertPattern={insertPattern}
								category={category}
								siteType={siteType}
							/>
						</div>
					</div>
				</motion.div>
			</div>
		</Dialog>
	);
};
