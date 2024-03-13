import { useEffect, useState, useLayoutEffect } from '@wordpress/element';
import { colord } from 'colord';
import { AnimatePresence, motion } from 'framer-motion';

export const PagesSkeleton = ({ pages }) => {
	const [currentIndex, setCurrentIndex] = useState(0);

	useEffect(() => {
		const timer = setTimeout(() => {
			setCurrentIndex((prevIndex) => (prevIndex + 1) % pages.length);
		}, 10000);
		return () => clearTimeout(timer);
	}, [pages.length, currentIndex]);

	return (
		<div className="mt-3">
			<PageSkeleton pageName={pages[currentIndex]} />
		</div>
	);
};

const PageSkeleton = ({ pageName }) => {
	const [isLightBg, setIsLightBg] = useState(false);
	const [show, setShow] = useState(false);
	const [title, setTitle] = useState('');

	useLayoutEffect(() => {
		const documentStyles = window.getComputedStyle(document.body);
		const bannerMain = documentStyles.getPropertyValue('--ext-banner-main');
		setIsLightBg(colord(bannerMain).isLight());
	}, []);

	useEffect(() => {
		setShow(false);
		const timer = setTimeout(() => {
			setShow(true);
			setTitle(pageName);
		}, 700);
		return () => clearTimeout(timer);
	}, [pageName]);

	return (
		<AnimatePresence>
			{show ? (
				<motion.div
					initial={{ opacity: 0, x: 50 }}
					animate={{ opacity: 1, x: 0, transition: { duration: 0.6 } }}
					exit={{ opacity: 0, x: -50 }}
					transition={{ ease: 'easeInOut' }}
					className="p-4 rounded w-96 mt-12 border-8 border-gray-200 border-opacity-25"
					style={{
						mixBlendMode: isLightBg ? 'difference' : 'plus-lighter',
					}}>
					<h1
						className="text-banner-text opacity-60 mb-8"
						style={{ mixBlendMode: 'plus-lighter' }}>
						{title}
					</h1>
					<div className="space-y-6">
						{[0, 1, 2].map((item) => {
							const delay = 3 * item;
							return (
								<motion.div
									aria-hidden="true"
									key={item}
									initial={{ opacity: 0 }}
									animate={{ opacity: 1 }}
									transition={item ? { duration: delay / 2, delay } : {}}
									role="status"
									className="max-w-sm space-y-2">
									<Piece i={item * delay} className="w-48 h-3 mb-3" />
									<Piece i={item * delay} className="w-full h-2" />
									<Piece i={item * delay} className="w-full max-w-[90%] h-2" />
									<Piece i={item * delay} className="w-full h-2" />
									<Piece i={item * delay} className="w-full h-2" />
								</motion.div>
							);
						})}
					</div>
				</motion.div>
			) : null}
		</AnimatePresence>
	);
};

const Piece = ({ className, i }) => (
	<div
		className={`rounded-full ${className}`}
		style={{
			backgroundColor: 'rgba(204, 204, 204, 0.25)',
			backgroundImage:
				'linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.5) 50%, rgba(255,255,255,0) 100%)',
			backgroundSize: '600% 600%',
			animation: 'extendify-loading-skeleton 10s ease-in-out infinite',
			animationDelay: `${i}s`,
			mixBlendMode: 'plus-lighter',
		}}
	/>
);
