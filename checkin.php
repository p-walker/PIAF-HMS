<?php

include('config.inc.php');
include('header.php');

echo "<h1>". _("Check-in management") ."</h1>" ;

if(isset($_POST['SaveButton'])) :
   // process as form post
		for ($i=1; $i<=$_POST['num_rows']; $i++) {
			 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    					or die(_("Database Hotel connection failed"));
				if (isset($_POST["cb". $i])) {

				$Room = $_POST["ID". $i] ;
				$Desc = $_POST["Desc". $i] ;
				$Ext = $_POST["cb". $i] ;
				$Name = $_POST["Name". $i] ;


				mysql_select_db($dbname) or die(_("Database Hotel-Users open failed"));
  				$query = "INSERT INTO `Users` (`ID`, `Room`, `Desc`, `Ext`, `Name`, `Checkin`, `Checkout`, `Total`) VALUES (NULL, '".$Room."', '".$Desc."', '".$Ext."', '".$Name."', NOW(), NULL, NULL)";
  				$result = mysql_query($query)
   					or die(_("Database Hotel-Users insert failed"));
				mysql_close($dbconnection);
				}
		}
endif;

echo "<FORM NAME=\"UpdateFORM\" ACTION=\"./checkin.php\" METHOD=POST>\n";
echo "<TABLE cellSpacing=0 cellPadding=0 width=900 border=0>\n" ;
echo "<TR><TD>" . _("Id") . "</TD><TD>". _("Room") ."</TD><TD>". _("Ext") ."</TD><TD>". _("Name") ."</TD><TD>". _("Check In") ."</TD></TR>\n" ;
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    		or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database Hotel-Rates open failed"));
	$query = "SELECT * FROM Rooms WHERE ID NOT IN (SELECT Room FROM Users WHERE Checkout IS NULL) ORDER BY ID ASC";
	$result = mysql_query($query)
    	or die(_("Web site query failed"));

	$count = 0;
	while ($row = mysql_fetch_array($result)) {
	$count++;
 	echo "<TR><TD><FONT face=verdana,sans-serif>" . $row["ID"] . "</TD><TD>" . $row["Desc"]  . "<INPUT TYPE=\"HIDDEN\" name=\"Desc".$count."\" id=\"Desc".$count."\" VALUE=\"" . $row["Desc"]."\"></TD><TD>" .$row["Ext"] ."</TD><TD><INPUT TYPE=TEXT NAME=\"Name".$count."\" VALUE=\"\" ID=\"Name".$count."\"></TD><TD><input type=\"checkbox\" name=\"cb".$count."\" id=\"cb" .$count. "\" value=\"" .$row["Ext"] . "\"><INPUT TYPE=\"HIDDEN\" name=\"ID".$count."\" id=\"ID".$count."\" VALUE=\"" . $row["ID"]."\"></TD>\n";
	}
echo "</TABLE>\n";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"num_rows\" VALUE=\"" .$count. "\">\n" ;
echo "<BR><BR><INPUT TYPE=SUBMIT NAME=\"SaveButton\" VALUE=\"". _("Save") ."\" ID=\"Save\">\n" ;
echo "</FORM>\n";


mysql_close($dbconnection);
?>


<?php
include('footer.php');
?>
