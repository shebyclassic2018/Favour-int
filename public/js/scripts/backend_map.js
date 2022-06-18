
// VARIABLE BROCK
var city;
var district;
var neighbourhood;
var coordinate;
var token;
var url_locate;
var nature;

var map;
// let autocomplete;
// var geocoder;
var my_location = { lat: -6.97654, lng: 38.87865 };
var markers = [];

// MAP CALL BLOCK
function processLocationAddress(KEY, CSRF_TOKEN,URL_LOCATE) {
  token = CSRF_TOKEN;
  url_locate = URL_LOCATE;

  document.getElementById("locateBtn").disabled = true;
  document.getElementById("locateBtn").innerHTML = "Processing...";

  const handleCityChanges = (part) => {
    city = (part.long_name.includes("Region")) ? (part.long_name.split(" ")[0]) :
      ((part.long_name.includes("Mkoa")) ? (part.long_name.split(" ")[2]) : (part.long_name));
  }

  const successCallBack = (position) => {
    var LAT = position.coords.latitude;
    var LNG = position.coords.longitude;
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

              if (part.types.includes("locality")) {
                handleCityChanges(part);
              } else if (part.types.includes("administrative_area_level_4")) {
                handleCityChanges(part);
              }

              coordinate = CTS;
            });

            setTimeout(() => {
              document.getElementById("locateBtn").style.display = "none";
              document.getElementById("submitLocatedBtn").disabled = false;

              // # capture input
              $('input[id="city"]').val(city);
              $('input[id="district"]').val(district);
              $('input[id="neighbourhood"]').val(neighbourhood);
              $('input[id="coordinates"]#coordinates').val(CTS);
            }, 2000);
          }
        });
      } else {
        console.log('browser not support');
      }
    }).catch(err => console.warn(err.message));
  }

  const errorCallBack = (error) => {
    console.error(error);
  }

  var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    // maximumAge: 0
  };

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallBack, errorCallBack, options);
  }
}

var multiple = null;
var single = null;

var styles = {
  hide: [
    {
      featureType: 'poi.business',
      stylers: [{ visibility: 'off' }]
    },
    {
      featureType: 'transit',
      elementType: 'labels.icon',
      stylers: [{ visibility: 'off' }]
    },
    {
      "featureType": "administrative.land_parcel",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "administrative.neighborhood",
      "elementType": "labels.icon",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "labels.text",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "labels.text",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    }
  ]
};


function CenterControl(controlDiv, imageURL) {
  // Set CSS for the control border.
  var controlUI = document.createElement("div");

  controlUI.style.backgroundColor = "#fff";
  controlUI.style.border = "2px solid #fff";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginTop = "8px";
  controlUI.style.marginBottom = "0px";
  controlUI.style.marginRight = "10px";
  controlUI.style.textAlign = "center";
  controlUI.title = "Houses nearby your location";
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  const controlText = document.createElement("div");

  controlText.style.color = "rgb(25, 25, 25)";
  controlText.style.fontFamily = "Roboto,Arial,sans-serif";
  controlText.style.fontSize = "16px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "10px";
  controlText.style.paddingRight = "10px";
  controlText.innerHTML = "</span> <span class='bi bi-compass'></sp>";
  controlUI.appendChild(controlText);

  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener("click", () => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var currentLatitude = position.coords.latitude;
        var currentLongitude = position.coords.longitude;
        var currentLocation = { lat: currentLatitude, lng: currentLongitude };
        // var marker = new google.maps.Marker({
        // position: currentLocation,
        // icon: imageURL + "/marker/loc.svg",
        // map: map,
        // });
        map.setCenter(currentLocation);
        map.setZoom(8)
      });
    }
  });
}


function backendMap(mapId, urls, response) {
  const latitude = response[0].house.latitude;
  const longitude = response[0].house.longitude; 
  map = new google.maps.Map(document.getElementById(mapId), {
    // center: { lat: latitude, lng: longitude },
    center: { lat: -6.781408511892751, lng: 39.247721565043825 },
    zoom: 15,
    disableDefaultUI: true,
    mapTypeId: "roadmap",
    panControl: true,
    zoomControl: true,
    mapTypeControl: false,
    scaleControl: true,
    streetViewControl: false,
    overviewMapControl: false,
    rotateControl: true,
    gestureHandling: 'greedy',
    fullscreenControl: true,
    styles: styles['hide']
  });


  var imageUrl = urls.imageUrl;
  var viewurl = urls.viewurl;

  // Render Controller
  const centerControlDiv = document.createElement("div");
  CenterControl(centerControlDiv, imageUrl);
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(centerControlDiv);
  // map.setTilt(45);


  multiple = imageUrl + "/marker/hello1.svg";
  single = imageUrl + "/marker/hello1.svg";

  // INSERTING MAP CONTENT

  $.each(response, function () {
    var houseImage = null;
    var ownership = this;

    const getFrontImage = (unit_images) => {
      // Assign IFirst Image
      unit_images.forEach(image => {
        if (image.elevation.includes('front')) {
          houseImage = imageUrl + "/houses/" + image.path;
        }
      });
    }


    var unitInstance = ownership.units;

    if (unitInstance.length > 1) {
      var maxWidth = 400;

      var content = `
        <div class="block-content block-content-full px-0">
          <p class="text-center fw-semibold fs-sm">${ownership.house.ward.district.name}, ${ownership.house.ward.name}, ${ownership.house.ward.district.city.name}</p>
            <table class="table table-borderless table-hover table-vcenter">
              <tbody>`
                unitInstance.forEach(housePart => {
                var unit_prices = convertCurrency(housePart.rent_per_month);
                getFrontImage(housePart.unit_images);
                content += `
                  <tr>
                    <td style="width: 150px;">
                      <img class="img-fluid" src="${houseImage}" alt="" style="height: 80px; width: 100%">
                    </td>
                    <td>
                      <a class="fs-xs" href="${viewurl}?id=${ownership.house_id}&unit=${housePart.id}&flag=unit"">${housePart.goal}</a>
                      <div class="fs-xs text-muted">${ownership.house.house_type.title}</div>
                      <div class="fs-xs text-muted">${housePart.no_of_rooms} Rooms | Tsh ${unit_prices}</div>
                    </td>
                  </tr>`
              });
        content += `</tbody></table></div>`
    } else {

      var unit = ownership.units[0];
      var maxWidth = 300;
      getFrontImage(unit.unit_images);

      var content = `<div class="col-12">
        <div class="block block-rounded h-100 mb-0">
          <div class="block-content p-1">
            <div class="options-container">
              <img class="img-fluid options-item img-lightbox" src="${houseImage}" alt="" style="height: 120px; width: 100%">
              <div class="options-overlay bg-black-75">
                <div class="options-overlay-content">
                  <a class="btn btn-sm ngata-bg-second" href="${viewurl}?id=${ownership.house_id}&unit=${unit.id}&flag=unit">
                    Unit Deatils
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="block-content">
            <div class="mb-1">
              <div class="fw-semibold fs-xs float-end">Tsh ${unit.rent_per_month}/=</div>
              <a class="fs-xs" href="${viewurl}?id=${ownership.house_id}&unit=${unit.id}&flag=unit">${unit.no_of_rooms} Rooms</a>
            </div>
            <p class="fs-xs text-muted">${ownership.house.ward.district.name}, ${ownership.house.ward.name}, ${ownership.house.ward.district.city.name} </p>
          </div>
        </div>
      </div>`
    }

    const infowindow = new google.maps.InfoWindow({ content: content, maxWidth: maxWidth });
    //  var infowindow = new google.maps.InfoWindow();
    var marker = createMarker(ownership);
    // marker.addListener("click", () => {
    //   infowindow.open({
    //     anchor: marker,
    //     map,
    //     shouldFocus: false,
    //   });
    // });

    google.maps.event.addListener(marker,"click",
      (function (marker) {
        return function () {
            infowindow.setContent(content);
            infowindow.open(map, marker);
        };
      })(marker)
    );
  });
}


function createMarker(ownership) {
  var position = new google.maps.LatLng(ownership.house.latitude, ownership.house.longitude);
  var title = ownership.house.house_type.title;

  if (ownership.units.length > 1) {
    return new google.maps.Marker({
      position: position,
      map: map,
      title: title,
      icon: multiple,
      label: {
        text: "" + ownership.units.length,
        fontSize: "10px",
        fontWeight: "bold",
        color: "#00314a",
        backgroundColor: "red",
      },
    });
  } else {
    return new google.maps.Marker({
      position: position,
      map: map,
      title: title,
      icon: single,
      label: {
        text: convertCurrency(ownership.units[0].rent_per_month),
        fontSize: "10px",
        fontWeight: "bold",
        color: "#00314a",
        backgroundColor: "red",
      },
    });
  }
}

function processResponces(jsonData, viewurl) {
  const urls = {
    imageUrl: jsonData.imageUrl,
    viewurl: viewurl
  }

  backendMap(jsonData.mapId, urls, jsonData.res);
}


// FUNCTION CALL BLOCK
function submitLocatedLocation(NATURE) {
  nature = NATURE;
  submitLocation(coordinate, city, district, neighbourhood, token);
}


// FUNCTION PROCCESSING BLOCK
function submitLocation(coordinate, city, district, neighbourhood, token) {
  $.ajax({
    url: url_locate,
    method: "POST",
    data: {
      _token: token,
      _coordinate: coordinate,
      _city: city,
      _district: district,
      _neighbourhood: neighbourhood
    },
    success: function (feedback) {
      setTimeout(() => {
        if (feedback.status) {
          if (nature == 'Shared') {
            window.location.reload();
          }else {
            document.getElementById("submitLocatedBtn").style.display = "none";
            otherSweetAlert(feedback);
            setTimeout(() => {
              window.location.reload();
            }, 5000);
          }
        } else {
          if (nature == 'Shared') {
            window.location.reload();
          } else { 
            errorSweetAlert(feedback);
            document.getElementById("submitLocatedBtn").disabled = false;
          }
        }
      }, 2000);
    }

  });
}

function convertCurrency(currency) {
  if (currency >= 0 && currency < 1000) {
    currency = currency;
  } else if (currency >= 1000 && currency < 1000000) {
    currency /= 1000;
    currency = Math.round(currency);
    currency += "K";
  } else if (currency >= 1000000 && currency <= 1000000000) {
    currency /= 1000000;
    currency = Math.round(currency);
    currency += "M";
  } else {
    currency /= 1000000000;
    currency = Math.round(currency);
    currency += "B";
  }

  return currency;
}


// FEEDBACK, NOTIFICATION BLOCK
function otherSweetAlert(result) {
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
}

function errorSweetAlert(result) {
  Swal.fire({
    title: 'Oops...',
    text: result.message,
    icon: result.icon,
    footer: '<a href="' + result.url + '">' + result.instruction + '</a>',
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