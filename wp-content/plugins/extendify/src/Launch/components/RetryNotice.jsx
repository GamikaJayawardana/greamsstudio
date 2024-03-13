import { Snackbar } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { AnimatePresence, motion } from 'framer-motion';

export const RetryNotice = ({ show }) => {
	if (!show) return null;
	return (
		<AnimatePresence>
			<motion.div className="extendify-launch w-full fixed bottom-[100px] pb-4 flex justify-end z-max px-12">
				<div className="shadow-2xl">
					<Snackbar>
						{__(
							'Just a moment, this is taking longer than expected.',
							'extendify-local',
						)}
					</Snackbar>
				</div>
			</motion.div>
		</AnimatePresence>
	);
};
