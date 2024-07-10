/*
import {Data} from '../../3.utility/class.js';
export const master = new Data('vjs_alat_ukur_master');
export const point = new Data('vjs_alat_ukur_point');
export const vjs_log = new Data('vjs_alat_ukur_vjs_log');
export const reff = new Data('vjs_alat_ukur_reff');
*/

import {api_access} from '../../3.utility/index.js';
export const master = await api_access('get','vjs_alat', '');
export const point = await api_access('vjs_point');
export const vjs_log = await api_access('vjs_log');
export const reff = await api_access('vjs_reff');
