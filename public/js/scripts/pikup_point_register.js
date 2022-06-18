$('#backToSelect').click(() => {
  onSelectedOptionTrue();
});


function onSelectedOptionTrue() {
  // document.getElementById("submitLocatedBtn").style.display = "none";
  $('.station_pickup_input_div').addClass('d-none');
  $('.station_pickup_select_div').removeClass('d-none');
  $("#station_pickup").val('')
  $("input[name='station_pickup_input']").val('')
  $('#appendStationFields').html('');
}

function selectedOption() {
  if($("select[name='station_pickup']").val() == 0) {
    $('.station_pickup_input_div').removeClass('d-none');
    $('.station_pickup_select_div').addClass('d-none');
  }
}

function no_null_on_pickup() {
  var selection = $("select[name='station_pickup']").val();
  var inputAuto = $('input[name="station_pickup_input"]').val();
  if (selection === '') {
    document.getElementById("submitHouseForm").setAttribute('disabled', true);
  } else {
    if (parseInt(selection) == 0 && inputAuto === '') {
      document.getElementById("submitHouseForm").setAttribute('disabled', true);
      $('#backToSelect').addClass('ngata-bg-danger');
    } else {
      document.getElementById("submitHouseForm").removeAttribute('disabled');
      $('#backToSelect').removeClass('ngata-bg-danger');
      $('#backToSelect').addClass('ngata-bg-primary');
    }
  }
}


function pickup_point_reqister(KEY) {
  const autocompletedValue = new google.maps.places.Autocomplete(document.getElementById('station_pickup_input'));
  var city;
  var district;
  var neighbourhood;
  var coordinate;

  const handleCityChanges = (part) => {
    city = (part.long_name.includes("Region")) ? (part.long_name.split(" ")[0]) :
      ((part.long_name.includes("Mkoa")) ? (part.long_name.split(" ")[2]) : (part.long_name));


    console.log(city);
  }

  google.maps.event.addListener(autocompletedValue, 'place_changed', function () {
    var addressComponents = autocompletedValue.getPlace();
    var LAT = addressComponents.geometry.location.lat();
    var LNG = addressComponents.geometry.location.lng();
    var CTS = LAT + ", " + LNG;
    let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${LAT},${LNG}&key=${KEY}`;
    fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.status == "OK") {
        (data.results).forEach(element => {

          if (element.types.includes("administrative_area_level_4")) {

            var parts = element.address_components;

            parts.forEach(part => {

              if (part.types.includes("administrative_area_level_4")) {
                neighbourhood = part.long_name;
              }

              if (part.types.includes("administrative_area_level_2")) {
                district = part.long_name;
              }

              // if (part.types.includes("administrative_area_level_4")) {
              //   handleCityChanges(part);
              // }
              
              if (part.types.includes("locality")) {
                handleCityChanges(part);
              } 

              coordinate = CTS;
            });


            $('#appendStationFields').html('');

            $('#appendStationFields').append(`
              <input type="hidden" name="city" value="${city}"/>
              <input type="hidden" name="district" value="${district}"/>
              <input type="hidden" name="neighbourhood" value="${neighbourhood}">
              <input type="hidden" name="coordinates" value="${coordinate}">
              <input type="hidden" class="form-control fs-xs" name="pikupPoint" value="${addressComponents.name}" />
            `);
          }
        });
      } else {
        console.log('browser not support');
      }
    }).catch(err => console.warn(err.message));
  });


  // const handleCityChanges = (part) =>  {
  //   return (part.long_name.includes("Region")) ? (part.long_name.split(" ")[0]) :
  //     ((part.long_name.includes("Mkoa")) ? (part.long_name.split(" ")[2]) : (part.long_name));
  // }



}
