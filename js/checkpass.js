$('#number-password').on("keypress", function(event){
  return leaveOnlyNumber(event);
});

function leaveOnlyNumber(e){
  var st = String.fromCharCode(e.which);
  if ("0123456789".indexOf(st,0) < 0) {
    console.log('[Warning] invalid input');
    return false;
  }
  return true;
}
