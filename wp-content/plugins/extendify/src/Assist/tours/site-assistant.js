import { __ } from '@wordpress/i18n';
// import { useGlobalStore } from '@assist/state/Global'
import { waitUntilExists } from '@assist/util/element';

export default {
	id: 'site-assistant-tour',
	settings: {
		allowOverflow: false,
		startFrom: [
			window.extAssistData.adminUrl +
				'admin.php?page=extendify-assist#dashboard',
		],
	},
	steps: [
		{
			title: __('Site Assistant', 'extendify-local'),
			text: __(
				'The Site Assistant gives you personalized recommendations and helps with creating and maintaining your site.',
				'extendify-local',
			),
			attachTo: {
				element: '#assist-menu-bar',
				offset: {
					marginTop: 20,
					marginLeft: -5,
				},
				position: {
					x: 'left',
					y: 'bottom',
				},
				hook: 'top left',
				boxPadding: {
					top: 5,
					bottom: 5,
					left: 5,
					right: 5,
				},
			},
			events: {},
		},
		{
			title: __('Tasks', 'extendify-local'),
			text: __(
				"Now that you've created your starter site, make it your own with these follow up tasks.",
				'extendify-local',
			),
			showOnlyIf: () => document.querySelector('.assist-tasks-module'),
			attachTo: {
				element: '#assist-tasks-module',
				offset: {
					marginTop: window.innerWidth <= 1151 ? -15 : 2,
					marginLeft: window.innerWidth <= 1151 ? -25 : 15,
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
			title: __('Recommendations', 'extendify-local'),
			text: __(
				'See our personalized recommendations for you that will help you accomplish your goals.',
				'extendify-local',
			),
			showOnlyIf: () =>
				document.querySelector('#assist-recommendations-module'),
			attachTo: {
				element: '#assist-recommendations-module',
				offset: {
					marginTop: window.innerWidth <= 1151 ? -15 : 2,
					marginLeft: window.innerWidth <= 1151 ? -25 : 15,
				},
				position: {
					x: 'right',
					y: 'top',
				},
				hook: 'top left',
			},
			events: {
				beforeAttach: () => waitUntilExists('#assist-recommendations-module'),
				onAttach: () => {
					document
						.querySelector('#assist-recommendations-module')
						?.scrollIntoView();
				},
			},
		},
		{
			title: __('Knowledge Base', 'extendify-local'),
			text: __(
				'Find articles with information on accomplishing different things with WordPress, including screenshots, and videos.',
				'extendify-local',
			),
			attachTo: {
				element: '#assist-knowledge-base-module',
				offset: {
					marginTop: window.innerWidth <= 1151 ? -15 : 2,
					marginLeft: window.innerWidth <= 1151 ? -25 : -15,
				},
				position: {
					x: window.innerWidth <= 1151 ? 'right' : 'left',
					y: 'top',
				},
				hook: window.innerWidth <= 1151 ? 'top left' : 'top right',
			},
			events: {
				beforeAttach: () => waitUntilExists('#assist-knowledge-base-module'),
				onAttach: () => {
					document
						.querySelector('#assist-knowledge-base-module')
						?.scrollIntoView();
				},
			},
		},
		{
			title: __('Tours', 'extendify-local'),
			text: __(
				'See additional tours of the different parts of WordPress. Restart your completed tours at any time.',
				'extendify-local',
			),
			attachTo: {
				element: '#assist-tours-module',
				offset: {
					marginTop: window.innerWidth <= 1151 ? -15 : 0,
					marginLeft: window.innerWidth <= 1151 ? -25 : -15,
				},
				position: {
					x: window.innerWidth <= 1151 ? 'right' : 'left',
					y: 'top',
				},
				hook: window.innerWidth <= 1151 ? 'top left' : 'top right',
			},
			events: {
				beforeAttach: () => waitUntilExists('#assist-tours-module'),
				onAttach: () => {
					document.querySelector('#assist-tours-module')?.scrollIntoView();
				},
			},
		},
		{
			title: __('Quick Links', 'extendify-local'),
			text: __(
				'Easily access some of the most common items in WordPress with these quick links.',
				'extendify-local',
			),
			attachTo: {
				element: '#assist-quick-links-module',
				offset: {
					marginTop: window.innerWidth <= 1151 ? -15 : 0,
					marginLeft: window.innerWidth <= 1151 ? -25 : -15,
				},
				position: {
					x: window.innerWidth <= 1151 ? 'right' : 'left',
					y: 'top',
				},
				hook: window.innerWidth <= 1151 ? 'top left' : 'top right',
			},
			events: {
				beforeAttach: () => waitUntilExists('#assist-quick-links-module'),
				onAttach: () => {
					document
						.querySelector('#assist-quick-links-module')
						?.scrollIntoView();
				},
			},
		},
		{
			title: __('Site Assistant', 'extendify-local'),
			text: __(
				'Come back to the Site Assistant any time by clicking the menu item.',
				'extendify-local',
			),
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
			events: {
				onAttach: () => {
					if (document.body.classList.contains('folded')) {
						document.body.classList.remove('folded');
						document.body.classList.add('temp-open');
					}
					document
						.querySelector('#extendify-assist-landing-page')
						.scrollIntoView({ block: 'start' });
				},
				onDetach: () => {
					if (document.body.classList.contains('temp-open')) {
						document.body.classList.remove('temp-open');
						document.body.classList.add('folded');
					}
				},
			},
		},
	],
};
