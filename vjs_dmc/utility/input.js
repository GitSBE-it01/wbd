import { currentDate, splitCustomString } from '../middleware/js/process.js';
import { dataInput} from '../middleware/js/class.js';

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
    cekDataDMC(arrDMCinp);
    // await dataInput.insertData(arrDMCinp);
}

const cekDataDMC = async(data) =>{
    const dataSrc = await dataInput.fetchDataFilter({assetno:data.assetno[0], input_date:currentDate()});
    console.log({dataSrc,data});
    console.log(dataSrc.length);
    console.log(data['assetno'].length);
    if (dataSrc.length>0) {
        for (let i=0; i<dataSrc.length; i++){
            const data1 = data['assetno'][i] + data['assetkat'][i] + data['inspection'][i] + data['std'][i] + data['unit'][i] + data['input_value'][i] + data['input_date'][i] + data['dmc_vjs'][i] + data['decision'][i]
            const data2 = dataSrc[i]['assetno'] + dataSrc[i]['assetkat'] + dataSrc[i]['inspection'] + dataSrc[i]['std'] + dataSrc[i]['unit'] + dataSrc[i]['input_value'] + dataSrc[i]['input_date'] + dataSrc[i]['dmc_vjs'] + dataSrc[i]['decision']
            console.log({data1,data2});
            if (data1 !== data2) {
                console.log('berubah');
                //await dataInput.updateData(arrDMCinp[i]);
            }
        }
    }
}