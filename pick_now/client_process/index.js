import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';
import {currentDate} from '../../3.utility/index.js';

const main = new DOM2();
const mstr = await api_access('patch_P1.ASSY', 'pn_fix', '');
main.view_init('table','pick', mstr);
main.load_toggle();

main.func(
    'change',
    '#filter__dept_pick',
    async(e)=>{
        main.load_toggle();
        const val = e.target.value;
        const data = await api_access('patch_'+val, 'pn_fix', '');
        main.view_init('table','pick', data);
        main.load_toggle();
        return;
    }
)