/*======================================================================
preload process
======================================================================*/
document.addEventListener('DOMContentLoaded', async function() {
    const currentUrl = window.location.href;
    const specificUrls = 'http://192.168.2.103:8080/wbd/jig_db_new/transaksi';
    const extractedPortion = currentUrl.substring(0,specificUrls.length);
    if (extractedPortion == specificUrls){
        const role = document.getElementById('role');
    try {
        // showing loading div
        document.getElementById("loading").style.display="block";
        // get data
        const resultJig = await fetchedDataIndexDB('jig_database', 'dataStore_db', 'preload-jig_master', 'jig_master');
        const result = await dataPreLoad('jig_location');
        const result2 = await dataPreLoad('jig_trans');
        const result3 = await fetchedDataIndexDB('jig_database', 'dataStore_db', 'preload-list_location', 'list_location');
        const dlist =document.getElementById('locS');
        for (let i=0; i<result3.length; i++) {
            const option = document.createElement('option');
            option.value = result3[i].name;
            option.innerText = result3[i].name;
            dlist.appendChild(option);
        }

        const result2Map = {};
        for (const item of result2) {
            const code = item.code;
            if (!result2Map[code]) {
                result2Map[code] = [];
            }
            result2Map[code].push(item);
        }
        // create option list for filter
        const data = resultJig.map((obj1)=> {
            return {
                item_jig: obj1.item_jig,
                desc: obj1.desc_jig
            }
        })
        const datalistContain = document.getElementById('jig_name');
        for (let i=0; i<data.length; i++) {
            const option = document.createElement('option');
            option.value = data[i].item_jig;
            option.innerText = data[i].item_jig+ ' ' + data[i].desc;
            datalistContain.appendChild(option);
        }

        const typeMap = new Map();
        result.forEach(item => {
            if (typeMap.has(item.item_jig)) {
                const existingItem = typeMap.get(item.item_jig);
                existingItem.qty_total += parseInt(item.qty_per_unit);
            } else {
                const newItem = {
                item_jig: item.item_jig,
                qty_total: parseInt(item.qty_per_unit),
                };
                typeMap.set(item.item_jig, newItem);
            }
        });
        const summedData = Array.from(typeMap.values());
        const container = document.getElementById('display');
        // display data dari function di bawah 
        tableTrans(container,summedData,result,result2Map);

        // filter data
        const filter = document.getElementById('filterTrans');
        const search = document.getElementById('search');
        search.addEventListener("click", async () => {
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
            const filter1 = filter.value;
            // filter data and processes
            const filterData1 = summedData.filter(item => item.item_jig.toLowerCase().includes(filter1.toLowerCase()));
            tableTrans(container,filterData1,result,result2Map);
        })
        document.getElementById("loading").style.display="none";
        container.style.display='block';
        } catch (error) {
            console.log('error: ', error)
        }
    }
})

/*======================================================================
populate table
======================================================================*/
function tableTrans(a,b,c,d) {
    /*
    a = container
    b = summedData
    c = result
    d = result2Map
    div is for the container table
    table is for table div 
    table using div as view
    */
    const div = document.createElement('div');
    div.classList.add('card_contain');
    const table = document.createElement('div'); 
    
    // table main header (paling atas) HEADER 1
    const infoHeader = ` 
    <div class='tableFlex'>           
        <div class='tableData tableHeader'>item number jig</div>
        <div class='tableData tableHeader'>qty total</div>
        <div class='tableData tableHeader'>qty tersedia</div>
        <div class='tableData tableHeader'>qty di pinjam</div>
        <div class='tableData tableHeader'>detail</div>
    </div>`;
    table.innerHTML = infoHeader;

    // variable for empty variable
    let tData = [];
    let dataOri =[];
    let qtyCode = [];
    let qtyUse = [];


    // b = summedData, utk mendapatkan list item number jig (filter utama yang digunakan)
    for (let i=0; i<b.length; i++) {
        dataOri[`oriData${b[i].item_jig}`] = [];
        // hidden div dibagi menjadi 2, table dan form
        // hiddenHeader adalah table header utk hidden  HEADER 2
        const hiddenHeader = `
        <div class='tableFlex hideOn' id="openEdit-${b[i].item_jig}">
            <div class='tableRow'>
                <div class='tableFlex2'>          
                    <div class='tableData2 tableHeader2'>code</div>
                    <div class='tableData2 tableHeader2'>Lokasi</div>
                    <div class='tableData2 tableHeader2'>qty</div>
                    <div class='tableData2 tableHeader2'>tgl peminjaman</div>
                    <div class='tableData2 tableHeader2'></div>
                </div>`;
        
        // formAdd utk hidden div bagian form 
        const formAdd = `
            <div class='tableRow'>
                <form method='POST' class='columnView'>
                    <label>lokasi awal</label>
                    <input type="text" placeholder="lokasi awal" name='code' id='loc_${b[i].item_jig}' list='code_${b[i].item_jig}' oninput='qtyMax("${b[i].item_jig}")' value='' autocomplete="off">
                    <label>qty tersedia</label>
                    <input type="text" class='readonly' placeholder="qty" name='qty'  id='qty_${b[i].item_jig}' readonly>
                    <label>qty pinjam</label>
                    <input type="text" placeholder="qty" name='qtyPinjam' id='qtyPinjam_${b[i].item_jig}' autocomplete="off">
                    <label>peminjam</label>
                    <input type="text" placeholder="peminjam" name='locTarget' list='locS' autocomplete="off">
                    <input type='hidden' name='item' value='${b[i].item_jig}'>`;

        const buttonForm =`<button type='submit' name='dailyTrans'>submit</button>
            </form>
        </div>`;
    
        const footerForm =`</form></div>`;
        // create option utk datalist digunakan pada bagian form utk input locAwal 
        const optionContainer = document.createElement('datalist');
        optionContainer.id=(`code_${b[i].item_jig}`);

        // c = result, digunakan utk mencari data qty ori per code (PK dari item_jig per lokasi asal)
        const filterData2 = c.filter(item => item.item_jig ===`${b[i].item_jig}`);
        qtyUse[`qtyUse${b[i].item_jig}`] = 0; 
        // cek berapa banyak code per item number jig
        for (let ii=0; ii<filterData2.length; ii++){
            // utk perhitungan data total per lokasi dan per peminjam, kemudian di bandingkan( dikurangi)
            qtyCode[`qtyCode${c[i].code}`] = 0;
            // data per code
            let hiddenValue =[];
            const name = `${filterData2[ii].code}`;
            let qtyTersedia = 0;
            // jika tidak ada yang open maka kosong, jika tidak maka akan di keluarkan
            if (d[name] !== undefined ) {
                for (let iii=0; iii<d[name].length; iii++) {
                    qtyCode[`qtyCode${c[i].code}`] += parseInt(d[name][iii].qty);
                    qtyTersedia =parseInt(filterData2[ii].qty_per_unit) - parseInt(qtyCode[`qtyCode${c[i].code}`]);
                    // hiddenValue adalah value data table hidden utk isi data dari jig_transaction. hanya mengeluarkan semua data saja per code. 
                    hiddenValue += `
                    <form method="POST">
                        <div class='tableFlex2'>    
                            <input type='hidden' name='id' id='id_${d[name][iii].id}' value='${d[name][iii].id}'>
                            <div class='tableData2'id='codeData_${d[name][iii].code}'>${d[name][iii].code}</div>
                            <div class='tableData2'>${d[name][iii].loc}</div>
                            <div class='tableData2'>${d[name][iii].qty}</div>
                            <div class='tableData2'>${d[name][iii].start_date}</div>`;
                    
                    if( role.value === 'admin' || role.value === 'superuser'){
                        hiddenValue += `
                                <div class='tableData2'>
                                    <button id='return-' value='' name='return' >return</button>
                                </div>
                            </div> 
                        </form>`;
                    } else {
                        hiddenValue += `
                            </div> 
                        </form>
                            `;
                    }
                }
            } else {
                //qtyCode[`qtyCode${c[i].code}`] = parseInt(filterData2[ii].qty_per_unit);
                qtyTersedia = parseInt(filterData2[ii].qty_per_unit);
            }
            qtyUse[`qtyUse${b[i].item_jig}`] += qtyCode[`qtyCode${c[i].code}`];
             // hiddenValue adalah value data table hidden utk isi data dari jig_location. Disini ada summary utk qty tersedia merupakan pengurangan dari qty di lokasi tersebut dikurangi dengan yang dipinjam
             // dataOri digunakan sebagai tempat menampung semua html
            dataOri[`oriData${b[i].item_jig}`] += `
            <div class='tableFlex2'>         
                <div class='tableOri'>${filterData2[ii].code}</div>
                <div class='tableOri'>${filterData2[ii].lokasi}</div>
                <div class='tableOri'>${parseInt(filterData2[ii].qty_per_unit) - qtyCode[`qtyCode${c[i].code}`]}</div>
                <div class='tableOri'></div>
                <div class='tableOri'>Jig Tersedia</div>
            </div>`;
            // populate data utk datalist
            const option = document.createElement('option');
            option.value = 'code/' + `${filterData2[ii].code}` + '/qty_tersedia/' + `${qtyTersedia}`;
            option.innerText = `${filterData2[ii].lokasi}`;
            optionContainer.appendChild(option);
            // data hidden value ditambahkan ke data asli utama
            dataOri[`oriData${b[i].item_jig}`] += hiddenValue;
        }
        // populate data utk data summary per item number jig. yang masalah adalah bagaimana hitung summary qty yg ada, qty terpakai dan tidak terpakai
        const tableValueData = `
        <div class='tableFlex'>
            <div class='tableData'>${b[i].item_jig}</div>
            <div class='tableData'>${b[i].qty_total}</div>
            <div class='tableData'>${b[i].qty_total- qtyUse[`qtyUse${b[i].item_jig}`]}</div>
            <div class='tableData'>${qtyUse[`qtyUse${b[i].item_jig}`]}</div>
            <div class='tableData'>
                <button type="button" id="${b[i].item_jig}"  onclick='openHide(event)'>open</button>
            </div>
        </div>
        `;

        // memasukkan option ke container utama
        a.appendChild(optionContainer);
        // footer terakhir utk menutup div
        const footer = `
            </div>
        `;

        // input semua data ke tData. tData adalah table body utama.
        if (role.value === 'admin' || role.value === 'superuser'){
        tData += tableValueData+ hiddenHeader + dataOri[`oriData${b[i].item_jig}`] + footer + formAdd + buttonForm + footer;
        } else {
        tData += tableValueData+ hiddenHeader + dataOri[`oriData${b[i].item_jig}`] + footer + formAdd + footerForm + footer;
        }
    }

    const all = infoHeader + tData ;
    table.innerHTML = all;
    div.appendChild(table);
    a.appendChild(div);
}

function qtyMax(type) {
    const idTarget = document.getElementById(`loc_${type}`);
    const idValue = document.getElementById(`qty_${type}`);
    const valueInput = idTarget.value;
    const delimiter = "/";
    const qtyMax = valueInput.split(delimiter);
    idValue.value = qtyMax[qtyMax.length - 1];
}

document.addEventListener("input", function(event) {
   if (event.target.getAttribute('id').includes('qtyPinjam_')) {
    const target = event.target.getAttribute('id');
    const targetID = document.getElementById(target);
    const delimiter = "_";
    const split = target.split(delimiter);
    const inputID = document.getElementById(`qty_${split[1]}`);
    const valueStd = inputID.value;
    const value = event.target.value;
    if (parseInt(valueStd) < parseInt(value)) {
        targetID.value= 'qty yang dimasukkan lebih besar dari yang tersedia';
    }
   } 
})
