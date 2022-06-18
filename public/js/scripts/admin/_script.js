
function resetUserPassword(id) {
  var formName = 'reset-password';
  var text = "You won't be able to revert this!";
  var confirmButtonText = 'Reset It!';
  showSweetAlert('form', formName, text, confirmButtonText, id);
}

// function acceptAppointment(id) {
//   var formName = 'accept-appointment';
//   var text = 'You are accepting this Appointmet !';
//   var confirmButtonText = 'Accept It!';
//   showSweetAlert(formName, text, confirmButtonText, id);
// }

// function showSweetAlert(formName, text, confirmButtonText, id) {
//   Swal.fire({
//     title: 'Are you sure ?',
//     text: text,
//     icon: 'warning',
//     reverseButtons:true,
//     showCancelButton: true,
//     cancelButtonColor: ngataDanger,
//     confirmButtonColor: ngataPrimary,
//     confirmButtonText: 'Yes, ' + confirmButtonText
//   }).then((result) => {
//     if (result.value) {
//       document.getElementById(formName + '-form-' + id).submit();
//     }
//   });
// }