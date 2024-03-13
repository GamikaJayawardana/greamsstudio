import { store as blockEditorStore } from '@wordpress/block-editor';
import { createBlock, pasteHandler } from '@wordpress/blocks';
import {
	MenuGroup,
	MenuItem,
	__experimentalDivider as Divider,
} from '@wordpress/components';
import { useDispatch, useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import {
	addSubmenu,
	rotateLeft,
	trash,
	replace,
	insertAfter,
	Icon,
} from '@wordpress/icons';
import { useContentHighlight } from '@draft/hooks/useContentHighlight';

export const InsertMenu = ({
	prompt,
	completion,
	loading,
	setPrompt,
	setInputText,
}) => {
	const { toggleHighlight, toggleInsertionPoint } = useContentHighlight();
	const { insertBlocks, replaceBlocks } = useDispatch(blockEditorStore);
	const {
		getSelectedBlock,
		getSelectedBlockClientIds,
		getBlockRootClientId,
		getBlockIndex,
		getBlock,
	} = useSelect((select) => select(blockEditorStore), []);
	const selectedBlock = getSelectedBlock();
	const selectedBlockIds = getSelectedBlockClientIds();

	const canReplaceContent = () => {
		const firstBlock = selectedBlock
			? selectedBlock
			: getBlock(selectedBlockIds[0]);
		if (!firstBlock) return false;
		// If it's a header or a p, we can replace the content
		// TODO: support more?
		const unsupported = ['core/list-item', 'core/button'];
		if (unsupported.includes(firstBlock?.name)) {
			// Can we support the same block?
			const blocks = plainTextToBlocks(completion);
			return blocks[0]?.name === firstBlock?.name;
		}
		return true;
	};

	const canInsertAfter = () => {
		const firstBlock = selectedBlock
			? selectedBlock
			: getBlock(selectedBlockIds[0]);
		if (!firstBlock) return true;
		// TODO: more? or should we go up to the parent?
		const unsupported = ['core/list-item', 'core/button'];
		return unsupported.includes(firstBlock?.name) ? false : true;
	};

	const plainTextToBlocks = (plainText) => {
		const blocks = pasteHandler({ plainText: plainText });
		if (!Array.isArray(blocks)) {
			return [createBlock('core/paragraph', { content: blocks })];
		}
		return blocks;
	};

	const insertCompletion = ({ replaceContent = false, position }) => {
		setPrompt({ text: '', promptType: '', systemMessageKey: '' });

		const targetBlockId = selectedBlock
			? selectedBlock?.clientId
			: selectedBlockIds[0];
		const targetBlock = getBlock(targetBlockId);

		const blocks = plainTextToBlocks(completion);
		if (!targetBlockId || position === 'end') {
			insertBlocks(blocks);
			return;
		}
		if (position === 'top') {
			insertBlocks(blocks, 0);
			return;
		}

		const targetIsEmpty = targetBlock?.attributes?.content === '';
		const parentBlockId = getBlockRootClientId(targetBlockId);
		const blockIndex = getBlockIndex(selectedBlockIds.at(-1), parentBlockId);
		if (!replaceContent && !targetIsEmpty) {
			// Multiple blocks are selected, insert after
			insertBlocks(blocks, blockIndex + 1, parentBlockId);
			return;
		}

		const bothHaveContent = (one, two) =>
			Object.prototype.hasOwnProperty.call(one?.attributes, 'content') &&
			Object.prototype.hasOwnProperty.call(two?.attributes, 'content');
		// If both have content, and it's only one block, they can be merged
		const mergable =
			blocks.length === 1 && bothHaveContent(targetBlock, blocks[0]);

		console.log({ targetBlock, blocks, mergable });
		// Apply formatting to all the blocks
		const formattedBlocks = blocks.map((incomingBlock) => ({
			...incomingBlock,
			name: mergable ? targetBlock.name : incomingBlock.name,
			attributes: {
				...targetBlock.attributes,
				content:
					// If they both have content, they can merge and give it to the incoing block
					// otherwise just default to the existing block content
					bothHaveContent(incomingBlock, targetBlock)
						? incomingBlock?.attributes?.content
						: incomingBlock?.attributes?.content,
			},
		}));
		console.log({ formattedBlocks });

		// TODO: some blocks are harder to replace, like list items
		// Should we climb up to the parent in this case?
		// See notes in canReplaceContent() above
		replaceBlocks(selectedBlockIds, formattedBlocks);
	};

	const discard = () => {
		setInputText('');
		setPrompt({ text: '', promptType: '', systemMessageKey: '' });
	};

	const retry = () => {
		setInputText('');
		setPrompt({ text: '', promptType: '', systemMessageKey: '' });
		setTimeout(() => setPrompt(prompt));
	};

	useEffect(() => {
		return () => {
			toggleHighlight(selectedBlockIds, { isHighlighted: false });
		};
	}, [selectedBlockIds, toggleHighlight]);

	return (
		<MenuGroup>
			<MenuItem
				onClick={() => insertCompletion({ replaceContent: true })}
				onMouseEnter={() =>
					toggleHighlight(selectedBlockIds, {
						isHighlighted: true,
					})
				}
				onMouseLeave={() =>
					toggleHighlight(selectedBlockIds, {
						isHighlighted: false,
					})
				}
				disabled={loading || !canReplaceContent()}
				icon={replace}
				iconPosition="left">
				{__('Replace selected block text', 'extendify-local')}
			</MenuItem>
			<MenuItem
				onClick={() =>
					insertCompletion({ replaceContent: false, position: 'top' })
				}
				disabled={loading}
				iconPosition="left">
				<div className="-ml-1">
					<Icon icon={addSubmenu} className="rotate-180" />
				</div>
				<div className="px-1">{__('Insert at top', 'extendify-local')}</div>
			</MenuItem>
			<MenuItem
				onClick={() => insertCompletion({ replaceContent: false })}
				onMouseEnter={() => toggleInsertionPoint(true)}
				onMouseLeave={() => toggleInsertionPoint(false)}
				disabled={loading || !canInsertAfter()}
				icon={insertAfter}
				iconPosition="left">
				{__('Insert after the selected text', 'extendify-local')}
			</MenuItem>
			<MenuItem
				onClick={() =>
					insertCompletion({ replaceContent: false, position: 'end' })
				}
				disabled={loading}
				icon={addSubmenu}
				iconPosition="left">
				{__('Insert at bottom', 'extendify-local')}
			</MenuItem>
			<Divider />
			<MenuItem
				onClick={retry}
				disabled={loading}
				icon={rotateLeft}
				iconPosition="left">
				{__('Try again', 'extendify-local')}
			</MenuItem>
			<MenuItem
				onClick={discard}
				disabled={loading}
				icon={trash}
				iconPosition="left">
				{__('Discard', 'extendify-local')}
			</MenuItem>
		</MenuGroup>
	);
};
