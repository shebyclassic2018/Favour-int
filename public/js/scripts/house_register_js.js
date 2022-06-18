
  $('#houseNoErrorMsg').hide();

  var locRadioButtons = document.querySelectorAll('input[name="respective_location"]');
  $('input[name="respective_location"]').click(() => {
    var selectedLocOption;

    for (var locRadioButton of locRadioButtons) {
      if (locRadioButton.checked) {
        selectedLocOption = locRadioButton.value;
        break;
      }
    }

    if (selectedLocOption == 'yes') {
      // show upload Field
      $('#address_map').removeClass('d-none');
    } else if(selectedLocOption == 'no') {
      // Reset & Remove upload Field.
      $('#address_map').addClass('d-none');
    } else {
      // Default
      $('#address_map').addClass('d-none');
    }
  });

  function returnValueToInt(idName) {
    const inputValue = idName.value;

    if (inputValue === "") {
    //...
    }else {

      var removeTSH = inputValue.toString();
      console.log(removeTSH);

      removeTSH = removeTSH.split("TSh");
      console.log(removeTSH);
    }

  }

  // Global Variable
  var RentPerMonth  = 0;
  var ServiceFee    = 0;
  var TransPercent  = 0;
  var SecurityFee   = 0;
  var TaxInclusive  = 0;

  function initializeVariable ($nameArray) {
    nameArray.forEach(element => {
      element = 0;
    });
  }


  $('input[name="price"]').change(() => { processingRent();});
  $('input[name="service_fee"]').change(() => { processingServiceFee(); });
  $('input[name="security_fee"]').change(() => { processingSecurityFee(); });

  var is_availableButtons = document.querySelectorAll('input[name="is_available"]');
  function isUnityAvailable() {
    processIsUnitAvailable();
  }

  function processingRent() {

    RentPerMonth = $('input[name="price"]').val();

    var summaryPrice;
    var summaryTrans;
    var summaryTransPercent;


    if (RentPerMonth != '') {
      $('#summary-trans-tr').removeClass('d-none');

      TransPercent = (RentPerMonth * 1.5) / 100;

      summaryPriceIcon      = `<i class="si fa-fw si-check text-success"></i>`;
      summaryPrice          = `<div class="fw-semibold fs-xs">${convertFormCurrency(RentPerMonth)}/=</div>`;
      summaryTransPercent   = `<div class="fw-semibold fs-xs">1.5%</div>`;
      summaryTrans          = `<div class="fw-semibold fs-xs">${convertFormCurrency(TransPercent)}/=</div>`;
    }else {
      RentPerMonth = 0;
      TransPercent = 0;
      $('#summary-trans-tr').addClass('d-none');

      summaryPriceIcon    = `<i class="far fa-fw fa-times-circle ngata-text-danger"></i>`;
      summaryPrice        = `<i class="fa fa-fw fa-exclamation-circle ngata-text-secondary"></i>`;
      summaryTransPercent = `<div class="fw-semibold fs-xs">0.0%</div>`;
      summaryTrans        = `<div class="fw-semibold fs-xs">0.0/=</div>`;
    }

    document.getElementById("summary-price-icon").innerHTML = summaryPriceIcon;
    document.getElementById("summary-price").innerHTML = summaryPrice;
    document.getElementById("summary-trans").innerHTML = summaryTrans;
    document.getElementById("summary-trans-percent").innerHTML = summaryTransPercent;

    setTaxValue();
    rentSummaryTotal(TaxInclusive);
  }

  function processingServiceFee() {
    ServiceFee = $('input[name="service_fee"]').val();
    var summaryServiceFee;
    if (ServiceFee != '') {
      // show summary
      summaryServiceFee = `<div class="fw-semibold fs-xs">${convertFormCurrency(ServiceFee)}</div>`
    } else {
      ServiceFee = 0;
      summaryServiceFee = `<div class="fw-semibold fs-xs">${convertFormCurrency(ServiceFee)}/=</div>`
    }

    document.getElementById("summary-service").innerHTML = summaryServiceFee;
    rentSummaryTotal(TaxInclusive);
  }

  function processingSecurityFee() {
    SecurityFee = $('input[name="security_fee"]').val();
    var summarySecurityFee;
    if (SecurityFee != '') {
      // show summary
      summarySecurityFee  = `<div class="fw-semibold fs-xs">${convertFormCurrency(SecurityFee)}/=</div>`;
    }else {
      SecurityFee = 0;
      summarySecurityFee  = `<div class="fw-semibold fs-xs">${convertFormCurrency(0)}/=</div>`;
    }
    document.getElementById("summary-security").innerHTML = summarySecurityFee;
    rentSummaryTotal(TaxInclusive);
    // moneyFormatInpurt('security_fee');
  }

  function rentSummaryTotal(tax) {

    var rentTotal = 0;
    var RPM = parseInt(RentPerMonth);
    var SF  = parseInt(ServiceFee);
    var SCF = parseInt(SecurityFee);
    var TX  = parseInt(tax);
    var TP  = parseInt(TransPercent);


    rentTotal = (TX == 0 ? RPM : (RPM * TX / 100)+ RPM) + TP;
    var summaryTotal = `<span class="fw-semibold fs-6">${convertFormCurrency(rentTotal)}/=</span>`;

    if (rentTotal > 0 && RPM > 0) {
      $('#summary-total-tr').removeClass('d-none');
    } else {
      $('#summary-total-tr').addClass('d-none');
    }

    document.getElementById("summary-total").innerHTML = summaryTotal;
  }

  function setTaxValue() {
    var summaryTaxPercent;
    var summarTax;

    if ($('#tax').val() == 'inl' && RentPerMonth != '') {
      TaxInclusive = 10;
      summaryTaxPercent = (RentPerMonth * TaxInclusive / 100);
      $('#summary-tax-tr').removeClass('d-none');
      summarTax = `<div class="fw-semibold fs-xs">${convertFormCurrency(summaryTaxPercent)}/=</div>`
    } else {
      TaxInclusive = 0;
      summaryTaxPercent= (RentPerMonth * TaxInclusive / 100);
      $('#summary-tax-tr').addClass('d-none');
      summarTax = `<div class="fw-semibold fs-xs">${convertFormCurrency(summaryTaxPercent)}/=</div>`
    }

    document.getElementById("summary-tax").innerHTML = summarTax;
    rentSummaryTotal(TaxInclusive);
  }

  function processIsUnitAvailable() {
    for (var is_availableButton of is_availableButtons) {
      if (is_availableButton.checked) {
        $('#availability_field').addClass('d-none');
        break;
      } else {
        $('#availability_field').removeClass('d-none');
      }
    }
  }

  //  HOUSE BLOCK
  $('#plot_no').keyup(() => {
    var value = $('#plot_no').val();

    if(value.substr(0, 5) != 'Plot-') {
      $('#plot_no').val(" ");
      $('#plot_no').val("Plot-"+value);
    }else {
      $('#plot_no').val(value);
    }
  });

  function convertFormCurrency(currency) {
    if (currency >= 0 && currency < 1000) {
      currency = currency;
    } else if (currency >= 1000 && currency < 1000000) {
      currency /= 1000;
      currency += "K";
    } else if (currency >= 1000000 && currency <= 1000000000) {
      currency /= 1000000;
      currency += "M";
    } else {
      currency /= 1000000000;
      currency += "B";
    }

    return currency;
  }

  var checkBoxs = document.querySelectorAll('input[name="common[]"]');
  var radioButtons = document.querySelectorAll('input[name="is_contract"]');

  $('input[name="is_contract"]').click(() => {

    var selectedButton;

    for (var radioButton of radioButtons) {
      if (radioButton.checked) {
        selectedButton = radioButton.value;
        break;
      }
    }

    if (selectedButton == 'yes') {
      // show upload Field
      $('#contact_field').removeClass('d-none');
      $('#contact_download').addClass('d-none');
    } else if(selectedButton == 'no') {
      // Reset & Remove upload Field.
      $('#contact_download').removeClass('d-none');
      $('#contact_field').addClass('d-none');
    } else {
      // Default
      $('#contact_field').addClass('d-none');
      $('#contact_download').addClass('d-none');
    }
  });

  var noOfUnitsRadioButton = document.querySelectorAll('input[name="noOfUnits"]');
    $('input[name="noOfUnits"]').click(() => {
    var noOfUnitsSelected;

    for (var buttonField of noOfUnitsRadioButton) {
      if (buttonField.checked) {
        noOfUnitsSelected = buttonField.value;
        break;
      }
    }

    if (noOfUnitsSelected == 'one') {
      // show upload Field
      $('#moreThanOneUnity').addClass('d-none');
      // $('input[name="house_no"]').addClass('read');
      $('.OnlyOneUnity').removeClass('d-none');
      $('.alertUserClick').removeClass('ngata-text-danger');

    } else if(noOfUnitsSelected == 'more') {
      // Reset & Remove upload Field.
      $('#moreThanOneUnity').removeClass('d-none');
      $('.OnlyOneUnity').addClass('d-none');
      $('.alertUserClick').removeClass('ngata-text-danger');
    } else {
      // Default
      $('#moreThanOneUnity').addClass('d-none');
      $('.OnlyOneUnity').addClass('d-none');
      $('.alertUserClick').addClass('ngata-text-danger');
    }
  });

  // Listen for click on toggle checkbox
  $('#select-all').click(function (event) {
    if (this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function () {
          this.checked = true;
      });
    } else {
      $(':checkbox').each(function () {
          this.checked = false;
      });
    }
  });

  $("input[name='house_no']").blur(function() {
    if($('input[name="house_no"]').val() != '') {
      $.ajax({
        url: "{{ route('account.ajax.checkForHouseExist') }}",
        type: "POST",
        data: {
        _token: "{{ csrf_token() }}",
        house_no: $('input[name="house_no"]').val()
        },
        dataType: 'json',
        success: function (result) {
          if(result){


            Swal.fire({
              // title: 'Are you sure?',
              text: "This Number Exist",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              // if (result.value) {
              // document.getElementById('delete-form-' + id).submit();
              // }
            })






            // $('input[name="house_no"]').addClass(['is-invalid','noExist']);
            // $('#houseNoErrorMsg').show();
          }else{
            $('input[name="house_no"]').removeClass(['is-invalid','noExist']);
            $('#houseNoErrorMsg').hide();
          }
        }
      });
    }else {

    }
  });

  $("input[name='house_no']").keyup(function() {
    if ($('input[class="noExist"]')) {
      $('input[name="house_no"]').removeClass(['is-invalid','noExist']);
      $('#houseNoErrorMsg').hide();
    }else {

      // $('input[name="house_no"]').addClass('is-invalid');
    }
  });

  function incrementValue(target) {
    var value = parseInt(document.getElementById(target).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      value++;
      document.getElementById(target).value = value;
    }
  }

  function decrementValue(target) {
    var value = parseInt(document.getElementById(target).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
      document.getElementById(target).value = value;
    }
  }

  function handleQtyVisibilityInput() {
    
  }
