var coeff = 1000 * 60 * 10;
var date = new Date();  //or use any other date
var rounded = new Date(Math.round(date.getTime() / coeff) * coeff)

jQuery('input[name="billing_pickuptime"]').timepicker({
    timeFormat: 'h:mm p',
    interval: 10,
    minTime: formatAMPM(rounded),
    maxTime: '9:00pm',
    defaultTime: formatAMPM(rounded),
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});


function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}
