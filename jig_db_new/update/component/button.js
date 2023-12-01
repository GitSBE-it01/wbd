export const btnUpdLoc = async(id1, id2, id3) => {
    try{
        const wrapper = document.createElement('div')
        wrapper.classList.add('fr', 'mh3');
        
        const btnAdd1 = document.createElement('button');
        btnAdd1.setAttribute('type', 'button');
        btnAdd1.id = id1;
        btnAdd1.textContent = 'update' ;
        btnAdd1.classList.add('mr4', 'btn1');

        const btnAdd2 = document.createElement('button');
        btnAdd2.setAttribute('type', 'button');
        btnAdd2.id = id2;
        btnAdd2.classList.add('mr4', 'button_minus');

        const btnAdd3 = document.createElement('button');
        btnAdd3.setAttribute('type', 'button');
        btnAdd3.id = id3;
        btnAdd3.classList.add('mr4', 'button_plus');

        wrapper.appendChild(btnAdd3);
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
        tr.classList.add('fr', 'tdCont2', 'pr4');
        
        // location
        const div1 =document.createElement('div');
        div1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input1 = document.createElement('input');
        input1.placeholder = 'select location';
        input1.setAttribute('type','text');
        input1.setAttribute('list','dataLokasi');
        input1.setAttribute('autocomplete','off');
        input1.setAttribute('data-new','');
        input1.id = `lokasi+${uniq}`;
        div1.appendChild(input1);
        
        // qty per unit
        const div2 =document.createElement('div');
        div2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
        const input2 = document.createElement('input');
        input2.classList.add('sl5', 'fc-w')
        input2.setAttribute('type','text');
        input2.id = `cur_qty_per_unit+${uniq}`;
        input2.setAttribute('data-new','');
        input2.setAttribute('readonly', 'readonly');
        div2.appendChild(input2);
            
        // add/substract
        const div3 =document.createElement('div');
        div3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input3 = document.createElement('select');
        const option = document.createElement('option');
        option.value = 'tambah';
        option.textContent = 'tambah';
        input3.appendChild(option);
        input3.id = `addSub+${uniq}`;
        input3.setAttribute('data-new','');
        div3.appendChild(input3);
            
        // qty
        const div4 =document.createElement('div');
        div4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input4 = document.createElement('input');
        input4.setAttribute('type','text');
        input4.id = `qty+${uniq}`;
        input4.setAttribute('data-new','');
        div4.appendChild(input4);
            
        // unit
        const div5 =document.createElement('div');
        div5.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input5 = document.createElement('input');
        input5.setAttribute('type','text');
        input5.id = `unit+${uniq}`;
        input5.setAttribute('data-new','');
        div5.appendChild(input5);
    
        // remark
        const div6 =document.createElement('div');
        div6.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input6 = document.createElement('input');
        input6.setAttribute('type','text');
        input6.id = `remark+${uniq}`;
        input6.setAttribute('data-new','');
        div6.appendChild(input6);

        // empty
        const div7 =document.createElement('div');
        div7.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
    
        tr.appendChild(div1);
        tr.appendChild(div2);
        tr.appendChild(div3);
        tr.appendChild(div4);
        tr.appendChild(div5);
        tr.appendChild(div6);
        tr.appendChild(div7);
        return tr;
    } catch(error){
        console.log(error);
    }
}

export const btnUpdJig = async() => {
    try{
        const wrapper = document.createElement('div')
        wrapper.classList.add('fr', 'm2', 'p1' );
        
        const btnAdd1 = document.createElement('button');
        btnAdd1.setAttribute('type', 'button');
        btnAdd1.id = 'updJig';
        btnAdd1.textContent = 'update' ;
        btnAdd1.classList.add('mr4', 'btn1');

        const btnAdd2 = document.createElement('button');
        btnAdd2.setAttribute('type', 'button');
        btnAdd2.id = 'editJig';
        btnAdd2.textContent = 'edit' ;
        btnAdd2.classList.add('mr4', 'btn1');

        wrapper.appendChild(btnAdd2);
        wrapper.appendChild(btnAdd1);
        return wrapper;
    } catch(error){
        console.log(error);
    }
}

export const btnUpdType = async(id1, id2, id3) => {
    try{
        const wrapper = document.createElement('div')
        wrapper.classList.add('fr', 'mh3');
        
        const btnAdd1 = document.createElement('button');
        btnAdd1.setAttribute('type', 'button');
        btnAdd1.id = id1;
        btnAdd1.textContent = 'update' ;
        btnAdd1.classList.add('mr4', 'btn1');

        const btnAdd2 = document.createElement('button');
        btnAdd2.setAttribute('type', 'button');
        btnAdd2.id = id2;
        btnAdd2.classList.add('mr4', 'button_minus');

        const btnAdd3 = document.createElement('button');
        btnAdd3.setAttribute('type', 'button');
        btnAdd3.id = id3;
        btnAdd3.classList.add('mr4', 'button_plus');

        wrapper.appendChild(btnAdd3);
        wrapper.appendChild(btnAdd2);
        wrapper.appendChild(btnAdd1);
        return wrapper;
    } catch(error){
        console.log(error);
    }
}

export const addNewType = async(uniq) => {
    try{
        const tr = document.createElement('div');
        tr.classList.add('fr', 'tdCont2', 'pr4');
        
        // item number jig
        const div1 =document.createElement('div');
        div1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input1 = document.createElement('input');
        input1.setAttribute('type','text');
        input1.setAttribute('data-addType','');
        input1.setAttribute('list','jig_suggest');
        input1.setAttribute('autocomplete','off');
        input1.id = `item_jig+new${uniq}`
        div1.appendChild(input1);
        tr.appendChild(div1);

        const arrDat = ['opt_on', 'opt_off'];
        for (let iii=0; iii<arrDat.length; iii++) {
            const div2 =document.createElement('div');
                div2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input2 = document.createElement('input');
            input2.classList.add('cap');
            input2.setAttribute('type','text');
            input2.setAttribute('data-addType','');
            input2.id = `${arrDat[iii]}+new${uniq}`
            div2.appendChild(input2);
            tr.appendChild(div2);
        }

        const div5 =document.createElement('div');
        div5.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input5 = document.createElement('input');
        input5.classList.add('cap', 'sl3', 'fc-w');
        input5.setAttribute('type','text');
        input5.value = "-";
        input5.disabled = true;
        input5.setAttribute('data-addType','');
        input5.id = `status+new${uniq}`
        div5.appendChild(input5);
        tr.appendChild(div5);


        const div3 =document.createElement('div');
        div3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
        const input3 = document.createElement('input');
        input3.classList.add('cap');
        input3.setAttribute('type','text');
        input3.id = `remark+new${uniq}`;
        input3.setAttribute('data-addType','');
        div3.appendChild(input3);

        const div4 =document.createElement('div');
        div4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
    
        tr.appendChild(div3);
        tr.appendChild(div4);
        return tr;
    } catch(error){
        console.log(error);
    }
}

