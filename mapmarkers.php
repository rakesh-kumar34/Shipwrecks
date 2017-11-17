<?php
$username = 'rakeshcg'; // Username
$password = '1ga07ec079'; // Password
$database = 'shipwrecks'; // Database Name

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM pms";
$query2 = "SELECT * FROM pmsimages";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
$result2 = mysql_query($query2);
if (!$result2) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("Site",$row['Site']);
  $newnode->setAttribute("LostCountry",$row['LostCountry']);
  $newnode->setAttribute("LostPlace",$row['LostPlace']);
  $newnode->setAttribute("Status",$row['Status']);
  $newnode->setAttribute("DateLost",$row['Lost L']);
  $newnode->setAttribute("Desc", $row['Description']);
  $newnode->setAttribute("Latitude", $row['Latitude']);
  $newnode->setAttribute("Longitude", $row['Longitude']);
  $newnode->setAttribute("DocumentLink", $row['DocumentLink']);
  while ($row2 = @mysql_fetch_assoc($result2)){
	if($row2['fk_No'] == $row['No.'])
	  $newnode->setAttribute("ImageLink", $row2['ImageLink']);
  }

  	
}

echo $dom->saveXML();

?>
