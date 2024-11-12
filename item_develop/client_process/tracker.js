import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';

const main = new DOM2();
const master = await api_access('fetch', 'id_dtl', {status:'open'});

main.view_init('table','idev', master);
main.load_toggle();
