export const calculateMean = (data) =>{
    const sum = data.reduce((acc, val) => acc + val, 0);
    return sum / data.length;
  }
  
export const calculateStdDev = (data) =>{
  const mean = calculateMean(data);
  const squaredDifferences = data.map(val => (val - mean) ** 2);
  const variance = calculateMean(squaredDifferences);
  return Math.sqrt(variance);
}

export const calculateCP = (mean, standardDeviation, upperSpecLimit, lowerSpecLimit) =>{
  const processSpread = 6 * standardDeviation;
  const specificationSpread = upperSpecLimit - lowerSpecLimit;
  return specificationSpread / processSpread;
}

export const calculateCPK = (mean, standardDeviation, upperSpecLimit, lowerSpecLimit) =>{
  const CPK1 = (upperSpecLimit - mean) / (3 * standardDeviation);
  const CPK2 = (mean - lowerSpecLimit) / (3 * standardDeviation);
  return Math.min(CPK1, CPK2);
}