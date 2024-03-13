import { useRef, useState, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { search as sIcon, Icon, closeSmall } from '@wordpress/icons';
import classNames from 'classnames';
import { useKnowledgeBaseStore } from '@assist/state/KnowledgeBase.js';
import { KB_HOST } from '../../../../src/constants';

export const SearchForm = ({ handleSubmission }) => {
	const { searchTerm, clearSearchTerm, reset } = useKnowledgeBaseStore();
	const [warmed, setWarmed] = useState(false);
	const [search, setSearch] = useState(searchTerm ?? '');
	const searchRef = useRef();

	const warmServerOnce = () => {
		if (warmed) return;
		setWarmed(true);
		fetch(`${KB_HOST}/api/posts?boot=true`, { method: 'POST' });
	};

	const onSubmit = (e) => {
		e.preventDefault();
		handleSubmission(searchTerm);
	};

	const clearFormAndReset = () => {
		reset();
		clearSearchTerm();
		searchRef.current?.focus();
	};

	useEffect(() => {
		if (searchTerm) return;
		setSearch('');
	}, [searchTerm]);

	useEffect(() => {
		const id = setTimeout(() => {
			handleSubmission(search);
		}, 300);
		return () => clearTimeout(id);
	}, [search, handleSubmission]);

	return (
		<form
			method="get"
			onSubmit={onSubmit}
			className="relative w-full max-w-xs h-8">
			<label htmlFor="ext-s" className="sr-only">
				{__('Search for articles', 'extendify-local')}
			</label>
			<input
				ref={searchRef}
				name="s"
				id="ext-s"
				type="text"
				value={search}
				onFocus={warmServerOnce}
				onChange={(e) => setSearch(e.target.value)}
				placeholder={__('Search...', 'extendify-local')}
				className="input w-full placeholder-gray-400 text-sm pr-16 h-full"
			/>
			<div className="absolute right-0 text-gray-400 flex items-center justify-center inset-y-0">
				<Icon
					icon={!searchTerm ? sIcon : closeSmall}
					className={classNames('fill-current', {
						'cursor-pointer': searchTerm,
					})}
					onClick={clearFormAndReset}
					size={30}
				/>
			</div>
		</form>
	);
};
