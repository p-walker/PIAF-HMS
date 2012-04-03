<?php

include('config.inc.php');
include('header.php');


echo "<h1>". _("Rates management") ."</h1>\n" ;


$Action = '';

if(isset($_GET['Action'])){

$Action = $_GET['Action'];
If ($Action == "Delete") :
$ID=$_GET['ID'];
	if ($ID <> "") :
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database Hotel connection failed"));
	mysql_select_db($dbname) or die(_("Database open failed"));
	$query = "DELETE FROM Rates WHERE ID = " .$ID;
  	$result = mysql_query($query)
    		or die(_("Database Hotel deletion failed"));
	mysql_close($dbconnection);
	$ID = "";
	$Action = "";
	endif ;
endif ;

}  

$Desc=''; 
$Type=''; 
$Pref=''; 
$Min='';
$Risp='';

if(isset($_REQUEST['Desc'])){
$Desc=$_REQUEST['Desc'];
}
if(isset($_REQUEST['Type'])){
$Type=$_REQUEST['Type'];
} 
if(isset($_REQUEST['Pref'])){
$Pref=$_REQUEST['Pref'];
} 
if(isset($_REQUEST['Min'])){
$Min=$_REQUEST['Min'];
} 
if(isset($_REQUEST['Risp'])){
$Risp=$_REQUEST['Risp'];
} 

if(isset($_POST['InsertButton'])) :
   // process as form post
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database Hotel connection failed"));
	mysql_select_db($dbname) or die(_("Database open failed"));
  	$query = "INSERT INTO `Rates` (`ID`, `Desc`, `Type`, `Pref`, `Min`, `Risp`) VALUES (NULL, '$Desc', '$Type', '$Pref', '$Min', '$Risp')";
  	$result = mysql_query($query)
   		or die(_("Database Hotel-Rates insert failed"));
	mysql_close($dbconnection);
endif;




echo "<TABLE cellSpacing=0  cellPadding=0 width=900 border=0>\n" ;
echo "<TR><TD>" . _("Id") . "</TD><TD>". _("Description") ."</TD><TD>". _("Type") ."</TD><TD>". _("Prefix") ."</TD><TD>". _("Minute rate") ."</TD><TD>". _("Fixed rate") ."</TD><TD>Action</TD>" ;
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database Hotel-Rates open failed"));
	$query = "SELECT * FROM Rates order by ID asc";
	$result = mysql_query($query)
    	or die(_("Web site query failed"));
	while ($row = mysql_fetch_array($result)) {
 	echo "<TR><TD><FONT face=verdana,sans-serif>" . $row["ID"] . "</TD><TD>" . $row["Desc"]  . "</TD><TD>" .$row["Type"] ."</TD><TD>" . $row["Pref"] . "</TD><TD>" . $row["Min"] . "</TD><TD>" . $row["Risp"] . "</TD><TD><a href=\"rates.php?Action=Delete&ID=" .$row["ID"] . "\">". _("Delete") ."</a></TD></TR>\n" ;
	}
echo "<FORM NAME=\"InsertFORM\" ACTION=\"./rates.php\" METHOD=POST>\n";
echo "<TR><TD></TD><TD><INPUT TYPE=TEXT NAME=\"Desc\" VALUE=\"$Desc\" ID=\"Desc\"></TD><TD><INPUT TYPE=TEXT NAME=\"Type\" VALUE=\"$Type\" ID=\"Type\"></TD><TD><INPUT TYPE=TEXT NAME=\"Pref\" VALUE=\"$Pref\" ID=\"Pref\"></TD><TD><INPUT TYPE=TEXT NAME=\"Min\" VALUE=\"$Min\" ID=\"Min\"></TD><TD><INPUT TYPE=TEXT NAME=\"Risp\" VALUE=\"$Risp\" ID=\"Risp\"></TD><TD><INPUT TYPE=SUBMIT NAME=\"InsertButton\" VALUE=\"". _("Insert") ."\" ID=\"Insert\"></TD>" ;
echo "</FORM>\n";
echo "</TABLE>\n";


mysql_close($dbconnection);
?>


<?php
include('footer.php');
?>
