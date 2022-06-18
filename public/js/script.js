/* text */
var ngataPrimary = '#003049';
var ngataSecondary = '#ffb100';
var ngataDanger = '#b5121f';

function showSweetAlert(type, name, text, confirmButtonText, id) {
  Swal.fire({
    title: 'Are you sure ?',
    text: text,
    icon: 'warning',
    reverseButtons: true,
    showCancelButton: true,
    cancelButtonColor: ngataDanger,
    confirmButtonColor: ngataPrimary,
    confirmButtonText: 'Yes ' + confirmButtonText
  }).then((result) => {
    if (result.value) {
      if (type === 'form')  { formAction(name, id); }
      if (type === 'route') { routeAction(name); }
      // if (type === 'ajax') { ajaxAction(name, id); }
    }
  });
}

const deleteSingleImage = function (params) {
  $.ajax({
    url: params.url,
    type: "DELETE",
    data: params.data,
    dataType: 'json',
    success: function (result) {
      Swal.fire({
        icon: (result.status)  ? "success" : 'warning',
        // title: 'Custom animation with Animate.css',
        text: result.message,
        showClass: { popup: 'animate__animated animate__fadeInDown' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp' },
        text: result.message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });

      setTimeout(function () {
        window.location.reload();
      }, 3000);
    }
  });
}

function existFile(test, action) {
    // first test
    $.ajax({
        url: test,
        type: "GET",
        data: 'Exist',
        dataType: 'json',
        success: function(result) {
            // console.log(result);
            if (result.status) {
                window.location.href = action;
            } else {
                // Swal.fire('Sorry ..', result.message, 'error');
                Swal.fire({
                    icon: 'warning',
                    text: result.message,
                    showConfirmButton: true,
                    confirmButtonColor: "#00314a",
                    timerProgressBar: true,
                });
            }
        }
    });
}

function formAction(formName, id) {
    document.getElementById(formName + '-form-' + id).submit();
}

function ajaxAction(functionName, data) {
  if (functionName == 'deleteSingleImage') {
    deleteSingleImage(data);
  }
}

function routeAction(url) {
    window.location.href = url;
}

function deleteData(id) {
    var formName = 'delete';
    var text = "You won't be able to revert this!";
    var confirmButtonText = 'delete It!';
    showSweetAlert('form', formName, text, confirmButtonText, id);
}

// TENANT APPOINTMENT
function selectUnitToRent(formName, id) {
    var text = "We first check if this Unit is not taken !!";
    var confirmButtonText = 'Select It!';
    showSweetAlert('form', formName, text, confirmButtonText, id);
}

function resetForm(formId) {
    document.getElementById(formId).reset();
}

function confirmVistedAppointment(formName, id) {
    var text = "You won't be able to revert this!";
    var confirmButtonText = 'Confirmed';
    showSweetAlert('form', formName, text, confirmButtonText, id);
}

// Terms andCondition
function agreeTermsBycheckbox(termsId, buttonId) {
    if (document.getElementById(termsId).checked) {
        document.getElementById(termsId).setAttribute("checked", "checked");
    } else {
        document.getElementById(termsId).removeAttribute("checked");
    }
    allowButtonToSubmit(termsId, buttonId);
}

function allowButtonToSubmit(termsId, buttonId) {
    if ($('#' + termsId).is(':checked')) {
        // btn-secondary
        // document.getElementById(termsId).setAttribute('checked', true);
        document.getElementById(buttonId).removeAttribute('disabled');
        $('#' + buttonId).addClass('btn-warning');
        $('#' + buttonId).removeClass('btn-secondary');
    } else {
        // document.getElementById(termsId).setAttribute('checked', false);
        document.getElementById(buttonId).setAttribute('disabled', true);
        $('#' + buttonId).removeClass('btn-warning');
        $('#' + buttonId).addClass('btn-secondary');
    }
}


function acceptAppointment(id) {
    var formName = 'accept-appointment';
    var text = null; //'You are accepting this Appointmet !';
    var confirmButtonText = 'Accept It!';
    showSweetAlert('form', formName, text, confirmButtonText, id);
}


function getCookie(name) {
    let cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim(); // Does this cookie string begin with the name we want? 
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0,
            v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16); //random number between 0 and 16
    });
}



function setcookie() {
  $.post(setuuid, {
    _token: _token,
    name: "device",
    value: uuidv4()
  })
}


function submitAjacRequest(url, data) {
    // console.log('#liked-succes' +data._id);
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: function(result) {
            if (result) {
                setTimeout(() => {
                    $('#liked-succes-' + data._id).removeClass('d-none');
                }, 1000);

                $('#liked-succes-' + data._id).addClass('d-none');
            }
        }
    });
}


// IDENTIFICATION CARD
$("select[name='card_id']").change((e) => {
    formaIdentityDocument(e, "#nin_id", "#voter_id");
});

$("input[name='acc_phone']").keyup(function() {
    formatPhoneNumeber(this);
});

$("input[name='acc_phone']").blur(function() {
    formatPhoneNumeber(this);
});

$("#regHouesPerfect").click(function() {
    document.getElementById('terms').checked = true;
    allowButtonToSubmit('terms', 'userRegister');
});

// CREDIT CARD
$("input[name='acc_bank']").keypress(function(e) {
    forceInputUppercase(e);
    formatCreditCard(e);
});


$("input[name='acc_bank']").blur(function(e) {
    forceInputUppercase(e);
    formatCreditCard(e);
});

// FORCE UPPERCASE
function forceInputUppercase(e) {
    var start = e.target.selectionStart;
    var end = e.target.selectionEnd;
    e.target.value = e.target.value.toUpperCase();
    e.target.setSelectionRange(start, end);
}

function formatCreditCard(e) {
    if (e.target.value.length === 4) {
        e.target.value = e.target.value + "-";
    } else {
        if (e.target.value.length === 9) {
            e.target.value = e.target.value + "-";
        } else {
            if (e.target.value.length === 14) {
                e.target.value = e.target.value + "-";
            }
        }
    }
}

function formatPhoneNumeber(target) {
    $(target).val($(target).val().replace(/^(\d{3})(\d{3})(\d{3})(\d+)$/, "($1)$2-$3-$4"));
}

function formatPhoneNumeber2(e) {
    if (e.target.value.length === 4) {
        e.target.value = e.target.value + "-";
    } else {
        if (e.target.value.length === 8) {
            e.target.value = e.target.value + "-";
        } else {
            // if (e.target.value.length === 14) {
            //   e.target.value = e.target.value + "-";
            // }
        }
    }
}

function formaIdentityDocument(e, nin, voter) {
    var province_id = e.target.value;
    for (let index = 1; index < 5; index++) {

        if (index < province_id || index > province_id) {
            $('#field_' + index).addClass('d-none');
        }

        $('#field_' + province_id).removeClass('d-none');
        jQuery(function($) {
            $(nin).mask("99999999-99999-00009-99");
            $(voter).mask("T-9999-9999-999-9");
        });
    }

    $('#field_' + province_id).removeClass('d-none');
    jQuery(function ($) {
      $(nin).mask("99999999-99999-00009-99");
      $(voter).mask("T-9999-9999-999-9");
    });
}

setcookie();
