import { useRef, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Icon } from '@wordpress/icons';
import { DynamicTextarea } from '@chat/components/dialog/DynamicTextarea';
import { send } from '@chat/svg';

export const Question = ({ onSubmit }) => {
	const [inputValue, setInputValue] = useState('');
	const formRef = useRef(null);

	const handleInputChange = (e) => {
		setInputValue(e.target.value);
	};

	const handleKeyDown = (e) => {
		if (e.key === 'Enter' && !e.shiftKey) {
			formRef?.current?.requestSubmit();
		}
	};

	return (
		<form onSubmit={onSubmit} ref={formRef} className="py-20">
			<p className="text-lg font-medium m-0 mb-1 opacity-80">
				{__('Hi there!', 'extendify-local')}
			</p>
			<p className="text-2xl font-medium m-0 mb-6">
				{__('Ask me any questions about WordPress.', 'extendify-local')}
			</p>
			<div className="relative rounded border shadow border-gray-300 bg-white">
				<DynamicTextarea
					value={inputValue}
					className="w-full h-full flex-1 py-4 pl-3 pr-10 placeholder-gray-600 resize-none"
					placeholder={__('Ask your WordPress question…', 'extendify-local')}
					onChange={handleInputChange}
					onKeyDown={handleKeyDown}
				/>
				<button
					type="submit"
					className="absolute bottom-3.5 right-2.5 h-6 bg-transparent border-none fill-current flex items-center cursor-pointer text-gray-700 hover:text-gray-900"
					disabled={!inputValue}>
					<Icon icon={send} className="w-4 h-4" />
				</button>
			</div>
		</form>
	);
};
