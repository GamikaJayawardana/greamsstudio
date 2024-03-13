import { __ } from '@wordpress/i18n';

export default {
	id: 'welcome-tour',
	settings: {
		allowOverflow: true,
		startFrom: [
			window.extAssistData.adminUrl + 'index.php',
			window.extAssistData.adminUrl +
				'admin.php?page=extendify-assist#dashboard',
		],
		minBoxWidth: '360px',
	},
	onStart: () => {
		// if the menu is collapsed, remove the class to expand it
		if (document.body.classList.contains('folded')) {
			document.body.classList.remove('folded');
			document.body.classList.add('temp-open');
		}
	},
	onFinish: () => {
		// only fold the menu if it was folded before
		if (document.body.classList.contains('temp-open')) {
			document.body.classList.remove('temp-open');
			document.body.classList.add('folded');
		}
	},
	steps: [
		{
			title: __('View Site', 'extendify-local'),
			text: __(
				"At any time, you can view your site (from a visitor's perspective) from the top admin bar under your site's name.",
				'extendify-local',
			),
			image: 'https://assets.extendify.com/tours/welcome/view-site.gif',
			attachTo: {
				element: '#wp-admin-bar-view-site',
				offset: {
					marginTop: 0,
					marginLeft: 10,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {
				beforeAttach: () => {
					const menu = document.querySelector(
						'#wp-admin-bar-site-name .ab-sub-wrapper',
					);
					menu.style.position = 'relative';
					menu.style.display = 'block';
				},
				onAttach: () => {
					const menu = document.querySelector(
						'#wp-admin-bar-site-name .ab-sub-wrapper',
					);
					menu.style.position = 'relative';
					menu.style.display = 'block';
				},
				onDetach: () => {
					const menu = document.querySelector(
						'#wp-admin-bar-site-name .ab-sub-wrapper',
					);
					menu.style.position = 'absolute';
					menu.style.display = '';
				},
			},
		},
		{
			title: __('Site Assistant', 'extendify-local'),
			text: __('Access the Site Assistant at any time.', 'extendify-local'),
			attachTo: {
				element: '#toplevel_page_extendify-admin-page',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Dashboard', 'extendify-local'),
			text: __(
				'The default WordPress dashboard will have some overall site metrics and modules added from certain plugins.',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-dashboard',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Posts', 'extendify-local'),
			text: __('Manage and create blog posts.', 'extendify-local'),
			attachTo: {
				element: '#menu-posts',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Media', 'extendify-local'),
			text: __(
				'Add, edit, or remove images and other media from your library. When you upload an image to be used on your site, it will be added to the library.',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-media',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Pages', 'extendify-local'),
			text: __(
				'Use the pages menu to add, delete, or edit the pages on your site.',
				'extendify-local',
			),
			image: 'https://assets.extendify.com/tours/welcome/add-pages.gif',
			attachTo: {
				element: '#menu-pages',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Comments', 'extendify-local'),
			text: __(
				'If you have commenting enabled on your posts, you can manage those comments here.',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-comments',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Appearance', 'extendify-local'),
			text: __(
				'Manage your theme and access the Site Editor from the Appearance menu. The Site Editor is where you can make global changes to your site (such as the menu, header/footer, and styles).',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-appearance',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Plugins', 'extendify-local'),
			text: __('Add or manage the plugins on your site.', 'extendify-local'),
			attachTo: {
				element: '#menu-plugins',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Users', 'extendify-local'),
			text: __(
				'Add or manage users on your site, both admin users and others.',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-users',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Tools', 'extendify-local'),
			text: __(
				'Import/export post data, check site health, and edit theme or plugin files directly in the WordPress admin.',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-tools',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Settings', 'extendify-local'),
			text: __(
				'Advanced settings for your site and for certain plugins.',
				'extendify-local',
			),
			attachTo: {
				element: '#menu-settings',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('Collapse menu', 'extendify-local'),
			text: __(
				'Use this toggle to collapse or expand the sidebar menu.',
				'extendify-local',
			),
			attachTo: {
				element: '#collapse-menu',
				offset: {
					marginTop: 0,
					marginLeft: 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {},
		},
		{
			title: __('User', 'extendify-local'),
			text: __(
				'Manage your profile or log out of your account here.',
				'extendify-local',
			),
			attachTo: {
				element: '#wp-admin-bar-user-actions',
				offset: {
					marginTop: 0,
					marginLeft: -15,
				},
				position: {
					x: 'left',
					y: 'top',
				},
				hook: 'top right',
			},
			events: {
				beforeAttach: () => {
					const menu = document.querySelector(
						'#wp-admin-bar-my-account .ab-sub-wrapper',
					);
					menu.style.position = 'relative';
					menu.style.display = 'block';
				},
				onAttach: () => {
					const menu = document.querySelector(
						'#wp-admin-bar-my-account .ab-sub-wrapper',
					);
					menu.style.position = 'relative';
					menu.style.display = 'block';
					document.querySelector('#assist-tour-next-button')?.focus();
				},
				onDetach: () => {
					const menu = document.querySelector(
						'#wp-admin-bar-my-account .ab-sub-wrapper',
					);
					menu.style.position = 'absolute';
					menu.style.display = '';
				},
			},
		},
	],
};
