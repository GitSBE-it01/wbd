export const jigList = (src) => ({
    target:'root',
    id:'jig_name',
    data: src,
    delimiter:' ',
    optValue:['item_jig'],
    optText:['item_jig', 'desc']
})

export const locList = (src) => ({
    target:'root',
    id:'locS',
    data: src,
    delimiter:' ',
    optValue:['name'],
    optText:['name']
})
