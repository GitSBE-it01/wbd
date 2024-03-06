export const header1 = {
        target:'dmcDivAll',
        id:'hd',
        style: ['textCenter', 'fs-xl','fw-bld', 'm3'],
        text:'Daily Maintenance'               
    };
export const header2 = {
        target:'dmcDivAll',
        id:'hd2',
        style: ['textCenter', 'fs-m', 'm1', 'pb4'],
        text:'Decision'               
    };

export const header3 = {
        target:'vjsDivAll',
        id:'hdVJS',
        style: ['textCenter', 'fs-xl','fw-bld', 'm3'],
        text:'Verifikasi Job Setup'               
    };

export const selection = {
        target:'hdSide',
        id:'hdList',
        style: ['fs-l', 'fw-bld', 'fc-w'],
        text:'List category'               
    };

export const headerListInsp = (tulisan) => ({
        target:'',
        id:'hdList2',
        style: ['fs-l', 'fw-blk'],
        text:tulisan
    });

export const header4 = (idTgt, counter) => ({
    target: idTgt,
    id:`hdVJS${counter}`,
    style: ['fs-l', 'm3'],
    text: `Verifikasi ${counter}`
});

export const inspection = {
    target:'',
    id:'hdList',
    style: ['fs-l', 'fw-bld', 'mx4'],
    text:'Add New Inspection'               
};