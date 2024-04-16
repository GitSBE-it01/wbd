import { Data, DataDB } from  '/wbd/utilities/class.js';

export const loc = new Data('dbqad_live','loc_mstr');
export const inv = new Data('dbqad_live','ld_det');
export const wo = new Data('dbqad_live','wo_mstr');
export const wobb = new Data('dbqad_live','wod_det');
export const oh = new DataDB('dbqad_live','data_oh','ld_det', 'loc_mstr');