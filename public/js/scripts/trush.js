function backendMap(mapId, imageURL, response) {
  var map;
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

  var mapOptions = {
    center: { lat: -6.97654, lng: 38.87865 },
    zoom: 8,
    disableDefaultUI: true,
    mapTypeId: "roadmap",
    panControl: true,
    zoomControl: true,
    mapTypeControl: false,
    scaleControl: true,
    streetViewControl: false,
    overviewMapControl: false,
    rotateControl: true,
    fullscreenControl: true,
    styles: styles['hide']
  }

  const centerControlDiv = document.createElement("div");

  var infowindow = new google.maps.InfoWindow();

  map = new google.maps.Map(document.getElementById(mapId), mapOptions);

  // Render Controller
  CenterControl(centerControlDiv, imageURL, map);
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(centerControlDiv);
  // map.setTilt(45);

  var mapData = [];
  var myIcon = imageURL + "/marker/hello1.svg";
  var infowindow = new google.maps.InfoWindow();

  // INSERTING MAP CONTENT
  $.each(response, function () {
    var houseImage = null;
    (this.units[0].unit_images).forEach(image => {
      if (image.elevation.includes('front')) {
        houseImage = imageURL + "/houses/" + image.path;
      }
    });

    var title = this.house.house_type.title;

    var unitInstance = this.units;
    var house = this.house;

    if (unitInstance.length > 1) {

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(this.house.latitude, this.house.longitude),
        map: map,
        title: item[1],
        icon: myIcon,
        label: {
          text: "" + item[3],
          fontSize: "12px",
          fontWeight: "bold",
          color: "#00314a",
          backgroundColor: "red",
        },
      });








    } else {



    }

    // mapData.push([
    //   new google.maps.LatLng(this.house.latitude, this.house.longitude),
    //   title,
    //   content,
    //   this.units,
    // ]);
  });


  //CREATING MARKER AND INFO WINDOW
  var infowindow = new google.maps.InfoWindow();
  $.each(mapData, function (i, item) {
    var myIcon = imageURL + "/marker/hello1.svg";

    if (item[3].length > 1) {
      var marker = new google.maps.Marker({
        position: item[0],
        map: map,
        title: item[1],
        icon: myIcon,
        label: {
          text: "" + item[3],
          fontSize: "12px",
          fontWeight: "bold",
          color: "#00314a",
          backgroundColor: "red",
        },
      });
    } else {
      var marker = new google.maps.Marker({
        position: item[0],
        map: map,
        title: item[1],
        icon: myIcon,
        label: {
          text: convertCurrency(item[3][0].rent_per_month),
          fontSize: "9px",
          fontWeight: "bold",
          color: "#00314a",
          backgroundColor: "red",
        },
      });
    }
    google.maps.event.addListener(
      marker,
      "click",
      (function (marker) {
        return function () {
          infowindow.setContent(item[2]);
          infowindow.open(map, marker);
        };
      })(marker)
    );
  });
}


function createMultipleUnit() {
  var marker = new google.maps.Marker({
    position: item[0],
    map: map,
    title: item[1],
    icon: myIcon,
    label: {
      text: convertCurrency(item[3][0].rent_per_month),
      fontSize: "9px",
      fontWeight: "bold",
      color: "#00314a",
      backgroundColor: "red",
    },
  });



  // title = "";
  // var content = "<div class='unitInfo'>" + "<div class='row'>";

  // unitInstance.forEach(housePart => {

  // var unit_prices = convertCurrency(housePart.rent_per_month);
  // var unit_id = housePart.id;
  // var total_rooms = housePart.no_of_rooms;


  // if(unitInstance[unitInstance.length-1] === housePart){
  // title += unit_prices + ",";
  // }else {
  // title += unit_prices;
  // // content += "<a href='#' class='many_units'>" + unit_prices + "</a>"
  // }

  // content += "<div class='col-sm-12' style='padding-top: 5px;'>";
  // content += "</div>";

  // });

  // content += "</div>" + "</div>";

}

function createSingleUnit() {

  var marker = new google.maps.Marker({
    position: item[0],
    map: map,
    title: item[1],
    icon: myIcon,
    label: {
      text: "" + item[3],
      fontSize: "12px",
      fontWeight: "bold",
      color: "#00314a",
      backgroundColor: "red",
    },
  });




  // var content = "<div class='infoWindow'>" +
  // "<div class='row'>" +
  // "<div class='col-sm-12'>" +
  // "<img class='img-w img-fluid' src='" + houseImage + "' />" +
  // "</div>" +
  // "<div class='col-sm-12 text-center' style='padding-top: 5px'>" +
  // mapProps[i].dname +
  // " - " +
  // mapProps[i].wname +
  // ", " +
  // mapProps[i].cname +
  // "</div>" +
  // "<div class='col-sm-12 text-center' style='font-size: 16px; padding-top: 5px'>" +
  // "<b>TZS " +
  // mapProps[i].rent_per_month +
  // "</b>/mo" +
  // "</div>" +
  // "<div class='col-sm-12 text-center' style='padding-top: 5px'>" +
  // "<a href='" +
  //                 getHouseDetailsURI +
  //                 "/" +
  //                 mapProps[i].unit_id +
  //                 "/" +
  //                 mapProps[i].price +
  //                 "/" +
  //                 mapProps[i].total_rooms +
  //                 "/" +
  //                 mapProps[i].ward_id +
  //                 "'>More info</a>" +
  // "</div>" +
  // "</div>" +
  // "</div>";

}



function processResponces(jsonData) {

  backendMap(jsonData.mapId, jsonData.imageUrl, jsonData.res);

  // var houses = [];

  // jQuery.each((jsonData.res), function(i, item) {

  //   var myIcon = jsonData.imageUrl + "/marker/hello1.svg";

  //   if (houses.lenght >= 1) {

  //     houses.forEach(element => {
  //       if (element.houseID == item.house_ownership_id) {
  //         houses['houseQTY'] += 1;
  //         houses['items'].push(item);
  //       }else {
  //       houses['houseID'] = item.house_ownership_id;
  //       houses['houseQTY'] = 1;
  //       houses['items'] = item;
  //       }
  //     });

  //   }else {
  //     houses['houseID'] = item.house_ownership_id;
  //     houses['houseQTY'] = 1;
  //     houses['items'] = item;
  //   }




  //   // no units

  // console.log(jsonData.res);
  //   console.log(myIcon);

  //   // $("#" + this).text("My id is " + this + ".");
  //   // return (this != "four"); // will stop running to skip "five"
  //   // var items = array(feedback.items);
  //   // processResponces(res);


  // });


  // function initBackendMap() { backendMap('dashboard_map');}
  // console.log(jsonData);
}
