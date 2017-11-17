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
   $sql = "SELECT * FROM `pmsimages` WHERE fk_No in (select distinct `No.` from pms)";
   
   $query = mysqli_query($conn, $sql);
   
   if (!$query) {
       die ('SQL Error: ' . mysqli_error($conn));
   }
   
   ?>
<!DOCTYPE html >
<head>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
   <title>Photos</title>
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
      
      .navbargradient {
      background: #ffffff;/* Old browsers */
      background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);/* FF3.6-15 */
      background: -webkit-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);/* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);/* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5', GradientType=0);/* IE6-9 */
      }
div.gallery {
    border: 1px solid #ccc;
    height: 300px;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: 250px;
}

div.desc {
    padding: 10px;
    text-align: center;
    height: 40px;
}

* {
    box-sizing: border-box;
}

.responsive {
    float: left;
    width: 24.99999%;
    padding: 5px;
    height: 325px;
}

@media only screen and (max-width: 700px){
    .responsive {
        width: 49.99999%;
        margin: 6px 0;
    }
}

@media only screen and (max-width: 500px){
    .responsive {
        width: 100%;
    }
}

.clearfix:after {
    content: "";
    display: table;
    clear: both;
}
   </style>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.1/js/lightgallery.js"></script> 

   <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.1/css/lightgallery.css">
   <script type="text/javascript">
      $(document).ready(function() {
       
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
   <div class="container">
   <h4>Shipwreck Image Gallery</h4>
     
            <?php 
               if($query->num_rows > 0){

               while ($row = mysqli_fetch_array($query))
               {
                   $imageThumbURL = $row["ImageLink"];
                   $imageURL = $row["ImageLink"];                   
            ?>
            <div class="responsive">
		  <div class="gallery">
		    <a target="_blank" href="<?php echo $imageURL; ?>">
		      <img src="<?php echo $imageURL; ?>" alt="" width="600" height="400">
		    </a>
		    <div class="desc">"<?php echo $row["Site_Name"]; ?>"</div>
		  </div>
            </div>
   
             
   	    <?php }
        } ?>
   </div>
 
</body>
</html>
