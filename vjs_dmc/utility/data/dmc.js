import { currentDate } from '../process.js';
import { dmc_input} from '../class.js';
import { createBtn, dmcOk, dmcNg} from '../../component/index.js';

export const inpDMCProcess = async(data, decision, valueSearch) =>{
    const splitValue = valueSearch.value.split('/');
    const addInfo = {
        decs: decision,
        assetno: splitValue[0],
        assetkat: splitValue[1],
        cat: splitValue[2]
    }

    const cek = await dmc_input.fetchDataFilter({assetno:splitValue[0], input_date:currentDate(), dmc_vjs:'dmc'});
    const dmcInit = await initDMC(data, addInfo, decision);

    if (cek.length === 0) {
        const result = await dmc_input.insertData(dmcInit.update);
        if (!result.includes('fail')) {
            alert('data successfully inserted');
            document.getElementById('mainDMC').classList.add('displayHide');
        } else {
            alert('data is not inserted');
        }
        return;
    }

    let resultAll = '';
    if (cek[0]['decision'] !== decision) {
        for (let i=0; i<cek.length; i++) {
            let data3 ={'update':[],'filter':[]};
            data3.filter.id = [cek[i]['id']];
            data3.update.decision = [decision];
            const result = await dmc_input.updateData(data3);
            resultAll += " " + result;
        }
    }

    for (let i=0; i<dmcInit['update']['assetno'].length; i++) {
        let data2 ={'update':[],'filter':[]};
        const updateDt = Object.keys(dmcInit['update']);
        const filterDt = Object.keys(dmcInit['filter']);
        updateDt.forEach(dt => {
            if(!data2['update'][dt]) {
                data2['update'][dt] =[];
                data2['update'][dt].push(dmcInit['update'][dt][i]);
            } else {
                data2['update'][dt].push(dmcInit['update'][dt][i]);
            }
        })
        filterDt.forEach(dt => {
                data2['filter'][dt] = (dmcInit['filter'][dt][i]);
        })
        const result = await dmc_input.updateData(data2);
        resultAll += " " + result;
    }

    if (!resultAll.includes('fail')) {
        alert('data successfully updated');
        if (document.getElementById('dmcDiv')){
            document.getElementById('dmcDiv').remove();
        }
        const head = document.getElementById('hd2');
        if (decision === 'OK') {
            head.appendChild(await createBtn(dmcOk));
        } else {
            head.appendChild(await createBtn(dmcNg));
        }
        const mainDMC = document.getElementById('mainDMC');
        mainDMC.classList.add('displayHide');
    } else {
        alert('data is not updated');
    }
    return;
}

const initDMC = async(data, addInfo, decision) =>{
    const result = {
            update: {
                assetno:[],
                assetkat:[],
                inspection:[],
                std:[],
                unit:[],
                input_value:[],
                input_date:[],
                dmc_vjs:[],
                decision:[]
            },
            filter: {
                id:[]
            }
    };
    data.forEach(dt =>{
        if (dt.getAttribute('data-row') === 'change') {
            const detail = dt.querySelectorAll('[data-cell');
            result.update.assetno.push(addInfo.assetno);
            result.update.assetkat.push(addInfo.assetkat);
            result.update.decision.push(decision);
            result.update.dmc_vjs.push("dmc");
            result.update.input_date.push(currentDate());
            detail.forEach(dtl=> {
                if (dtl.getAttribute('data-cell').includes('inspection')) {result.update.inspection.push(dtl.textContent)};
                if (dtl.getAttribute('data-cell').includes('std')) {result.update.std.push(dtl.textContent)};
                if (dtl.getAttribute('data-cell').includes('unit')) {result.update.unit.push(dtl.textContent)};
                if (dtl.getAttribute('data-cell').includes('id')) {
                    const id = dtl.getAttribute('data-cell').split('___');
                    result.filter.id.push(id[1]);
                };
                if (dtl.getAttribute('data-cell').includes('input_value')) {result.update.input_value.push(dtl.value)};
            })
        }})
    return result;
}


