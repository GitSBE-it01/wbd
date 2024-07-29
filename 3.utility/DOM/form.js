export class InputDOM {
    static input_validity(inputKey) {
        let inp = '';
        if(inputKey.nodeType) {
            inp = inputKey;
        } else {
            inp = document.querySelector(inputKey);
        }
        if(inp && inp.hasAttribute('list')) {
            inp.addEventListener('keydown', function(event){
                if(event.key !== 'Enter') {
                    let valid = false;
                    let dtlist = document.querySelector(`#${inp.getAttribute('list')}`);
                    let opt = dtlist.querySelectorAll('option');
                    for( let i=0; i<opt.length; i++) {
                        if(opt[i].value.includes(event.target.value)) {
                            valid = true;
                            return;
                        }
                    }
                    if(!valid) {
                        inp.setCustomValidity("Data tidak termasuk dalam list");
                        inp.reportValidity();
                    }
                    return;
                }
            })

        }
    }

    
}