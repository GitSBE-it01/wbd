export const debug = async(data) => {
    const cont = document.createElement('div');
    cont.classList.add('h100', 'w100');
    const version = document.createElement('div');
    version.id = 'version';
    version.classList.add('px4', 'py2');
    version.textContent = 'timestamp' + " = " + data['timestamp'] + '\n';
    version.textContent += 'version' + " = " + data['version'] + '\n';
    cont.appendChild(version);
    const debug = document.createElement('div');
    debug.id = 'debug';
    debug.classList.add('overY', 'h100', 'px4', 'pt2')
    cont.appendChild(debug);
    const target = data['response'];
    if (typeof target === 'object' && !Array.isArray(target)) {
      const keys = Object.keys(target);
      keys.forEach(dt=>{
        debug.textContent += dt + " = " + target[dt] + '\n';
      })
    } 
    if (typeof target === 'object' && Array.isArray(target)) {
      target.forEach(dt=>{
        debug.textContent += JSON.stringify(dt) + '\n';
      })
    } 
    
    if (typeof target !== 'object') {
      debug.textContent += target;
    }
    return cont;
}