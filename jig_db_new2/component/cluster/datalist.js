export const dtlist =(src) =>{
    create ({
        element: 'datalist',
        selector: '#root',
        id: 'item',
    })   
    item.forEach(dt=>{
        create ({
            element: 'option',
            selector: '#item',
            value: dt.pt_part + '--' + dt.pt_desc1 + dt.pt_desc2 + '--' + dt.pt_status,
            textCont: dt.pt_part + '--' + dt.pt_desc1 + dt.pt_desc2 + '--' + dt.pt_status
        })  
    })
}