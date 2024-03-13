import { BaseControl, Panel, PanelBody } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { updateUserMeta } from '@draft/api/WPApi';
import { Completion } from '@draft/components/Completion';
import { DraftMenu } from '@draft/components/DraftMenu';
import { EditMenu } from '@draft/components/EditMenu';
import { Input } from '@draft/components/Input';
import { InsertMenu } from '@draft/components/InsertMenu';
import { SelectedText } from '@draft/components/SelectedText';
import { useCompletion } from '@draft/hooks/useCompletion';
import { useSelectedText } from '@draft/hooks/useSelectedText';

export const Draft = () => {
	const { selectedText } = useSelectedText();
	const [inputText, setInputText] = useState('');
	const [ready, setReady] = useState(false);
	const [prompt, setPrompt] = useState({
		text: '',
		promptType: '',
		systemMessageKey: '',
		details: {},
	});
	const { completion, loading, error } = useCompletion(
		prompt.text,
		prompt.promptType,
		prompt.systemMessageKey,
		prompt.details,
	);
	const selectedBlockClientIds = useSelect(
		(select) => select('core/block-editor').getSelectedBlockClientIds(),
		[],
	);
	const { getBlock } = useSelect((select) => select('core/block-editor'), []);
	const {
		userId,
		showAIConsent,
		consentTermsUrl,
		userGaveConsent: gaveBefore,
	} = window.extDraftData;
	// TODO: move to global state
	const [userGaveConsent, setUserGaveConsent] = useState(gaveBefore === '1');
	const needsConsent = showAIConsent && !userGaveConsent;

	const userAcceptsTerms = async () => {
		setUserGaveConsent(true);
		window.extDraftData.userGaveConsent = '1';
		await updateUserMeta(userId, 'extendify_ai_consent', true);
	};
	// TODO: When doing a rewrite, make this global state
	useEffect(() => {
		// Allow for external updates
		const handle = (event) => {
			if (needsConsent) return;
			setPrompt(event.detail);
		};
		window.addEventListener('extendify-draft:set-prompt', handle);
		return () =>
			window.removeEventListener('extendify-draft:set-prompt', handle);
	}, [needsConsent]);

	// Reset input text when an error occurs
	useEffect(() => {
		if (!error) return;
		setInputText(prompt.text);
	}, [error, prompt.text]);

	const canEditContent = () => {
		if (selectedBlockClientIds.length === 0) {
			return false;
		}
		const targetBlock = getBlock(selectedBlockClientIds[0]);
		if (!targetBlock) {
			return false;
		}
		return (
			typeof targetBlock?.attributes?.content !== 'undefined' &&
			targetBlock?.attributes?.content !== ''
		);
	};

	return (
		<>
			<Panel>
				<PanelBody>
					{selectedText && <SelectedText loading={loading} />}

					<div className="rounded-sm border-none bg-gray-100 overflow-hidden mb-4">
						{!completion && (
							<Input
								inputText={inputText}
								setInputText={setInputText}
								ready={ready}
								setReady={setReady}
								setPrompt={setPrompt}
								loading={loading}
							/>
						)}
						{completion && <Completion completion={completion} />}
						{error && (
							<div className="px-4 mb-4 mt-2">
								<p className="m-0 text-xs font-semibold text-red-500">
									{error.message}
								</p>
							</div>
						)}
					</div>
					{(completion || loading) && !error && (
						<InsertMenu
							prompt={prompt}
							completion={completion}
							setPrompt={setPrompt}
							setInputText={setInputText}
							loading={loading}
						/>
					)}
					{!loading && !completion && canEditContent() && (
						<BaseControl>
							<EditMenu
								completion={completion}
								disabled={loading}
								setInputText={setInputText}
								setPrompt={setPrompt}
							/>
						</BaseControl>
					)}
					{!loading && !completion && !canEditContent() && (
						<BaseControl label={__('Suggested prompts', 'extendify-local')}>
							<DraftMenu
								disabled={loading}
								setInputText={setInputText}
								setReady={setReady}
							/>
						</BaseControl>
					)}
					{needsConsent && (
						<div className="bg-black/75 rounded w-full h-full p-6 absolute inset-0 items-center justify-center">
							<div className="bg-white p-4 rounded">
								<h2 className="text-lg mt-0 mb-2">
									{__('Terms of Use', 'extendify-local')}
								</h2>
								<p className="m-0">
									{
										// translators: at the end of the sentence, there is a link to the terms of use
										__(
											'In order to use the AI-powered content drafting tool, you must agree to the terms of use. For more information, click on this link:',
											'extendify-local',
										)
									}{' '}
									<a href={consentTermsUrl} target="_blank" rel="noreferrer">
										{__('Terms of Use', 'extendify-local')}
									</a>
								</p>
								<button
									className="mt-4 bg-wp-theme-500 text-white rounded px-4 py-2 border-0 text-center w-full cursor-pointer"
									type="button"
									onClick={() => userAcceptsTerms()}>
									{__('Accept', 'extendify-local')}
								</button>
							</div>
						</div>
					)}
				</PanelBody>
			</Panel>
			{window.extendifyData?.devbuild && (
				<Panel>
					<PanelBody title="Debug" initialOpen={false}>
						<label>prompt text:</label>
						<pre className="whitespace-pre-wrap">{prompt.text}</pre>
						<label>prompt system message:</label>
						<pre className="whitespace-pre-wrap">{prompt.systemMessageKey}</pre>
						<label>completion:</label>
						<pre className="whitespace-pre-wrap">{completion}</pre>
						<label>error:</label>
						<pre className="whitespace-pre-wrap">{error?.message ?? ''}</pre>
						<label>
							loading: {loading ? <span>true</span> : <span>false</span>}
						</label>
					</PanelBody>
				</Panel>
			)}
		</>
	);
};
