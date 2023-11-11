export const btnUpdLoc = async() => {
    try{
        const wrapper = document.createElement('div')
        wrapper.classList.add('fr', 'mh3');
        
        const btnAdd1 = document.createElement('button');
        btnAdd1.id = 'updLoc';
        btnAdd1.textContent = 'update' ;
        btnAdd1.classList.add('mr4', 'btn1');
        btnAdd1.setAttribute('type', 'button');

        const btnAdd2 = document.createElement('button');
        btnAdd2.id = 'addLoc';
        btnAdd2.textContent = 'add new';
        btnAdd2.classList.add('mr4', 'btn1');
        btnAdd2.setAttribute('type', 'button');

        wrapper.appendChild(btnAdd2);
        wrapper.appendChild(btnAdd1);
        return wrapper;
    } catch(error){
        console.log(error);
    }
}


export const addNewStock = async(uniq) => {
    try{
        const tr = document.createElement('div');
        tr.classList.add('fr', 'tdCont2');
        
        // location
        const div1 =document.createElement('div');
        div1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input1 = document.createElement('input');
        input1.placeholder = 'select location';
        input1.setAttribute('type','text');
        input1.setAttribute('list','location_ListAll');
        input1.setAttribute('autocomplete','off');
        input1.setAttribute('data-input','');
        input1.id = `item_jig-${uniq}`;
        div1.appendChild(input1);
        
        // qty per unit
        const div2 =document.createElement('div');
        div2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
        const input2 = document.createElement('input');
        input2.classList.add('sl5', 'fc-w')
        input2.setAttribute('type','text');
        input2.id = `qty_per_unit-${uniq}`;
        input2.setAttribute('data-input','');
        input2.setAttribute('readonly', 'readonly');
        div2.appendChild(input2);
            
        // add/substract
        const div3 =document.createElement('div');
        div3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input3 = document.createElement('select');
        const arr = ['tambah', 'kurang'];
        for (let i=0; i<arr.length; i++) {
            const option = document.createElement('option');
            option.value = arr[i];
            option.textContent = arr[i];
            input3.appendChild(option);
        }
        input3.id = `addSub-${uniq}`;
        input3.setAttribute('data-input','');
        div3.appendChild(input3);
            
        // qty
        const div4 =document.createElement('div');
        div4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input4 = document.createElement('input');
        input4.setAttribute('type','text');
        input4.id = `qty-${uniq}`;
        input4.setAttribute('data-input','');
        div4.appendChild(input4);
            
        // unit
        const div5 =document.createElement('div');
        div5.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input5 = document.createElement('input');
        input5.setAttribute('type','text');
        input5.id = `unit-${uniq}`;
        input5.setAttribute('data-input','');
        div5.appendChild(input5);
    
        // remark
        const div6 =document.createElement('div');
        div6.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input6 = document.createElement('input');
        input6.setAttribute('type','text');
        input6.id = `remark-${uniq}`;
        input6.setAttribute('data-input','');
        div6.appendChild(input6);
    
        tr.appendChild(div1);
        tr.appendChild(div2);
        tr.appendChild(div3);
        tr.appendChild(div4);
        tr.appendChild(div5);
        tr.appendChild(div6);
        return tr;
    } catch(error){
        console.log(error);
    }
}
