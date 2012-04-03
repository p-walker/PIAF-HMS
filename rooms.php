<?php
include('config.inc.php');
include('header.php');

echo "<h1>" . _("Rooms management") . "</h1>" ;

$Delete = '';

if(isset($_GET['ID'])){

$Delete=$_GET['ID'];
if ($Delete <> "") :
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database open failed"));
	$query = "DELETE FROM Rooms WHERE ID = " .$Delete;
  	$result = mysql_query($query)
    		or die(_("Database deletion failed"));
	mysql_close($dbconnection);
	$Delete = "";
endif ;

}  



$Import = '';

if(isset($_GET['Import'])){

$Import=$_GET['Import'];
if ($Import == "true") :
	//Purge Hotel Rooms table
	echo _("Extensions imported from FreePBX") . "\n<br />";
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database Hotel open failed"));
	$query = "DELETE FROM Rooms";
  	$result = mysql_query($query)
    		or die(_("Database Hotel-Rooms deletion failed"));
	mysql_close($dbconnection);


	//Load Freepbx users from Asterisk database
 	$dbconnection2 = mysql_connect($dbhost2, $dbuser2, $dbpass2)
    		or die(_("Database connection failed"));
	mysql_select_db($dbname2) or die(_("Database asterisk open failed"));

	$query = "SELECT * FROM `users`";
	$result = mysql_query($query)
    		or die(_("Web site query failed"));
	mysql_close($dbconnection2);
	
	//Insert Freepbx users to Hotel Rooms table
	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    			or die(_("Database Hotel connection failed"));
	while ($row = mysql_fetch_array($result)) {
		mysql_select_db($dbname) or die(_("Database Hotel open failed"));
		$query = "INSERT INTO `Hotel`.`Rooms` (`ID`,`Desc`,`Ext`,`Data`) VALUES (NULL, '" .$row["name"]. "','" .$row["extension"]. "', NULL)";
  		$result2 = mysql_query($query)
    			or die(_("Database Hotel-Rooms insert failed"));
	}
	mysql_close($dbconnection);
	$Import = "";
endif ;

} 
?>
<div id="Menu2">
<!--<a href="rooms.php?Insert=true"><?php echo _("Insert") ?></a>-->  <a href="rooms.php?Import=true"><?php echo _("Import from FreePBX") ?></a>
</div>
<?php
echo "<TABLE cellSpacing=0 cellPadding=0 width=900 border=0>\n" ;
echo "<TR><TD>" . _("Id") . "</TD><TD>" . _("Room") . "</TD><TD>" . _("Ext") . "</TD><TD>" . _("Insert date") . "</TD><TD>" . _("Action") . "</TD>" ;
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database Hotel-Rooms open failed"));
	$query = "SELECT * FROM Rooms order by ID asc";
	$result = mysql_query($query)
    	or die(_("Web site query failed"));
	while ($row = mysql_fetch_array($result)) {
 	echo "<TR><TD><FONT face=verdana,sans-serif>" . $row["ID"] . "</TD><TD>" . $row["Desc"]  . "</TD><TD>" .$row["Ext"] ."</TD><TD>" . $row["Data"] . "</TD><TD><a href=\"rooms.php?ID=" .$row["ID"] . "\">". _("Delete") ."</a></TD></TR>\n" ;
	}

echo "</TABLE>";

mysql_close($dbconnection);
?>

<?php
include('footer.php');

?>

