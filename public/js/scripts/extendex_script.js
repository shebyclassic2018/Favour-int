function setAnniversaryDate(name, id) {
  var text = "You won't be able to revert this!";
  var confirmButtonText = 'Set';
  showSweetAlert('form', name, text, confirmButtonText, id)
}