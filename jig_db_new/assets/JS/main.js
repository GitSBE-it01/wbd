function toggleHiddenDiv(classTarget, targetId) {
  const hiddenDiv = document.getElementById(classTarget + targetId);
  const button = event.target; // Get the clicked button element

  // Check the current display property and toggle it
  if (hiddenDiv.style.display === "none") {
    hiddenDiv.style.display = "block";// Change the button text to "close"
  } else {
    hiddenDiv.style.display = "none";// Change the button text back to "open"
  }
}

function addActive(sectionId) {
  const sections = document.querySelectorAll(".hidden_add");
  const navLinks = document.querySelectorAll(".nav-link");
  // Add 'active' class to the corresponding navigation link
  navLinks.forEach(function(link) {
      link.classList.remove("aktif");
  });
  
  const clickedLink = document.querySelector(`[href="#${sectionId}"]`);
  clickedLink.classList.add("aktif");

  // Show the clicked section and hide others
  sections.forEach(function(section) {
    if (section.getAttribute("id") === sectionId) {
      section.classList.add("aktif");
    } else {
      section.classList.remove("aktif");
    }
  });
}

function enterProcess(event,param) {
  const target = document.getElementById(param);
  if (event.key === 'Enter') {
      target.click();
  }
}

/*======================================================================
click event to open and close hidden div (for transaction)
======================================================================*/
function openHide(event) {
  const buttonId = event.target.id;
  const buttonTarget = document.getElementById(buttonId);
  const target = document.getElementById(`openEdit-${buttonId}`);
  if (buttonTarget.innerText ==='open') {
      target.classList.remove('hideOn');
      buttonTarget.innerText='close';
  } else {
      target.classList.add('hideOn');
      buttonTarget.innerText='open';
  }
}

function openHide2(event, trgt, cls) {
  const cekVal = event.target.id.split('__');
  const buttonTarget = event.target;
  const query = trgt+"__"+cekVal[1]
  const target = document.querySelector(`[data-row="${query}"]`);
  if (buttonTarget.innerText ==='open') {
      target.classList.remove(cls);
      buttonTarget.innerText='close';
  } else {
      target.classList.add(cls);
      buttonTarget.innerText='open';
  }
}
/*==============================================================================================
Button add
==============================================================================================*/
/*--------------------------------------------------- 
target = div or any other tag which the form will be added too
id = array name id because it is an input and i want to add them to 1 place
i need to put this as an array == style, inputClass, inputID, typeInput, textHolder
array example : 
[{style:"", inputClass:"", inputID:"", typeInput: "text", textHolder: "filter", listName:""}]
---------------------------------------------------*/
function addTableInput(target, tdClass, arr) {
  let trCount = arr.length;
  let container = document.getElementById(target);
  let rowTable = document.createElement('tr');

  for (let i = 0; i < trCount; i++) {
    let dataTable = document.createElement('td');
    dataTable.className = tdClass;
    const inputElement = document.createElement('input');
    inputElement.type= arr[i].typeInput;
    inputElement.className= arr[i].style;
    inputElement.name= arr[i].inputName;
    inputElement.id= arr[i].inputID;
    inputElement.placeholder= arr[i].textHolder;
    inputElement.setAttribute ('list', arr[i].listName);
    inputElement.setAttribute ('data-cell', arr[i].dcell);
    dataTable.appendChild(inputElement);
    rowTable.appendChild(dataTable);
  }
  container.appendChild(rowTable);
  // Append the input element to the container
}

function addTableInputWithOption(target, tdClass, arr) {
  let trCount = arr.length;
  let container = document.getElementById(target);
  let rowTable = document.createElement('tr');

  for (let i = 0; i < trCount; i++) {
    let dataTable = document.createElement('td');
    dataTable.className = tdClass;
    const inputElement = document.createElement('input');
    inputElement.className= arr[i].style;
    inputElement.type= arr[i].typeInput;
    inputElement.name= arr[i].inputName;
    inputElement.id= arr[i].inputID+i;
    inputElement.placeholder= arr[i].textHolder;
    inputElement.setAttribute ('onfocus', arr[i].arr2);
    dataTable.appendChild(inputElement);
    rowTable.appendChild(dataTable);
  }
  container.appendChild(rowTable);
  // Append the input element to the container
}


function deleteValue(target, input, arr) {
  const targetID = document.getElementById(target);
  const inputID = document.getElementById(input);
  
  if (!Array.isArray(arr) || arr.length < 2) {
    console.error('Invalid arr parameter: Expected an array with at least 2 elements.');
    return;
  }

  if (inputID.innerText == arr[1].button) {
    targetID.value = arr[0].target;
    inputID.innerText = arr[0].button;
  } else {
    targetID.value = arr[1].target;
    inputID.innerText = arr[1].button;
  }
  
}

/*==============================================================================================
Preload
==============================================================================================*/
/*--------------------------------------------------- 
function 
---------------------------------------------------*/
async function dataPreLoad(params) {
  try {
      const response = await fetch('http://192.168.2.103:8080/wbd/jig_db_new/api.php', {
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({parameters: params})
      });
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      const result = await response.json();
      return result;
  } catch (error) {
      console.error('Error:', error);
      return Promise.reject(error);
  }
}

async function fetchDataWild(params, wildcard) {
  try {
      const response = await fetch('http://192.168.2.103:8080/wbd/jig_db_new/api_history.php', {
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({parameters: params, wildcard: wildcard})
      });
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      const result = await response.json();
      return result;
  } catch (error) {
      console.error('Error:', error);
      return Promise.reject(error);
  }
}

async function fetchData(params) {
  try {
      const response = await fetch('http://192.168.2.103:8080/wbd/jig_db_new/api_live.php', {
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({parameters: params})
      });
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      const result = await response.json();
      return result;
  } catch (error) {
      console.error('Error:', error);
      return Promise.reject(error);
  }
}

async function endPoint(action, params) {
  try {
      const response = await fetch('http://192.168.2.103:8080/wbd/jig_db_new/api2.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({actions: action, parameters: params})
      });
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      const result = await response.text();
      console.log(result);
  } catch (error) {
      console.error('Error:', error);
      return Promise.reject(error);
  }
}


function openDatabase(dbName, objectStoreName) {
  const request = window.indexedDB.open(dbName);
  return new Promise((resolve, reject) => {
      request.onerror = function(event) {
          reject("Database error: " + event.target.errorCode);
      };

      request.onupgradeneeded = function(event) {
          const db = event.target.result;
          db.createObjectStore(objectStoreName, { keyPath: 'storageKey' })
      };

      request.onsuccess = function(event) {
          const db = event.target.result;
          resolve(db);
      };
  });
}

async function fetchedDataIndexDB(dbName, storeName, storageKey, parameter) {
  try {
      const db = await openDatabase(dbName, storeName);
      const transaction = db.transaction([storeName], 'readonly');
      const store = transaction.objectStore(storeName);
      const getRequest = store.get(storageKey);
      const cachedData = await new Promise((resolve, reject) => {
          getRequest.onsuccess = event => {
              resolve(event.target.result);
          };
          getRequest.onerror = event => {
              reject(event.target.error);
          };
      });
      if (cachedData) {
          const expirationTime = 60 * 60 * 1000;
          const currentTime = new Date().getTime();
          if (cachedData.timestamp && currentTime - cachedData.timestamp < expirationTime) {
              transaction.abort();
              db.close();
              return cachedData.data;
          }
      }
      const fetchedData = await dataPreLoad(parameter);
      const writeTransaction = db.transaction(storeName, 'readwrite');
      const writeStore = writeTransaction.objectStore(storeName);
      const timestampedData = {
          storageKey: storageKey,
          timestamp: new Date().getTime(),
          data: fetchedData
      };
      await new Promise((resolve, reject) => {
          const addRequest = writeStore.put(timestampedData);
          addRequest.onsuccess = event => {
              resolve();
          };
          addRequest.onerror = event => {
              reject(event.target.error);
          };
      });
      writeTransaction.oncomplete = () => {
          db.close();
      };
      return fetchedData;
  } catch (error) {
      console.error("Error:", error);
  }
}

function deleteDataFromStore(db, storeName, key) {
  return new Promise((resolve, reject) => {
      const transaction = db.transaction([storeName], "readwrite");
      const objectStore = transaction.objectStore(storeName);

      const request = objectStore.delete(key);

      request.onsuccess = function(event) {
          resolve("Data deleted");
      };

      request.onerror = function(event) {
          reject("Error deleting data from the database");
      };
  });
}

/*------------------------------------------------- 
populate data
---------------------------------------------------*/
async function populateOption(targetOption, dbName, storeName, storageKey, parameter, arr) {
  let result = await fetchedDataIndexDB(dbName, storeName, storageKey, parameter);
  let datalist = document.getElementById(targetOption);
  const data = result.map((obj1) => {
    return {
      [arr[0]]: obj1[arr[0]],
      [arr[1]]: obj1[arr[1]]
  }
});
  for (let i = 0; i < data.length; i++) {
    const option = document.createElement('option');
    option.value = data[i][arr[0]]; 
    option.innerText = data[i][arr[0]] + "  --  " +data[i][arr[1]]; 
    datalist.appendChild(option);
  }
}

async function populateJoinOption(targetOption, dbName, storeName, storageKey1, parameter1, storageKey2, parameter2, arr) {
  let result1 = await fetchedDataIndexDB(dbName, storeName, storageKey1, parameter1);
  let result2 = await fetchedDataIndexDB(dbName, storeName, storageKey2, parameter2);
  let datalist = document.getElementById(targetOption);
  const data = result1.map((obj1) => {
    const matchedObj = result2.find((obj2) => obj2[arr[4]] === obj1[arr[4]]);
    return {
      [arr[0]]: obj1[arr[0]],
      [arr[1]]: matchedObj ? matchedObj[arr[1]]: undefined,
    } 
  });
    for (let i = 0; i < data.length; i++) {
      const option = document.createElement('option');
      option.value = data[i][arr[0]]; 
      option.innerText = data[i][arr[1]]; 
      datalist.appendChild(option);
    }
}

function tableData(data, target, classTable, idTbody, thClass, trClass, arr1, arr2) {
  const table = document.createElement('table');
  table.classList.add(classTable);
  const tableBody = document.createElement('tbody');
  tableBody.setAttribute('id',idTbody);
  target.appendChild(table);
  let tr = document.createElement('tr');
  // outside table
  //table header 
  for (let i = 0; i < arr1.length; i++) {
      let th = document.createElement('th');
      th.className = thClass;
      th.innerText = arr1[i];
      tr.appendChild(th);
      }
  tableBody.appendChild(tr);
  // insert data ke table header
  for (let i = 0; i < data.length; i++) {
      const clonedTr = tr.cloneNode(false);
      // masukkan data sesuai keyArray2 diatas
      for (let ii = 0; ii < arr2.length; ii++) {
          let value = data[i][arr2[ii]] !== undefined ? data[i][arr2[ii]] : '';
          const td = document.createElement('td');
          td.className = trClass;
          td.innerText = value;
          clonedTr.appendChild(td);
          }
      tableBody.appendChild(clonedTr);
  }
  table.appendChild(tableBody);
}




/*------------------------------------------------- 
filters
---------------------------------------------------
const filters = [];

// Function to apply all filters to data
function applyFilters(data, filters) {
  return data.filter(item => filters.every(filter => filter(item)));
}

// Example of adding filters
function addFilter(fieldName, filterValue, target) {
  const filterFunction = item =>
    item[fieldName].toLowerCase().includes(filterValue.toLowerCase());
  target.push(filterFunction);
}*/



