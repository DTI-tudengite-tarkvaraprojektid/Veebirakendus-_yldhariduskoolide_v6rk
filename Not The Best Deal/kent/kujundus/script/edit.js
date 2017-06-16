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

function changeYearValue(what){

  var element = document.getElementById(what);
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

  element.parentNode.parentNode.style.backgroundColor = 'lightgray';
}


