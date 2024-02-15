export const navigation = { //nav list
    target:'root',
    tgtStyle:'flex-c',
    navStyle:['tl2', 'navCard2','flex-r'],
    mainStyle:['tl8', 'navCard1'],
    navi:[
            {
                link: '../../sbe/index.php',
                type: 'btn', // if btn then create a button, if txt then create span
                text: '', //if btn then empty
                divStyle:['mx5', 'mt2', 'scale-120'],
                linkStyle: ['home']
            },
            {
                link: 'index.php',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'home',
                divStyle:['ml5','mt3', 'scale-120'],
                linkStyle: ['f-tl7', 'fs-m', 'fw-blk']
            },
            {
                link: '#',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'kategori',
                divStyle:['ml5','mt3', 'scale-120'],
                linkStyle: ['f-tl7', 'fs-m', 'fw-blk']
            }
        ]
}
