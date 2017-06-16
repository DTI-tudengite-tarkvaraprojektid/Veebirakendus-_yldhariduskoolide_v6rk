function changeValue(what){

  var element = document.getElementById(what);
  var value = element.innerHTML;
  var type = '';

  switch (what){ 
    case 'name':
      type = 'nime';
    case 'type':
      type = 'tüüpi';
    case 'county':
      type = 'maakonda';
    case 'city':
      type = 'valda/linna';
    case 'parish':
      type = 'asulat/linnaosa';
    case 'address':
      type = 'aadressi';
    case 'postcode':
      type = 'postiindeksit';
    case 'webpage':
      type = 'veebilehte';
    default:
  }

  newValue = prompt("Muuda kooli "+type, value);
  if (newValue === null) {
    return;
  }

  element.innerHTML = newValue;

  element.parentNode.parentNode.style.backgroundColor = 'lightgray';
}

function changeTypeValue(){
  var editType = document.getElementById('editType');
  var typeValue = "";
  typeValue = prompt("Muuda kooli tüüpi", typeValue);
  document.getElementById("type").innerHTML = typeValue;
}

function changeCountyValue(){
  var editCounty = document.getElementById('editCounty');
  var countyValue = "";
  countyValue = prompt("Muuda kooli maakonda", countyValue);
  document.getElementById("county").innerHTML = countyValue;
}

function changeCityValue(){
  var editCity = document.getElementById('editCity');
  var cityValue = "";
  cityValue = prompt("Muuda kooli valda/linna", cityValue);
  document.getElementById("city").innerHTML = cityValue;
}

function changeParishValue(){
  var editParish = document.getElementById('editParish');
  var parishValue = "";
  parishValue = prompt("Muuda kooli asulat/linnaosa", parishValue);
  document.getElementById("parish").innerHTML = parishValue;
}

function changeAddressValue(){
  var editAddress = document.getElementById('editAddress');
  var addressValue = "";
  addressValue = prompt("Muuda kooli aadressi", addressValue);
  document.getElementById("address").innerHTML = addressValue;
}

function changePostcodeValue(){
  var editPostcode = document.getElementById('editPostcode');
  var postcodeValue = "";
  postcodeValue = prompt("Muuda kooli postiindeksit", postcodeValue);
  document.getElementById("postcode").innerHTML = postcodeValue;
}

function changeWebpageValue(){
  var editWebpage = document.getElementById('editWebpage');
  var webpageValue = "";
  webpageValue = prompt("Muuda kooli veebilehte", webpageValue);
  document.getElementById("webpage").innerHTML = webpageValue;
}




