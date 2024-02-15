import { vjs_asset } from "../../utility/class.js";

const assetDt = await vjs_asset.getData();
export const assetList = {
    target:'root',
    id:'asset_list',
    data:assetDt,
    delimiter:'/',
    optValue:['assetno', 'assetkategori','vjs_kategory'],
    optText:['assetno', 'assetkategori', 'assetname', 'location']
}