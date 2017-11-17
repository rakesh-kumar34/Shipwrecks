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
   $astroclicked = $_GET['astroid'];
   $sql = "SELECT * FROM `Astrolabes` WHERE ID='$astroclicked'";   
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
     
      
   #astrodata-table {
    font-size: 13px;
}

#astroDiv{
	margin: 0 auto;
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
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   
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
   <div class="container" id="astroDiv">
            <?php 
               while ($row = mysqli_fetch_array($query))
               {
               	   $astro_id = $row["ID"];
                   $astro_image1 = $row["Image1"];
                   $astro_image2 = $row["Image2"];
                   $astro_image3 = $row["Image3"];
            ?>
		    <table id="image-table" class="table table-responsive">
		    	<tr>
		    	  <td style="text-align:center;"><img src="<?php echo $astro_image2; ?>" alt="" width=30% height=150></td>
		          <td style="padding:5px; text-align:center;"><img src="<?php echo $astro_image1; ?>" alt="" width=40% height=300></td>
		          <td style="text-align:center;"><img src="<?php echo $astro_image3; ?>" alt="" width=30% height=150></td>
		        </tr>
		    </table>
		    <table id="astrodata-table" class="table-sm table-bordered table-responsive">		
		        <tr>
		    	  <td>Name: </td>
		          <td><?php echo $row["Name"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Shipwreck: </td>
		          <td><?php echo $row["Shipwreck"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>NMM No: </td>
		          <td><?php echo $row["NMM No"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>CMAC No: </td>
		          <td><?php echo $row["CMAC No"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Waters/Stimson Type: </td>
		          <td><?php echo $row["Waters/Stimson Type"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Date Made: </td>
		          <td><?php echo $row["Date Made"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Dia-mm: </td>
		          <td colspan=2><?php echo $row["Dia - mm"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>T-mm: </td>
		          <td colspan=2><?php echo $row["T - mm"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>W-gm: </td>
		          <td colspan=2><?php echo $row["W - gm"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Scale: </td>
		          <td><?php echo $row["Scale"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Marks: </td>
		          <td><?php echo $row["Marks"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>References_AT: </td>
		          <td><?php echo $row["References_AT"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Condition_AT: </td>
		          <td><?php echo $row["Condition_AT"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Maker: </td>
		          <td><?php echo $row["Maker"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Notes: </td>
		          <td><?php echo $row["Notes"]; ?></td>
		        </tr>
		        <tr>
		    	  <td>Nationality: </td>
		          <td><?php echo $row["Nationality"]; ?></td>
		        </tr>
		     </table>	
            </div>
   
             
   	    <?php } ?>
</div>
   <script>
</body>
</html>
