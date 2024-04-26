import {dataSection1} from '../../utility/index.js';

export const section1 = async(src) => {
    const sec1 = document.createElement('div');
    sec1.id = 'section1';
    const data = dataSection1(src);
    console.log(data);

}