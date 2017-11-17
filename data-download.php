<?php
   // Opens a connection to a MySQL server
   
   $db_host = 'localhost'; // Server Name
   $db_user= 'rakeshcg'; // Username
   $db_pass= '1ga07ec079'; // Password
   $db_name= 'shipwrecks'; // Database Name
   
   $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
   if (!$conn) {
       die ('Failed to connect to MySQL: ' . mysqli_connect_error());
   }
   $sql = 'SELECT * FROM pms';
   
   $query = mysqli_query($conn, $sql);
   
   if (!$query) {
       die ('SQL Error: ' . mysqli_error($conn));
   }
   
   ?>
<!DOCTYPE html >
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
   <title>Shipwreck Data</title>

   <style type="text/css">
      html,body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif !important;
      }
      /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
      #dataDiv{
      display: none;
      }
      .nav-link{
      font-size: 16px !important;
      padding: 0.5em 0.5em !important;
      }
      #dataDiv{
      margin: 0 auto;
      margin-top: 25px;
      margin-bottom: 25px;
      width: 90%;
      font-size: 13px !important;
      }
      .navbargradient{
      background: #ffffff; /* Old browsers */
      background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%); /* FF3.6-15 */
      background: -webkit-linear-gradient(top, #ffffff 0%,#e5e5e5 100%); /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */
      }
      #shipwreck-table{
      margin-top: 20px !important;
      }
   </style>

   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>

   <script type="text/javascript">
      $(document).ready(function() {
          var table = $('#shipwreck-table').DataTable( {
              dom:'Bfrtip',
              responsive: true,
              fixedHeader: true,
              buttons: [
                   'copyHtml5',
                    
                  {
                    extend: 'excelHtml5',
                    title: 'Data_Export'
                  },
                  {
                    extend: 'csvHtml5',
                    title: 'Data_Export'
      
                  },
                  {
                    extend: 'pdfHtml5',
                    title: 'Data_Export'
                  },
                  'colvis'
              ]
          } );
      for ( var i=10 ; i<88 ; i++ ) {
        table.column( i ).visible( false, false );
      }
      table.columns.adjust().draw( false ); // adjust column sizing and redraw
      } );
   </script>
</head>
<body onload="myFunction()" style="margin:0;">
   <div class="loading" id="loader"></div>
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
   <div id="dataDiv">
      <table border="1" cellspacing="0" class="table table-striped table-bordered table-sm table-hover" id="shipwreck-table" width="100%">
         <caption class="title">SHIPWRECK RECORDS</caption>
         <thead style="top:0; background-color:lightgrey;">
            <tr>
               <th style="width: 160px">SITE</th>
               <th>LOST COUNTRY</th>
               <th>LOST PLACE</th>
               <th>DESCRIPTION</th>
               <th>TYPE</th>
               <th>BUILT</th>
               <th>LOOTED OR SALVAGED</th>
               <th>SURVEYED OR EXCAVATED</th>
               <th>TIMBERS RECORDED</th>
               <th>HULL REMAINS PUBLISHED</th>
               <th>STATUS</th>
               <th>SHIPBUILDING TRADITION</th>
               <th>TENTATIVE IDENTIFICATION</th>
               <th>LOST E</th>
               <th>LOST L</th>
               <th>PLACE BUILT</th>
               <th>ROUTE</th>
               <th>NATIONALITY</th>
               <th>BALLAST PILE TUMULUS</th>
               <th>MAX BEAM (m)</th>
               <th>KEEL LENGTH (m)</th>
               <th>LENGTH OVERALL (m)</th>
               <th>NO. OF MASTS</th>
               <th>TONNAGE</th>
               <th>DISPLACEMENT</th>
               <th>NO. OF DECKS</th>
               <th>LENGTH ON DECK (m)</th>
               <th>FLAT OF THE FLOOR (m)</th>
               <th>TRANSOM (m)</th>
               <th>ENTRIES (m)</th>
               <th>RUNS (m)</th>
               <th>DEPTH OF HOLD(m)</th>
               <th>KEEL SIDED (cm)</th>
               <th>KEEL MOLDED (cm)</th>
               <th>KEELSON SIDED (cm)</th>
               <th>KEELSON MOLDED (cm)</th>
               <th>MASTSTEPS</th>
               <th>STERNPOST</th>
               <th>STERNPOST SIDED (cm)</th>
               <th>STERNPOST MOLDED(cm)</th>
               <th>STEM</th>
               <th>STEM SIDED (cm)</th>
               <th>STEM MOLDED(cm)</th>
               <th>FRAMES (No.)</th>
               <th>FLOORS SIDED(cm)</th>
               <th>FLOORS MOLDED(cm)</th>
               <th>ROOM AND SPACE(cm)</th>
               <th>1ST FUTTOCKS SIDED(cm)</th>
               <th>1ST FUTTOCKS MOLDED(cm)</th>
               <th>OTHER FUTTOCKS SIDED(cm)</th>
               <th>OTHER FUTTOCKS MOLDED(cm)</th>
               <th>Y-FRAMES(cm)</th>
               <th>PLANKING(cm)</th>
               <th>STRINGERS SIDED(cm)</th>
               <th>STRINGERS MOLDED(cm)</th>
               <th>WALES SIDED(cm)</th>
               <th>WALES MOLDED(cm)</th>
               <th>CLAMPS SIDED(cm)</th>
               <th>CLAMPS MOLDED(cm)</th>
               <th>CEILING (cm)</th>
               <th>RIDERS</th>
               <th>STANCHIONS</th>
               <th>SCRAVES</th>
               <th>TOOL MARKS</th>
               <th>CAULKING</th>
               <th>KEEL/KEEL&KEEL/POST SCARVES</th>
               <th>STERN KNEE (Couce de popa)</th>
               <th>STERN DEADWOOD KNEE (Coral)</th>
               <th>BOW KNEE (Couce de proa)</th>
               <th>SQUARE OR ROUND TUCK</th>
               <th>PRE-ASSEMBLED FRAMES</th>
               <th>CONSTRUCTION MARKS</th>
               <th>FLOORS SCARVED TO FUTTOCKS (Shape/Fasteners)</th>
               <th>PLANKING (Carvel/Carvel D/Lapstrake/Clinker)</th>
               <th>CARVE GARBOARD</th>
               <th>PLANKING/FRAMES FASTENING PATTERN</th>
               <th>Y-FRAMES TABBED INTO COUCE OR CORAL</th>
               <th>KEELSON (Notched ?)</th>
               <th>MASTSTEP BUTRESSES AND BOTTOM STRINGERS</th>
               <th>FILLERS BETWEEN BUTRESSES</th>
               <th>FILLERS BETWEEN FUTTOCKS</th>
               <th>DEADEYES OR STRAPS</th>
               <th>GUNS</th>
               <th>SHOT</th>
               <th>ANCHORS</th>
               <th>BELLS</th>
            </tr>
         </thead>
         <tbody>
            <?php 
               while ($row = mysqli_fetch_array($query))
               {
                   echo '<tr>
                           <td style="width: 160px">'.$row['Site'].'</td>
                           <td>'.$row['LostCountry'].'</td>
                           <td>'.$row['LostPlace'].'</td>
                           <td>'.$row['Description'].'</td>
                           <td>'.$row['Type'].'</td>
                           <td>'.$row['Built'].'</td>
                           <td>'.$row['Looted or Salvaged'].'</td>
                           <td>'.$row['Surveyed or Excavated'].'</td>
                           <td>'.$row['Timbers Recorded'].'</td>
                           <td>'.$row['Hull Remains Published'].'</td>
                           <td>'.$row['Status'].'</td>
                           <td>'.$row['Probable Shipbuilding Tradition'].'</td>
                           <td>'.$row['Tentative identification'].'</td>
                           <td>'.$row['Lost E'].'</td>
                           <td>'.$row['Lost L'].'</td>
                           <td>'.$row['Probable place built'].'</td>
                           <td>'.$row['Probable route'].'</td>
                           <td>'.$row['Probable nationality'].'</td>
                           <td>'.$row['Ballast_Pile_Tumulus'].'</td>
                           <td>'.$row['Max. beam [m]'].'</td>
                           <td>'.$row['Keel length [m]'].'</td>
                           <td>'.$row['Length overall [m]'].'</td>
                           <td>'.$row['No. Masts'].'</td>
                           <td>'.$row['Tonnage'].'</td>
                           <td>'.$row['Displacemeent'].'</td>
                           <td>'.$row['No. Decks'].'</td>
                           <td>'.$row['Length on deck [m]'].'</td>
                           <td>'.$row['Flat of the floor [m]'].'</td>
                           <td>'.$row['Transom [m]'].'</td>
                           <td>'.$row['Entries [m]'].'</td>
                           <td>'.$row['Runs [m]'].'</td>
                           <td>'.$row['Depth of hold [m]'].'</td>
                           <td>'.$row['Keel sided [cm]'].'</td>
                           <td>'.$row['Keel molded [cm]'].'</td>
                           <td>'.$row['Keelson sided [cm]'].'</td>
                           <td>'.$row['Keelson molded [cm]'].'</td>
                           <td>'.$row['Maststeps'].'</td>
                           <td>'.$row['Sternpost'].'</td>
                           <td>'.$row['Sternpost sided [cm]'].'</td>
                           <td>'.$row['Sternpost molded [cm]'].'</td>
                           <td>'.$row['Stem'].'</td>
                           <td>'.$row['Stem sided [cm]'].'</td>
                           <td>'.$row['Stem molded [cm]'].'</td>
                           <td>'.$row['Frames [No.]'].'</td>
                           <td>'.$row['Floors sided [cm]'].'</td>
                           <td>'.$row['Floors molded [cm]'].'</td>
                           <td>'.$row['Room and Space [cm]'].'</td>
                           <td>'.$row['1st Futtocks sided [cm]'].'</td>
                           <td>'.$row['1st Futtocks molded[cm]'].'</td>
                           <td>'.$row['Other Futtocks sided [cm]'].'</td>
                           <td>'.$row['Other Futtocks molded [cm]'].'</td>
                           <td>'.$row['Y-Frames [cm]'].'</td>
                           <td>'.$row['Planking [cm]'].'</td>
                           <td>'.$row['Stringers sided [cm]'].'</td>
                           <td>'.$row['Stringers molded [cm]'].'</td>
                           <td>'.$row['Wales sided [cm]'].'</td>
                           <td>'.$row['Wales molded [cm]'].'</td>
                           <td>'.$row['Clamps sided [cm]'].'</td>
                           <td>'.$row['Clamps molded [cm]'].'</td>
                           <td>'.$row['Ceiling [cm]'].'</td>
                           <td>'.$row['Riders'].'</td>
                           <td>'.$row['Stanchions'].'</td>
                           <td>'.$row['Scarves'].'</td>
                           <td>'.$row['Tool marks'].'</td>
                           <td>'.$row['Caulking'].'</td>
                           <td>'.$row['Keel/Keel & Keel/Posts Scarves'].'</td>
                           <td>'.$row['Stern Knee (Cuace de Popa)'].'</td>
                           <td>'.$row['Stern deadwood knee (coral)'].'</td>
                           <td>'.$row['Bow Knee (Cuace de Proa)'].'</td>
                           <td>'.$row['Square or Round Tuck'].'</td>
                           <td>'.$row['Pre-assembled frames'].'</td>
                           <td>'.$row['Construction marks'].'</td>
                           <td>'.$row['Floors scarved to futtocks (shape/fasteners)'].'</td>
                           <td>'.$row['Planking (carvel/carvel D/lapstrake/clinker'].'</td>
                           <td>'.$row['Craved garboard'].'</td>
                           <td>'.$row['Planking/Frames fastening pattern'].'</td>
                           <td>'.$row['Y-Frames tabbed into couce or coral'].'</td>
                           <td>'.$row['Keelson (notched?)'].'</td>
                           <td>'.$row['Maststep butresses and bottom stringers'].'</td>
                           <td>'.$row['Fillers between butresses'].'</td>
                           <td>'.$row['Fillers between futtocks'].'</td>
                           <td>'.$row['Deadeyes or straps'].'</td>
                           <td>'.$row['Guns'].'</td>
                           <td>'.$row['Shot'].'</td>
                           <td>'.$row['Anchors'].'</td>
                           <td>'.$row['Bells'].'</td>
                       </tr>';
               }?>
         </tbody>
      </table>
   </div>
   <script>
      var myVar;
      
      function myFunction() {
          myVar = setTimeout(showPage, 3000);
      }
      
      function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("dataDiv").style.display = "block";
      }
   </script>
</body>
</html>