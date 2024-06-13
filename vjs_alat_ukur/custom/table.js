import {
    div,
    createTh,
    createTr,
    createTd,
    td_input,
    td_button,
    td_select,
    td_radio,
    td_span
} from '../1.asset/index.js'; 

export const mainTable = (dt, filter) =>{
        createTr({target:`[data-table = "${dt.sn_id}"]`,id: dt.data_group, filter: filter});
            createTd({target: `[data-tr = "${dt.data_group}"]`, field: 'trans_date',style:'bg-blue-300 border-2 text-lg border-black px-2 sticky top-[4vh] z-10', text:dt.trans_date });
            createTd({target: `[data-tr = "${dt.data_group}"]`, style:'bg-blue-300 border-2 text-lg border-black px-2 sticky top-[4vh] z-10', id: `user__${dt.data_group}`});
                td_input({
                    target: `[data-td = "user__${dt.data_group}"]`,
                    field: dt.user_input,
                    dtlist: '',
                })
            createTd({target: `[data-tr = "${dt.data_group}"]`, field:`approval_by`,style:'bg-blue-300 h-full border-2 text-lg border-black px-2 sticky top-[4vh] z-10 justify-right', text:dt.approval_by});
            createTd({target: `[data-tr = "${dt.data_group}"]`, style:'bg-blue-300 h-full border-2 text-lg border-black px-2 sticky top-[4vh] z-10 justify-right', id: `openHide__${dt.data_group}`});
                td_button({target: `[data-td = "openHide__${dt.data_group}"]`, field:`openBtn__${dt.data_group}`, style: 'open sticky top-[4vh] z-10 mt-[.3rem] w-6 h-6 hover:w-8 hover:h-8 duration-300 mr-4'})
                td_button({target: `[data-td = "openHide__${dt.data_group}"]`, field:`submit__${dt.data_group}`, style: 'enter sticky top-[4vh] right-8 z-10 mt-[.3rem] w-6 h-6 duration-300', disable:''})
        return;
    } 

export const secondTable = (dt, filter) => {
    createTr({target:`[data-table = "${dt.sn_id}"]`,id: `detail_${dt.data_group}__${dt.check_point}`, filter:filter, style:"hidden v-full w-full"});
    if(dt.check_point.toLowerCase() === 'remark' || dt.check_point.toLowerCase() === 'software' ) {
        createTd({target: `[data-tr = "detail_${dt.data_group}__${dt.check_point}`, field: 'check_point', text: dt.check_point , style: 'bg-slate-300 border-2 text-sm border-black p-2'});
        createTd({target: `[data-tr = "detail_${dt.data_group}__${dt.check_point}`, field: 'standard', text: dt.standard, style: 'bg-slate-300 border-2 text-sm border-black p-2'});
        createTd({target: `[data-tr = "detail_${dt.data_group}__${dt.check_point}`,id: `result__${dt.data_group}__${dt.check_point}`, style: 'row-span-3 bg-slate-100 border-2 text-sm border-black' });
            td_input({
                target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                field: dt.result, 
            })
        } else {
            createTd({target: `[data-tr = "detail_${dt.data_group}__${dt.check_point}`, field: 'check_point', text: dt.check_point , style: 'bg-slate-300 border-2 text-sm border-black p-2'});
            createTd({target: `[data-tr = "detail_${dt.data_group}__${dt.check_point}`, field: 'standard', text: dt.standard, style: 'bg-slate-300 border-2 text-sm border-black p-2'});
            createTd({target: `[data-tr = "detail_${dt.data_group}__${dt.check_point}`,id: `result__${dt.data_group}__${dt.check_point}`, style: 'border-2 bg-slate-100 text-sm border-black' });
            if(dt.result) {
                if(dt.result.toLowerCase() === 'ok') {
                    const target = document.querySelector(`[data-td="result__${dt.data_group}__${dt.check_point}"]`);
                    target.classList.toggle('bg-teal-400');
                    td_span({target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                        style: 'check block static right-0 h-6 w-6 z-10 ',
                    })
                    td_radio({
                        target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                        field: `result_${dt.data_group}`, ID:`opt1__${dt.data_group}__${dt.check_point}`, post:'right', text: 'OK', check:"",value:'ok',divStyle:'flex inline-block flex-row px-2', name:`${dt.data_group}__${dt.check_point}`
                    })
                } else {
                    if(dt.result.toLowerCase() === 'ng') {
                        td_span({target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`, style: 'cross block static right-0 h-6 w-6 z-10',
                        })
                    } else {
                        td_span({target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`, style: 'minus block static right-0 h-6 w-6 z-10',
                        })
                    }
                    td_radio({
                        target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                        field: `result_${dt.data_group}`,  ID:`opt1__${dt.data_group}__${dt.check_point}`, post:'right', text: 'OK',value:'ok',divStyle:'flex inline-block flex-row px-2', name:`${dt.data_group}__${dt.check_point}`
                    })
                }
                if(dt.result.toLowerCase() === 'ng') {
                    const target = document.querySelector(`[data-td="result__${dt.data_group}__${dt.check_point}"]`);
                    target.classList.toggle('bg-red-300');
                    td_radio({
                        target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                        field: `result_${dt.data_group}`,  ID:`opt2__${dt.data_group}__${dt.check_point}`, post:'left', text: 'NG', check:"",value:'ng',divStyle:'flex inline-block flex-row px-2', name:`${dt.data_group}__${dt.check_point}`
                    })
                } else {
                    td_radio({
                        target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                        field: `result_${dt.data_group}`,  ID:`opt2__${dt.data_group}__${dt.check_point}`, post:'left', text: 'NG', value:'ng',divStyle:'flex inline-block flex-row px-2',name:`${dt.data_group}__${dt.check_point}`
                    })
                }
            } else {
                td_span({target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`, style: 'minus block static right-0 h-6 w-6 z-10',
                })
                td_radio({
                    target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                    field: `result_${dt.data_group}`,  ID:`opt1__${dt.data_group}__${dt.check_point}`, post:'right', text: 'OK',value:'ok',divStyle:'flex inline-block flex-row px-2', name:`${dt.data_group}__${dt.check_point}`
                })
                td_radio({
                    target: `[data-td="result__${dt.data_group}__${dt.check_point}"]`,
                    field: `result_${dt.data_group}`,  ID:`opt2__${dt.data_group}__${dt.check_point}`, post:'left', text: 'NG', value:'ng',divStyle:'flex inline-block flex-row px-2',name:`${dt.data_group}__${dt.check_point}`
                })
            }
        }
    return;
    }
