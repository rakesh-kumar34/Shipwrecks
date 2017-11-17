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
   $sql = 'SELECT * FROM pms where DocumentLink != ""';
   
   $query = mysqli_query($conn, $sql);
   
   if (!$query) {
       die ('SQL Error: ' . mysqli_error($conn));
   }
   
   ?>
<!DOCTYPE html >
<head>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
   <title>Documents</title>
   <style>
      html,body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif !important;
      }
      .nav-link{
      font-size: 16px !important;
      padding: 0.5em 0.5em !important;
      }
      #docsDiv {
      margin: 0 auto;
      margin-top: 25px;
      margin-bottom: 25px;
      width: 70%;
      }
      #docs-table{
      margin-top: 20px !important;
      }
      .navbargradient {
      background: #ffffff;/* Old browsers */
      background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);/* FF3.6-15 */
      background: -webkit-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);/* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);/* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5', GradientType=0);/* IE6-9 */
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
       $('#docs-table').DataTable( {
           dom:'Bfrtip',
           paging: false,
           searching: false,
           lengthChange: false,
           responsive: true,
           fixedHeader: true
       } );
      } );
   </script>
</head>
<body class="animated fadeInRight">
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
   <div id="docsDiv">
      <table border="1" cellspacing="0" class="table table-striped table-bordered table-sm table-hover" id="docs-table" width="100%">
         <caption class="title">SHIPWRECK DOCUMENTS</caption>
         <thead style="top:0; background-color:lightgrey;">
            <tr>
               <th style="width: 160px">SITE</th>
               <th>LOST COUNTRY</th>
               <th>LOST PLACE</th>              
               <th>DOCUMENT LINK</th>
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
                           <td><a href="'.$row['DocumentLink'].'">'.$row['DocumentLink'].'</a></td>               
                       </tr>';
               }?>
         </tbody>
      </table>
   </div>
   <script>
</body>
</html>
