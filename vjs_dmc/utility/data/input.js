import { currentDate, splitCustomString } from '../process.js';
import { dataInput} from '../class.js';

export const inpDMCProcess = async(data) =>{
    const splitValue = await splitCustomString('/',data['srch'][0]);
    const arrDMCinp = {
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
        arrDMCinp.assetno.push(splitValue[0]);
        arrDMCinp.assetkat.push(splitValue[1]);
        arrDMCinp.inspection.push(data.inspection[i]);
        arrDMCinp.std.push(data.std[i]);
        arrDMCinp.unit.push(data.unit[i]);
        arrDMCinp.input_value.push(data.input_value[i]);
        arrDMCinp.input_date.push(currentDate());
        arrDMCinp.dmc_vjs.push("dmc");
        arrDMCinp.decision.push(data.decs[0]);
    }
    const cek = await cekDataDMC(arrDMCinp);
    console.log(cek);
    console.log(!cek['update']['assetno']);
    if (!cek['update']['assetno']) {
        const result = await dataInput.insertData(arrDMCinp);
        if (!result.includes('fail')) {
            alert('data successfully inserted');
            location.reload();
        } else {
            alert('data is not inserted');
        }
        return;
    }

    const result = await dataInput.updateData(cek);
    console.log(result);
    /*
    if (!result.includes('fail')) {
        alert('data successfully updated');
        location.reload();
    } else {
        alert('data is not updated');
    }*/
    return;
}

const cekDataDMC = async(data) =>{
    const dataSrc = await dataInput.fetchDataFilter({assetno:data.assetno[0], input_date:currentDate()});
    let data2 ={'update':[],'filter':[]};
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
            } else {
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