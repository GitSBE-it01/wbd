import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';
import {currentDate} from '../../3.utility/index.js';

const main = new DOM2();

const mstr = await api_access('fetch', 'pn_result', {data_date: currentDate('-')});
main.dtbase['master'] = mstr;

main.parse_input('#pick_table', main.dtbase['master']);
main.load_toggle();