function changeValue(what){

  var element = document.getElementById(what);
  var inputElement = document.getElementById(what+"Input");
  var value = element.innerHTML;
  var type = '';

  switch (what){
    case 'name':
      type = 'nime';
      break;
    case 'type':
      type = 'tüüpi';
      break;
    case 'county':
      type = 'maakonda';
      break;
    case 'parish':
      type = 'valda/linna';
      break;
    case 'city':
      type = 'asulat/linnaosa';
      break;
    case 'address':
      type = 'aadressi';
      break;
    case 'postcode':
      type = 'postiindeksit';
      break;
    case 'webpage':
      type = 'veebilehte';
      break;
  }

    console.log(type);


  newValue = prompt("Muuda kooli "+type, value);
  if (newValue === null) {
    return;
  }

  element.innerHTML = newValue;
  inputElement.value = newValue;
  console.log(inputElement);

  element.parentNode.parentNode.style.backgroundColor = 'lightgray';
}

function changeYearValue(what){

  var element = document.getElementById(what);
  var inputElement = document.getElementById(what+"Input");
  var value = element.innerHTML;
  var type = '';

  switch (what){
    case 'year':
      type = 'aastat';
    case 'students':
      type = 'õpilaste arvu';
    case 'boys':
      type = 'poiste arvu';
    case 'girls':
      type = 'tüdrukute arvu';
    case 'teachers':
      type = 'õpetajate arvu';
    case 'language':
      type = 'õppekeelt';
    case 'notes':
      type = 'märkuseid';

    default:
  }

  newValue = prompt("Muuda õppeaasta "+type, value);
  if (newValue === null) {
    return;
  }

  element.innerHTML = newValue;
    inputElement.value = newValue;
  console.log(inputElement);

  element.parentNode.parentNode.style.backgroundColor = 'lightgray';
}

function changeDirectorValue(what){

  var element = document.getElementById(what);
  var inputElement = document.getElementById(what+"Input");
  var value = element.innerHTML;
  var type = '';

  switch (what){
    case 'start_year':
      type = 'alustamise aastat';
    case 'end_year':
      type = 'lõpetamise aastat';
    case 'principal':
      type = 'nime';

    default:
  }

  newValue = prompt("Muuda direktori "+type, value);
  if (newValue === null) {
    return;
  }

  element.innerHTML = newValue;
    inputElement.value = newValue;
  console.log(inputElement);

  element.parentNode.parentNode.style.backgroundColor = 'lightgray';
}
