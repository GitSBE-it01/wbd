export const calculateMean = (data) =>{
    const sum = data.reduce((acc, val) => acc + val, 0);
    return sum / data.length;
  }
  
export const calculateStdDev = (data, mean) =>{
  let variance = 0;
  const lth = data.length;
  data.forEach(dt=>{
    variance += Math.pow((dt-mean),2) / (lth-1);
  })
  const result = Math.sqrt(variance);
  return result
}

export const calculateCP = (stdev, usl, lsl) =>{
  const result = (usl-lsl)/(6*stdev); 
  return result;
}

export const calculateCPK = (mean, standardDeviation, upperSpecLimit, lowerSpecLimit) =>{
  const CPK1 = (upperSpecLimit - mean) / (3 * standardDeviation);
  const CPK2 = (mean - lowerSpecLimit) / (3 * standardDeviation);
  return Math.min(CPK1, CPK2);
}

export const checkRange = (usl, lsl)=>{
  const diff = usl - lsl;
  let result = 0;
  if(diff>100) {return result = 0;}
  if(diff>10) {return result = 2;}
  if(diff>=1) {return result = 4;}
  if(diff<1) {return result = 6;}
}
