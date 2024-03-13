import {
	BusinessInformation,
	state as businessInfoState,
} from '@launch/pages/BusinessInformation';
import {
	Goals,
	goalsFetcher,
	goalsParams as goalsData,
	state as goalsState,
} from '@launch/pages/Goals';
import {
	HomeSelect,
	fetcher as homeSelectFetcher,
	fetchData as homeSelectData,
	state as homeSelectState,
} from '@launch/pages/HomeSelect';
import {
	PagesSelect,
	fetcher as pagesSelectFetcher,
	fetchData as pagesSelectData,
	state as pagesSelectState,
} from '@launch/pages/PagesSelect';
import {
	SiteInformation,
	fetcher as siteInfoFetcher,
	fetchData as siteInfoData,
	state as siteInfoState,
} from '@launch/pages/SiteInformation';
import {
	SiteTypeSelect,
	state as siteTypeState,
} from '@launch/pages/SiteTypeSelect';

// pages added here will need to match the orders table on the Styles base
const defaultPages = [
	[
		'site-type',
		{
			component: SiteTypeSelect,
			state: siteTypeState,
		},
	],
	[
		'site-title',
		{
			component: SiteInformation,
			fetcher: siteInfoFetcher,
			fetchData: siteInfoData,
			state: siteInfoState,
		},
	],
	[
		'goals',
		{
			component: Goals,
			fetcher: goalsFetcher,
			fetchData: goalsData,
			state: goalsState,
		},
	],
	[
		'layout',
		{
			component: HomeSelect,
			fetcher: homeSelectFetcher,
			fetchData: homeSelectData,
			state: homeSelectState,
		},
	],
	[
		'pages',
		{
			component: PagesSelect,
			fetcher: pagesSelectFetcher,
			fetchData: pagesSelectData,
			state: pagesSelectState,
		},
	],
	[
		'business-information',
		{
			component: BusinessInformation,
			state: businessInfoState,
		},
	],
];

const pages = defaultPages?.filter(
	(pageKey) => !window.extOnbData?.partnerSkipSteps?.includes(pageKey[0]),
);
export { pages };
