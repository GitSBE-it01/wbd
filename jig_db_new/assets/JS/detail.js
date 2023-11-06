function addDetailInput() {
    var inputContainer = document.getElementById("inputContainer");
    var newInput = document.createElement("input");
    newInput.type = "text";
    newInput.name = "input[]";
    newInput.required = true;
    inputContainer.appendChild(newInput);
}

/*async function loadSuggestions() {
  const selectElement = document.getElementById('selectValue0');
  const selectedFileName = selectElement.value;
  const codeFileName = '<?php echo ../cache/ . md5(selectedFileName) . .JSON ?>'
  try {
    const response = await fetch(selectedFileName);
    const data = await response.json();
    const suggestions = data.data.map(item => item.name);
    console.log(suggestions);
    return suggestions;
  } catch (error) {
    console.error('Error loading suggestions:', error);
    return [];
  }
}

async function loadSuggestions() {
  const selectElement = document.getElementById('selectValue0');
  const selectedFileName = selectElement.value;

  try {
    const url = `../suggest.php?selectedFileName=${encodeURIComponent(selectedFileName)}`;
    const response = await fetch(url);
    console.log(response);
    const data = await response.json();
    console.log(data);
    const suggestions = data.data.map(item => item.name);
    console.log(response);

    return suggestions;
  } catch (error) {
    console.error('Error loading suggestions:', error);
    return [];
  }
}*/


async function loadSuggestions() {
  const selectElement = document.getElementById('selectValue0');
  const selectedFileName = selectElement.value;

  try {
    const url = `../suggest.php?selectedFileName=${encodeURIComponent(selectedFileName)}`;
    const response = await fetch(url);
    const data = await response.json();

    // Access the jsonFileURL from the response data
    const jsonFileURL = data.url;

    console.log('JSON File URL:', jsonFileURL);

    // Continue with your code to use the jsonFileURL as needed
    // For example, you can make another AJAX request to fetch the JSON data using this URL

    // Placeholder for fetching JSON data using the jsonFileURL
    const jsonDataResponse = await fetch('../cache/'+jsonFileURL);
    const jsonData = await jsonDataResponse.json();
    console.log('JSON Data:', jsonData);

    // Do whatever you need to do with the jsonData here

    // Return any relevant data, if needed
    const suggestions = jsonData.map(item => item[selectedFileName]);
    console.log(suggestions);
    populateDatalist(suggestions);

    return suggestions;
  } catch (error) {
    console.error('Error loading suggestions:', error);
    return [];
  }
}

// Function to populate the datalist with suggestions
function populateDatalist(suggestions) {
  const suggestionsContainer = document.getElementById('suggestionsContainer');
  suggestionsContainer.innerHTML = '';

  suggestions.forEach(suggestion => {
    const option = document.createElement('div');
    option.textContent = suggestion;
    suggestionsContainer.appendChild(option);
  });
}

/*async function populateDatalist() {
  const suggestions = await loadSuggestions();
  const datalist = document.getElementById('datasuggest');

  suggestions.forEach(suggestion => {
    const option = document.createElement('option');
    option.value = suggestion;
    datalist.appendChild(option);
  });
}*/

document.addEventListener('DOMContentLoaded', () => {
  loadSuggestions();
});


function showSelectedURL() {
  const selectElement = document.getElementById('selectValue0');
  const selectedURL = selectElement.value;
  console.log(selectedURL);
}

function ExcelTemplate() {
  var title = "Member Loan Import";

  let file = XLSX.utils.table_to_book($("#template1")[0], { sheet: "Sheet" });
  let name = `${title}.xlsx`;
  return XLSX.writeFile(file, name);
}



function runPhpFunction() {
  const selectedValue = document.getElementById('selectValue0').value;
  const xhr = new XMLHttpRequest();
  const url = `../suggest.php?value=${encodeURIComponent(selectedValue)}`;

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      // Now you have the JSON response as an array in 'response'
      // You can use it as needed, for example, to create <option> tags
      const resultContainer = document.getElementById('resultContainer');
      resultContainer.innerHTML = ''; // Clear any previous results

      // Loop through the response array and create <option> tags for each result
      response.forEach(function(result) {
        const option = document.createElement('option');
        option.value = result; // Assuming the result is a string
        resultContainer.appendChild(option);
      });
    }
  };

  xhr.open('GET', url, true);
  xhr.send();
}






/*async function fetchJSONFile(selectedValue) {
  try {
    const url ='http://192.168.2.103:8080/wbd/jig_db_new/cache/4c7b2703654ddeb025d92d69f4b0923d.json';
    const response = await fetch(url);
    const data = await response.json();
    return data; // Assuming the JSON data is an array of items
  } catch (error) {
    console.error('Error loading JSON file:', error);
    return [];
  }
}

async function populateDatalist() {
  const data = await fetchJSONFile();
  const datalist = document.getElementById('datasuggest');

  // Clear any previous options
  datalist.innerHTML = '';

  // Add new options based on the JSON data
  data.forEach(item => {
    const option = document.createElement('option');
    option.value = item.name; // Assuming each item has a 'name' property
    datalist.appendChild(option);
  });
}


/*$optiondetail =  array(
  'item jig', // $result
  'type jig', // $resultdetsuggest
  'status jig', //$result
  'material', //$result
  'item type', //$resultpart
  'item status', //$resultpart
  'qty OnHand', // $resultdetsuggest
  'tolerance', // $resultdetsuggest
  'opt on',// $resultdetsuggest
  'opt off',// $resultdetsuggest
  'stat_jig_use', // $resultdetsuggest
  )*/