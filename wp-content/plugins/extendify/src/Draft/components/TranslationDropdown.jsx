import { Dropdown, MenuItem, MenuGroup } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { Icon, language, chevronRight } from '@wordpress/icons';
import { magic } from '@draft/svg';

export const DropdownTranslate = ({
	text,
	closePopup,
	openDraft,
	updatePrompt,
}) => {
	const items = [
		{ language: __('Catalan', 'extendify-local'), code: 'ca' },
		{ language: __('Danish', 'extendify-local'), code: 'da_DK' },
		{ language: __('Dutch', 'extendify-local'), code: 'nl_NL' },
		{ language: __('Dutch (Belgium)', 'extendify-local'), code: 'de_BE' },
		{ language: __('English', 'extendify-local'), code: 'en' },
		{ language: __('Estonian', 'extendify-local'), code: 'et' },
		{ language: __('Finnish', 'extendify-local'), code: 'fi' },
		{ language: __('French (Belgium)', 'extendify-local'), code: 'fr_BE' },
		{ language: __('French (France)', 'extendify-local'), code: 'fr_FR' },
		{ language: __('German', 'extendify-local'), code: 'de_DE' },
		{ language: __('German (Switzerland)', 'extendify-local'), code: 'de_CH' },
		{ language: __('Indonesian', 'extendify-local'), code: 'id_ID' },
		{ language: __('Italian', 'extendify-local'), code: 'it_IT' },
		{ language: __('Japanese', 'extendify-local'), code: 'jp' },
		{ language: __('Polish', 'extendify-local'), code: 'pl_PL' },
		{ language: __('Portuguese (Brazil)', 'extendify-local'), code: 'pt_BR' },
		{ language: __('Portuguese (Portugal)', 'extendify-local'), code: 'pt_PT' },
		{ language: __('Spanish (Spain)', 'extendify-local'), code: 'es_ES' },
		{ language: __('Swedish', 'extendify-local'), code: 'sv_SE' },
		{ language: __('Ukrainian', 'extendify-local'), code: 'uk' },
		{ language: __('Vietnamese', 'extendify-local'), code: 'vi' },
	];

	return (
		<Dropdown
			className="my-container-class-name flex items-center justify-between w-full"
			contentClassName="my-dropdown-content-classname"
			popoverProps={{ placement: 'right-start' }}
			renderToggle={({ isOpen, onToggle }) => (
				<div className="group flex items-center justify-between w-full hover:text-design-main">
					<MenuItem
						className="w-full flex justify-between"
						icon={language}
						iconPosition="left"
						variant={undefined}
						onClick={onToggle}
						aria-expanded={isOpen}>
						{__('Translate', 'extendify-local')}
					</MenuItem>
					<Icon
						icon={chevronRight}
						size={24}
						className="group-hover:text-current fill-current"
					/>
				</div>
			)}
			renderContent={() => (
				<MenuGroup
					className="extendify-draft"
					label={
						<div className="flex items-center gap-2">
							<Icon className="fill-gray-900" size={16} icon={magic} />
							{__('Translate to...', 'extendify-local')}
						</div>
					}>
					{items.map(
						({
							language,
							code,
							promptType = 'translate',
							systemMessageKey = 'edit',
						}) => (
							<MenuItem
								key={`${promptType}-${code}-${systemMessageKey}`}
								style={{ width: '100%' }}
								isSelected={false}
								disabled={false}
								variant={undefined}
								onClick={() => {
									openDraft?.();
									closePopup?.();
									window.requestAnimationFrame(() =>
										window.requestAnimationFrame(() =>
											updatePrompt({
												text,
												promptType,
												systemMessageKey,
												details: { languageInto: language },
											}),
										),
									);
								}}>
								{language}
							</MenuItem>
						),
					)}
				</MenuGroup>
			)}
		/>
	);
};
