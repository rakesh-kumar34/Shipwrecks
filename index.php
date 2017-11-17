<?php
$db_host = 'localhost'; // Server Name
$username = 'rakeshcg'; // Username
$password = '1ga07ec079'; // Password
$database = 'shipwrecks'; // Database Name

// Opens a connection to a MySQL server

$conn = mysqli_connect($db_host, $username, $password, $database);
if (!$conn) {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if(isset($_POST['submit'])){
	$selected_country = $_POST['filter'];  // Storing Selected Value of Lost Country In Variable
	$selected_year_from = $_POST['year_from'];
	$selected_year_to = $_POST['year_to'];
  $flag = 'true';
  //echo $flag;
	//echo $selected_year_from;
	//echo $selected_year_to;
}
$sql1 = 'SELECT distinct pms.LostCountry FROM pms where pms.LostCountry <> "NA" and pms.LostCountry <> "" order by pms.LostCountry';
$result1 = mysqli_query($conn, $sql1);

if (!$result1) {
    die ('SQL Error: ' . mysqli_error($conn));
}


?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>ShipWrecks</title>
      <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      .attr{
        font-weight: bold;
        padding: 3px;
      }
      .imglink{
        width: 200px; max-width: 100%; height: auto;
      }
      .popupDiv{
        font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
        font-size: 13px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      .map-control {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
        font-family: 'Roboto','sans-serif';
        margin: 10px;
        /* Hide the control initially, to prevent it from appearing
           before the map loads. */
        display: none;
      }
      /* Display the control once it is inside the map. */
      #map .map-control { display: block; }

      #filterDiv {
            background-color: black;
            opacity: 0.7;
            color: white;
            padding: 7px;
            max-width: 300px;
            height: 265px;
            font-size: 13px;
            border: 1px solid;
        }
        
        .banner {
            background-color: white;
            width: 100%;
            height: 100px;
            border-bottom: 1px solid black;
        }
        #resetButton{
            cursor: pointer;
            margin-left: 100px; 
        }
        #filterButton{
            cursor: pointer;
        }
        .form-control{
          font-size: 13px !important;
        }
        .title{
        	font-size: 28px;
        	font-weight: bold;
        	font-family: sans-serif;
        	color: #500000;
        }
        .popupDiv{
         min-width: 200px;
        }
        .navbargradient{
        	background: #ffffff; /* Old browsers */
    			background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%); /* FF3.6-15 */
    			background: -webkit-linear-gradient(top, #ffffff 0%,#e5e5e5 100%); /* Chrome10-25,Safari5.1-6 */
    			background: linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */
        }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDNNrrxD6r8kjFfhQtabXUnbFASG3yaZw"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <script>
      var gmarkers = []; // Global variable to store markers on google maps
      //Retain slider values on page reload
      minconst = <?php echo (isset($_POST['year_from'])) ? $_POST['year_from'] : 1200 ?>;
      maxconst = <?php echo (isset($_POST['year_to'])) ? $_POST['year_to'] : 1900 ?>;
      //jQuery DOM Ready starts
      $( function() {
          //Call initmap on dom start
          var flag = ($("#filterFlag").val());
          //alert(flag);
          
          $("#slider-range").slider({
            range: true,
            min: 1200,
            max: 1900,
            values : [minconst, maxconst],
            slide: function(event, ui) {
              $("#year").val(ui.values[0] + " - " + ui.values[1]);
              // when the slider values change, update the hidden fields
                  $("#year_from").val(ui.values[0]);
                  $("#year_to").val(ui.values[1]);
            }
          });
          $("#year").val($( "#slider-range" ).slider( "values", 0 ) +  " - " +  $( "#slider-range" ).slider( "values", 1 ));
          
          if(flag == ""){
            initMap();
          }
          else if(flag == "true"){
            var country_option = $( "#filter option:selected" ).text();
            var yearFrom = "<?php echo $selected_year_from ?>"; 
            var yearTo = "<?php echo $selected_year_to ?>";
            initFilteredMap(country_option, yearFrom, yearTo);
          }
          
          $("#resetButton").on("click", function () {
              location.reload();
              $('select option:contains("Choose here")').prop('selected',true);
              $("#slider-range").slider({
	            range: true,
	            min: 1200,
	            max: 1900,
	            values : [minconst, maxconst],
	            slide: function(event, ui) {
	              $("#year").val(ui.values[0] + " - " + ui.values[1]);
	              // when the slider values change, update the hidden fields
	                  $("#year_from").val(ui.values[0]);
	                  $("#year_to").val(ui.values[1]);
	            }
              });
          });
          
          $(".textpopup").click(function(){
           var text = $(this).attr('href').val();
           if(text == '' || text == null)
           	alert("No Documents Found !!"); 
          });
        });
        //jQuery DOM Ready ends

//Function Definations
        function initMap() {
        //Create a Map
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(31.7917, 12.0926),
          zoom: 3,
          mapTypeControl: false,
          mapTypeId: 'roadmap'
        });

        // Add a style-selector control to the map.
        var filterControl = document.getElementById('filterDiv');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(filterControl);
        // Set the map's style to the initial value of the selector.
        var styleSelector = document.getElementById('style-selector');
        map.setOptions({styles: styles[styleSelector.value]});

        // Apply new JSON when the user selects a different style.
        styleSelector.addEventListener('change', function() {
          map.setOptions({styles: styles[styleSelector.value]});
        });

        var infoWindow = new google.maps.InfoWindow;
        downloadUrl('mapmarkers.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        // Iterate and get values for each marker
        Array.prototype.forEach.call(markers, function(markerElem) {
            var site = markerElem.getAttribute('Site');
            var desc = markerElem.getAttribute('Desc');
            var datelost = markerElem.getAttribute('DateLost');
            var lostcountry = markerElem.getAttribute('LostCountry');
            var lostplace = markerElem.getAttribute('LostPlace');
            var status = markerElem.getAttribute('Status');
            var doclink = markerElem.getAttribute('DocumentLink');
            var imglink = markerElem.getAttribute('ImageLink');
            var lat = markerElem.getAttribute('Latitude');
            var long = markerElem.getAttribute('Longitude');

            var point = new google.maps.LatLng(
            parseFloat(lat),
            parseFloat(long));

              var infoString = "<div class='popupDiv'>"+
                             "<form method='post' action='' >"+
                             "<table>"+
                             "<tr><td class='attr'>Site</td><td>"+site+"</td></tr>"+
                             "<tr><td class='attr'>Description</td><td>"+desc+"</td></tr>"+
                             "<tr><td class='attr'>Date Lost</td><td>"+datelost+"</td></tr>"+
                             "<tr><td class='attr'>Lost Country</td><td>"+lostcountry+"</td></tr>"+
                             "<tr><td class='attr'>Lost Place</td><td>"+lostplace+"</td></tr>"+
                             "<tr><td class='attr'>Status</td><td>"+status+"</td></tr>"+
                             "<tr><td class='attr'><a href='"+doclink+"' class='text'>Text</a></td><td class='attr'><a href='photoclick.php?sitename="+site+"'>Photos</a></td></tr>"+
                             "</form>"+
                             "</div>"
     
            var image = "../images/1494936848_bullet-red.png";

           if(lat != 0.000000000 && long != 0.000000000){
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: image
              });    
             // Push your newly created marker into the array:
              gmarkers.push(marker);
              marker.addListener('click', function() {
                infoWindow.setContent(infoString);
                infoWindow.open(map, marker);
              });
            }
           });
         });
      }

      // Function - Trigger on Click of Filter Button
      function initFilteredMap(selected_lostcoutr, yearStart, yearEnd){
        //Create a Map
          var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(31.7917, 12.0926),
            zoom: 3,
            mapTypeControl: false
          });

          // Add a style-selector control to the map.
          var filterControl = document.getElementById('filterDiv');
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(filterControl);

          // Set the map's style to the initial value of the selector.
          var styleSelector = document.getElementById('style-selector');
          map.setOptions({styles: styles[styleSelector.value]});

          // Apply new JSON when the user selects a different style.
          styleSelector.addEventListener('change', function() {
            map.setOptions({styles: styles[styleSelector.value]});
          });

          var infoWindow = new google.maps.InfoWindow;

          downloadUrl("mapmarkers_filtered.php?country="+selected_lostcoutr+"&yearS="+yearStart+"&yearE="+yearEnd, function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName('marker');
          // Iterate and get values for each marker
          Array.prototype.forEach.call(markers, function(markerElem) {
              var site = markerElem.getAttribute('Site');
            var desc = markerElem.getAttribute('Desc');
            var datelost= markerElem.getAttribute('DateLost');
            var lostcountry = markerElem.getAttribute('LostCountry');
            var lostplace = markerElem.getAttribute('LostPlace');
            var status = markerElem.getAttribute('Status');
            var doclink = markerElem.getAttribute('DocumentLink');
            var imglink = markerElem.getAttribute('ImageLink');
            var lat = markerElem.getAttribute('Latitude');
            var long = markerElem.getAttribute('Longitude');
              
              var point = new google.maps.LatLng(
              parseFloat(lat),
              parseFloat(long));
              
             var infoString = "<div class='popupDiv'>"+
                             "<form method='post' action='' >"+
                             "<table>"+
                             "<tr><td class='attr'>Site</td><td>"+site+"</td></tr>"+
                             "<tr><td class='attr'>Description</td><td>"+desc+"</td></tr>"+
                             "<tr><td class='attr'>Date Lost</td><td>"+datelost+"</td></tr>"+
                             "<tr><td class='attr'>Lost Country</td><td>"+lostcountry+"</td></tr>"+
                             "<tr><td class='attr'>Lost Place</td><td>"+lostplace+"</td></tr>"+
                             "<tr><td class='attr'>Status</td><td>"+status+"</td></tr>"+
                             "<tr><td class='attr'><a href='"+doclink+"' id='textpopup'>Text</a></td><td class='attr'><a href='photoclick.php?sitename="+site+"'>Photos</a></td></tr>"+
                             "</form>"+
                             "</div>"

              var image = "../images/1494936848_bullet-red.png";

              if(lat != 0.000000000 && long != 0.000000000){
                var marker = new google.maps.Marker({
                  map: map,
                  position: point,
                  icon: image
                });    
             // Push your newly created marker into the array:
                gmarkers.push(marker);
                marker.addListener('click', function() {
                  infoWindow.setContent(infoString);
                  infoWindow.open(map, marker);
                });
              }
             });
           });
      }

    //Styles
    var styles = {
            default: null,
            silver: [
              {
                elementType: 'geometry',
                stylers: [{color: '#f5f5f5'}]
              },
              {
                elementType: 'labels.icon',
                stylers: [{visibility: 'off'}]
              },
              {
                elementType: 'labels.text.fill',
                stylers: [{color: '#616161'}]
              },
              {
                elementType: 'labels.text.stroke',
                stylers: [{color: '#f5f5f5'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#bdbdbd'}]
              },
              {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#eeeeee'}]
              },
              {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#757575'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#e5e5e5'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9e9e9e'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#ffffff'}]
              },
              {
                featureType: 'road.arterial',
                elementType: 'labels.text.fill',
                stylers: [{color: '#757575'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#dadada'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#616161'}]
              },
              {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9e9e9e'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#e5e5e5'}]
              },
              {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#eeeeee'}]
              },
              {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#c9c9c9'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9e9e9e'}]
              }
            ],

            night: [
              {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
              {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
              {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
              {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
              },
              {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#263c3f'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#6b9a76'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#38414e'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{color: '#212a37'}]
              },
              {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9ca5b3'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#746855'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#1f2835'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#f3d19c'}]
              },
              {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{color: '#2f3948'}]
              },
              {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
              },
              {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#17263c'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#515c6d'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#17263c'}]
              }
            ],

            retro: [
              {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
              {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
              {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
              {
                featureType: 'administrative',
                elementType: 'geometry.stroke',
                stylers: [{color: '#c9b2a6'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'geometry.stroke',
                stylers: [{color: '#dcd2be'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#ae9e90'}]
              },
              {
                featureType: 'landscape.natural',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#93817c'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'geometry.fill',
                stylers: [{color: '#a5b076'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#447530'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#f5f1e6'}]
              },
              {
                featureType: 'road.arterial',
                elementType: 'geometry',
                stylers: [{color: '#fdfcf8'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#f8c967'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#e9bc62'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry',
                stylers: [{color: '#e98d58'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry.stroke',
                stylers: [{color: '#db8555'}]
              },
              {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#806b63'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.fill',
                stylers: [{color: '#8f7d77'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#ebe3cd'}]
              },
              {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'water',
                elementType: 'geometry.fill',
                stylers: [{color: '#b9c2'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#92998d'}]
              }
            ]
          };


      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
  </head>

  <body>
  	<div>
	    <nav class="navbar navbar-toggleable-md navbar-light bg-faded navbargradient">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
      <a class="navbar-brand" href="index.php" style="font-weight: bold">Modern Shipwrecks</a>
      <div class="collapse navbar-collapse" id="navbarToggle">
        <ul class="navbar-nav mr-auto mt-2 mt-md-0">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data-download.php">Data</a>
          </li>
          <li class="nav-item">
	    <a class="nav-link" href="analyze.php">Analyze</a>
          </li>
          <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Resources
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="pmsimages.php">Photos</a>
		          <a class="dropdown-item" href="pmsdocs.php">Documents</a>
		          <a class="dropdown-item" href="glossary.html">Ship Glossary</a>
		          <a class="dropdown-item" href="metadata.html">Data Dictionary</a>
		          <a class="dropdown-item" href="astrolabes.php">Astrolabes</a>		         
		        </div>
		      </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>      
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
      <div>
        <a href="https://www.tamu.edu/"><img border="0" alt="TAMU" src="../images/Capture.png" width="200px"></a>
      </div>
    </nav>
	</div>
    <div id="filterDiv">
		    <div class="form-group" id="style-selector-control">
		      <label for="Style">Map Styles</label>
		      <select id="style-selector" class="form-control">
		        <option value="default">Default</option>
		        <option value="silver" selected="selected">Silver</option>
		        <option value="night">Night mode</option>
		        <option value="retro">Retro</option>
		      </select>
		    </div>
			<form method="post" action="" >
			    <label for="Country">Lost Country</label>
				<select name="filter" id="filter" class="form-control">
  					<option selected disabled>Choose here</option>
					<?php
						while ($row = $result1->fetch_assoc()){
							$selected = ($row['LostCountry'] == $_POST['filter']) ? "selected=\"selected\"" : "";
						    echo "<option value=\"".$row['LostCountry']."\" $selected>".$row['LostCountry']."</option>\n ";
						}
					?>
				</select><br/>
				<!-- Range slider: -->
				<input type="hidden" name="year_from" id="year_from" value="1200"/>
    		                <input type="hidden" name="year_to" id="year_to" value="1900"/>
				<label for="amount">Year Range:</label>
  				<input type="text" id="year" readonly style="border:0;">
				<div id="slider-range"></div>
				<br>
                               <span>
				<button type="submit" name="submit" id="filterButton" class="btn btn-primary">Filter</button>
                                <button class="btn btn-primary" id="resetButton">Reset</button>
                               </span>
                               <input type="hidden" value="<?php echo (isset($flag))?$flag:'';?>" name="filterFlag" id="filterFlag" />
			</form>
	  </div>
	  
    <div id="map"></div>
  </body>
</html>
