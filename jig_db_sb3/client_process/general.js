import {DOM} from '../../3.utility/index.js';

export const data_switch = (pick, array1, array2) =>{
  array1.forEach(dt=>{
    array2.forEach(d2=>{
      const fltr = dt+"_"+d2;
      if(dt===pick) {
        if(d2 === 'switch') {
          DOM.add_class(`#${fltr}`, 'bg-teal-600', 'text-xl', 'font-bold');
          DOM.rmv_class(`#${fltr}`, 'bg-teal-800');
        } else {
          DOM.rmv_class(`#${fltr}`, 'hidden');
        }
      } else {
        if(d2 === 'switch') {
          DOM.rmv_class(`#${fltr}`, 'bg-teal-600', 'text-xl', 'font-bold');
          DOM.add_class(`#${fltr}`, 'bg-teal-800');
        } else {
          DOM.add_class(`#${fltr}`, 'hidden');
        }
      }
    })
  })
}


