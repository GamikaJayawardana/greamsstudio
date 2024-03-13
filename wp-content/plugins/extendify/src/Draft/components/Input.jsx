import { Spinner } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { arrowRight, Icon } from '@wordpress/icons';
import classnames from 'classnames';
import { DynamicTextarea } from '@draft/components/DynamicTextarea';
import { useSelectedText } from '@draft/hooks/useSelectedText';
import { magic } from '@draft/svg';

export const Input = ({
	inputText,
	setInputText,
	ready,
	setReady,
	setPrompt,
	loading,
}) => {
	const { selectedText: text } = useSelectedText();

	const submit = (event) => {
		event.preventDefault();

		if (!ready || loading) return;

		setInputText('');
		setReady(false);

		setPrompt({
			text: text ? `${inputText}: ${text}` : inputText,
			promptType: text ? 'custom-requests' : 'create',
			systemMessageKey: text ? 'edit' : 'generate',
		});
	};

	return (
		<form className="relative flex items-start" onSubmit={submit}>
			<Icon
				icon={magic}
				className="text-wp-theme-500 fill-current w-5 h-5 absolute left-2 top-3.5"
			/>
			<DynamicTextarea
				disabled={loading}
				placeholder={
					loading
						? __('AI is writing...', 'extendify-local')
						: text
						? __('Ask AI to edit', 'extendify-local')
						: __('Ask AI to generate text', 'extendify-local')
				}
				value={inputText}
				className="bg-transparent border-transparent outline-none rounded-none focus:ring-1 focus:ring-wp-theme-500 w-full h-full px-10 py-3 overflow-hidden resize-none"
				onChange={(event) => {
					setInputText(event.target.value);
					setReady(event.target.value.length > 0);
				}}
				onKeyDown={(event) => {
					if (event.key === 'Enter' && !event.shiftKey) {
						event.preventDefault();
						submit(event);
					}
				}}
			/>
			{loading && (
				<div className="text-gray-700 absolute right-4 w-4 h-4 p-1 top-3.5">
					<Spinner style={{ margin: '0' }} />
				</div>
			)}
			{!loading && (
				<button
					type="submit"
					disabled={!ready}
					aria-label={__('Submit', 'extendify-local')}
					className={classnames(
						'bg-transparent border-none absolute right-2 p-0 top-3.5',
						{
							'cursor-pointer text-gray-700 hover:text-design-main': ready,
							'text-gray-500': !ready,
						},
					)}>
					<Icon
						icon={arrowRight}
						onClick={submit}
						className="fill-current w-6 h-6"
					/>
				</button>
			)}
		</form>
	);
};
