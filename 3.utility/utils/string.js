export const removeSpaces = (str, replaceChar) => {
    const regex = /\s/g;
    return str.replace(regex, replaceChar);
  }