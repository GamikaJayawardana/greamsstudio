import { Icon } from '@wordpress/icons';
import { extendifyLogo } from '@library/icons/extendify-logo';
import { CategoryControl } from './CategoryControl';
import { SiteTypeControl } from './SiteTypeControl';

// import { SourceControl } from './SourceControl'

const { partnerLogo, partnerName } = window.extLibraryData;
export const Sidebar = () => {
	return (
		<div className="md:w-80 gap-6 flex-shrink-0 hidden md:flex flex-col">
			{partnerLogo ? (
				<div className="bg-banner-main p-6 py-0 flex justify-center">
					<div className="flex h-20 py-3 items-center justify-center w-40">
						<img
							className="max-h-full max-w-full"
							src={partnerLogo}
							alt={partnerName}
						/>
					</div>
				</div>
			) : (
				<div className="hidden py-3 px-5 text-extendify-black sm:flex sm:pt-5 -mb-5">
					<Icon icon={extendifyLogo} size={40} />
				</div>
			)}
			<div className="overflow-y-auto pb-16 flex flex-col gap-4">
				{/* TODO: This will eventually only show if the users has a license key  */}
				{/* <div className="hidden md:flex flex-col overflow-hidden px-4">
                    <SourceControl />
                </div> */}

				<div className="hidden md:flex flex-col px-4 overflow-x-hidden">
					<SiteTypeControl />
				</div>

				<div
					data-test="category-control"
					className="hidden md:flex flex-col px-4 overflow-x-hidden">
					<CategoryControl />
				</div>
			</div>
		</div>
	);
};
