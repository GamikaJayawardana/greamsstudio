import { useEffect, useRef, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { getOption, updateOption } from '@launch/api/WPApi';
import { LoadingIndicator } from '@launch/components/LoadingIndicator';
import { Title } from '@launch/components/Title';
import { useFetch } from '@launch/hooks/useFetch';
import { PageLayout } from '@launch/layouts/PageLayout';
import { usePagesStore } from '@launch/state/Pages';
import { useUserSelectionStore } from '@launch/state/UserSelections';
import { pageState } from '@launch/state/factory';

export const fetcher = async () => ({ title: await getOption('blogname') });
export const fetchData = () => ({ key: 'site-info' });
export const state = pageState('Site Title', () => ({
	title: __('Site Title', 'extendify-local'),
	default: undefined,
	showInSidebar: true,
	ready: false,
}));

export const SiteInformation = () => {
	const { loading } = useFetch(fetchData, fetcher);

	useEffect(() => {
		state.setState({ ready: !loading });
	}, [loading]);

	return (
		<PageLayout>
			<div className="grow px-6 py-8 md:py-16 md:px-32 overflow-y-scroll">
				<Title
					title={__("What's the name of your new site?", 'extendify-local')}
					description={__('You can change this later.', 'extendify-local')}
				/>
				<div className="w-full relative max-w-xl mx-auto">
					{loading ? <LoadingIndicator /> : <Info />}
				</div>
			</div>
		</PageLayout>
	);
};

const Info = () => {
	const { siteInformation, setSiteInformation } = useUserSelectionStore();
	const nextPage = usePagesStore((state) => state.nextPage);
	const { data: siteInfoFromDb } = useFetch(fetchData, fetcher);
	const initialFocus = useRef(null);
	const [title, setTitle] = useState(siteInformation?.title);

	useEffect(() => {
		if (siteInformation.title !== undefined) return;
		setTitle(siteInfoFromDb?.title ?? '');
	}, [siteInfoFromDb.title, siteInformation.title]);

	useEffect(() => {
		if (title === undefined) return;
		state.setState({ ready: false });
		const id = setTimeout(() => {
			updateOption('blogname', title);
			setSiteInformation('title', title);
			state.setState({ ready: true });
		}, 750);
		return () => clearTimeout(id);
	}, [setSiteInformation, title]);

	useEffect(() => {
		const raf = requestAnimationFrame(() => initialFocus.current?.focus());
		return () => cancelAnimationFrame(raf);
	}, []);

	if (siteInformation?.title === undefined) {
		return <LoadingIndicator />;
	}

	return (
		<form
			onSubmit={(e) => {
				e.preventDefault();
				if (!state.getState().ready) return;
				nextPage();
			}}>
			<label htmlFor="extendify-site-title-input" className="sr-only">
				{__("What's the name of your website?", 'extendify-local')}
			</label>
			<div className="mb-8">
				<input
					data-test="site-title-input"
					autoComplete="off"
					ref={initialFocus}
					type="text"
					name="site-title-input"
					id="extendify-site-title-input"
					className="w-full rounded border border-gray-200 h-12 py-6 px-4 input-focus ring-offset-0"
					value={title ?? ''}
					onChange={(e) => setTitle(e.target.value)}
					placeholder={__('Enter your website name', 'extendify-local')}
				/>
			</div>
		</form>
	);
};
