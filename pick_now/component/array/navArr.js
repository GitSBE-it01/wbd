export const navigation = { //nav list
    target:'root',
    tgtStyle:'flex-c',
    id: 'navID',
    navStyle:['sl2', 'navCard2','flex-r'],
    mainStyle:['sl8', 'navCard1'],
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
                text: 'Home',
                divStyle:['ml5','mt3', 'scale-120'],
                linkStyle: ['f-sl7', 'fs-m', 'fw-blk']
            }
        ]
}

export const sidebarHome = { //nav list
    target:'main',
    tgtStyle:'flex-r',
    id: 'sideHome',
    navStyle:['sl3', 'cl2', 'sideCard2','flex-c'],
    mainStyle:['sl9', 'cl10', 'sideCard1'],
    navi:[
            {
                link: '#section1',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section1', //if btn then empty
                divStyle:['ml5', 'mb2', 'mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section2',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section2',
                divStyle:['ml5', 'mb2','mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section3',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section3', //if btn then empty
                divStyle:['ml5', 'mb2', 'mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section4',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section4',
                divStyle:['ml5', 'mb2','mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section5',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section5', //if btn then empty
                divStyle:['ml5', 'mb2', 'mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section6',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section6',
                divStyle:['ml5', 'mb2','mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section7',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section7', //if btn then empty
                divStyle:['ml5', 'mb2', 'mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
            {
                link: '#section8',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'section8',
                divStyle:['ml5', 'mb2','mt4', 'scale-120'],
                linkStyle: ['fc-w', 'fs-m', 'fw-blk']
            },
        ]
}