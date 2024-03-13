import { Flex, FlexBlock } from '@wordpress/components';
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { Draft } from '@draft/Draft';
import '@draft/app.css';
import { ToolbarMenu } from '@draft/components/ToolbarMenu';
import { magic } from '@draft/svg';

registerPlugin('extendify-draft', {
	render: () => (
		<ExtendifyDraft>
			<PluginSidebarMoreMenuItem target="draft">
				{__('Draft', 'extendify-local')}
			</PluginSidebarMoreMenuItem>
			<PluginSidebar
				name="draft"
				icon={magic}
				title={__('AI Tools', 'extendify-local')}
				className="extendify-draft h-full">
				<Flex direction="column" expanded justify="space-between">
					<FlexBlock>
						<Draft />
					</FlexBlock>
				</Flex>
			</PluginSidebar>
		</ExtendifyDraft>
	),
});
const ExtendifyDraft = ({ children }) => {
	// You can run effects here
	return children;
};

// Add the toolbar
addFilter(
	'editor.BlockEdit',
	'extendify-draft/draft',
	(CurrentMenuItems) => (props) => ToolbarMenu(CurrentMenuItems, props),
);
