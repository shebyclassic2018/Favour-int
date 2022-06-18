// financialFormIsEmpty();

function setSelectedChannel() {

}

function handleForms(formName, alertClas) {
  var alertClas = alertClas;
  var formName  = formName;
}

$(".showFinancialForm").click(function() {
  $('#financialForm').removeClass('d-none');
  $('.hideFinancialForm').removeClass('d-none');
  $('.financialAlert').addClass('d-none');
  $('.showFinancialForm').addClass('d-none');
});

$(".hideFinancialForm").click(function() {
  $('#financialForm').addClass('d-none');
  $('.hideFinancialForm').addClass('d-none');
  $('.financialAlert').removeClass('d-none');
  $('.showFinancialForm').removeClass('d-none');
});

$("select[id='channel']").change(function() {
  var selecteField = $("select[id='channel']").val();
  if (selecteField.includes('Banks')) {
    $('#phoneInputField').addClass('d-none');
    $('input[id="acc_phone"]').addClass('d-none');
    $('input[id="acc_phone"]').val('');

    $('input[id="acc_bank"]').removeClass('d-none');
    $('#bankInputField').removeClass('d-none');
    $('button[id="submitFinancial"]').removeClass('d-none');
  }else if(selecteField.includes('MNOs')) {

    $('input[id="acc_bank"]').addClass('d-none');
    $('#bankInputField').addClass('d-none');
    $('input[id="acc_bank"]').val('');

    $('input[id="acc_phone"]').removeClass('d-none');
    $('#phoneInputField').removeClass('d-none');
    $('button[id="submitFinancial"]').removeClass('d-none');
  }else {
    $('input[id="acc_bank"]').val('');
    $('input[id="acc_phone"]').val('');
    $('input[id="acc_bank"]').addClass('d-none');
    $('input[id="acc_phone"]').addClass('d-none');
    $('#phoneInputField').addClass('d-none');
    $('#bankInputField').addClass('d-none');

    $('button[id="submitFinancial"]').removeClass('dee-bg-primary');
  }
});

// $("input[id='acc_bank']").keyup(function() {
//   countFieldCharacter($("input[id='acc_bank']").val(), 16);  
// });

// $("input[id='acc_phone']").keyup(function() {
//   countFieldCharacter($("input[id='acc_phone']").val(), 16);  
// });

// function countFieldCharacter(input, compare) {

//   if ((input.length) == compare) {
//     $('button[id="submitFinancial"]').removeClass('disabled');
//     financialFormIsEmpty();
//   }else {
//     $('button[id="submitFinancial"]').addClass('disabled');
//   }
// }

// // check if Field is Empty
// function financialFormIsEmpty() {
//   if($('#acc_bank').val()  == '' || $('#channel').val()  == '') {
//     $('button[id="submitFinancial"]').addClass('disabled');
//   }else if($('#acc_phone').val() == '' || $('#channel').val() == '') {
//     $('button[id="submitFinancial"]').addClass('disabled');
//   }else {
//     $('button[id="submitFinancial"]').removeClass('disabled');
//   }
// }


// ADDRESS
// physicalAdressForm
$(".showphysicalAdressForm").click(function () {
  $('#physicalAdressForm').removeClass('d-none');
  $('.hidephysicalAdressForm').removeClass('d-none');
  $('.physicalAdressAlert').addClass('d-none');
  $('.showphysicalAdressForm').addClass('d-none');
});

$(".hidephysicalAdressForm").click(function () {
  $('#physicalAdressForm').addClass('d-none');
  $('.hidephysicalAdressForm').addClass('d-none');
  $('.physicalAdressAlert').removeClass('d-none');
  $('.showphysicalAdressForm').removeClass('d-none');
});

$("select[id='address']").change(function () {
  var selecteField = $("select[id='address']").val();
  if (selecteField != '') {
    
    $('button[id="submitAdress"]').removeClass('d-none');
  }
});

function moneyFormatInpurt(idName) {

  var inputByID = $('input[name="' + idName + '"]');
  var nueNumber = new Intl.NumberFormat("sw-TZ", {
    style: "currency",
    currency: "TZS"
  })

  if (inputByID.val() != '') {
    inputByID.val(nueNumber.format(inputByID.val()));
  } else {
    inputByID.val(nueNumber.format(0));
  }
}

function makeAppointmentPayment(url,data) {
  $.ajax({
    url: url,
    type: "POST",
    data: data,
    dataType: 'json',
    success: function (result) {
      if (result) {
        setTimeout(() => {
          if (result.status) {
            othrerSweetAlert(result);
            setTimeout(() => {
              window.location.reload();
            }, 5000);
          }else {
            errorSweetAlert(result)
          }
        }, 1000);
      }
    },
  });
};

function othrerSweetAlert(result) {
  Swal.fire({
    title: result.title,
    text: result.message,
    icon: result.icon,
    timer: 5000,
    timerProgressBar: true,
    showCancelButton: false,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    }
  })
};


function errorSweetAlert(result) {
  Swal.fire({
    title: 'Oops...',
    text: result.message,
    icon: result.icon,
    footer: '<a href="' + result.url + '">' + result.instruction +'</a>',
    timer: 7000,
    timerProgressBar: true,
    showCancelButton: false,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    }
  });
}
//  First check if the value exist
