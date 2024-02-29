import { vjs_asset, asset } from "../../utility/class.js";

const assetDt = await vjs_asset.getData();
export const assetList = {
    target:'root',
    id:'asset_list',
    data:assetDt,
    delimiter:'/',
    optValue:['assetno', 'assetkategori','vjs_kategory'],
    optText:['assetno', 'assetkategori', 'assetname', 'location']
}


export const woList = (src) => ({
    target:'root',
    id:'woList',
    data: src,
    delimiter:' -- ',
    optValue:['wo_lot', 'wo_part', 'pt_desc1'],
    optText:['wo_lot']
})


export const allAsset = (src) => ({
    target:'root',
    id:'all_asset',
    data:src,
    delimiter:'/',
    optValue:['assetno', 'assetkategori', 'id'],
    optText:['assetno', 'assetkategori', 'assetname', 'location']
})