export const sort_array = (array, ...sort) =>{
    console.log({array, sort});
    return array.sort((a, b) => {
        for (let i = 0; i < sort.length; i++) {
            const splt = sort[i].split('::');
            const criteria = {property:splt[0], order:splt[1]}
            const { property, order } = criteria;
            const compareValue = a[property] - b[property];
            if (compareValue !== 0) {
              return order === 'asc' ? compareValue : -compareValue;
            }
        }
        return 0;
    });
}