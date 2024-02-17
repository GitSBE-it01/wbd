import { currentDate } from '../process.js';
import { dataInput} from '../class.js';

export const inpDMCProcess = async(data) =>{
    const dmcInit = await initDMC(data);
    const cek = await cekDataDMC(dmcInit);

    if (!cek['update']['assetno']) {
        const result = await dataInput.insertData(dmcInit);
        if (!result.includes('fail')) {
            alert('data successfully inserted');
            document.getElementById('mainDMC').classList.add('displayHide');
        } else {
            alert('data is not inserted');
        }
        return;
    }

    let resultAll = '';
    for (let i=0; i<cek['update']['assetno'].length; i++) {
        let data ={'update':[],'filter':[]};
        const updateDt = Object.keys(cek['update']);
        const filterDt = Object.keys(cek['filter']);
        updateDt.forEach(dt => {
            if(!data['update'][dt]) {
                data['update'][dt] =[];
                data['update'][dt].push(cek['update'][dt][i]);
            } else {
                data['update'][dt].push(cek['update'][dt][i]);
            }
        })
        filterDt.forEach(dt => {
                data['filter'][dt] = (cek['filter'][dt][i]);
        })
        const result = await dataInput.updateData(data);
        resultAll += " " + result;
    }

    if (!resultAll.includes('fail')) {
        alert('data successfully updated');
        location.reload();
    } else {
        alert('data is not updated');
    }
    return;
}

const initDMC = async(data) =>{
    const splitValue = await data['srch'][0].split('/');
    const result = {
        assetno:[],
        assetkat:[],
        inspection:[],
        std:[],
        unit:[],
        input_value:[],
        input_date:[],
        dmc_vjs:[],
        decision:[]
    }
    for (let i=0; i<data.inspection.length; i++) {
        result.assetno.push(splitValue[0]);
        result.assetkat.push(splitValue[1]);
        result.inspection.push(data.inspection[i]);
        result.std.push(data.std[i]);
        result.unit.push(data.unit[i]);
        result.input_value.push(data.input_value[i]);
        result.input_date.push(currentDate());
        result.dmc_vjs.push("dmc");
        result.decision.push(data.decs[0]);
    }
    return result;
}

const cekDataDMC = async(data) =>{
    const dataSrc = await dataInput.fetchDataFilter({assetno:data.assetno[0], input_date:currentDate()});
    let data2 ={'update':[],'filter':[]};
    let decision3 = "OK";
    if (dataSrc.length>0) {
        const keys = Object.keys(data);
        data['id']=[];
        for (let i=0; i<dataSrc.length; i++){
            const data1 = data['assetno'][i] + data['assetkat'][i] + data['inspection'][i] + data['std'][i] + data['unit'][i] + data['input_value'][i] + data['dmc_vjs'][i] + data['decision'][i];
            const data2 = dataSrc[i]['assetno'] + dataSrc[i]['assetkat'] + dataSrc[i]['inspection'] + dataSrc[i]['std'] + dataSrc[i]['unit'] + dataSrc[i]['input_value'] + dataSrc[i]['dmc_vjs'] + dataSrc[i]['decision'];
            data['id'].push(dataSrc[i]['id']);
            if (data1 === data2) {
                const keys = Object.keys(data);
                keys.forEach(key => {
                    delete data[key][i];
                })
            if (data['input_value'][i] === "NG") {
                decision3 = "NG";
            }
            }
        }
        keys.forEach(key => {
            data2['update'][key] = data[key].filter(element => element !== undefined);
        })
        data2['filter']['id'] = data['id'].filter(element => element !== undefined);
        return data2;
    }
    return data2;
}