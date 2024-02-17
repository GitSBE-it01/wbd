const initVJS = async(data) =>{
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