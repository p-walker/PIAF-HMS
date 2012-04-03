<?php

include('config.inc.php');
include('header.php');

echo "<center>" ;
echo "<h1>". _("Bills management") ."</h1>\n" ;

echo "<FORM NAME=\"SearchFORM\" ACTION=\"./bills.php\" METHOD=POST>\n";
echo "<div id='Menu2'><TABLE cellSpacing=0 cellPadding=0 width=900 border=0>\n" ;
echo "<TR>\n" ;
echo "<TD> ". _("Check Out") ." </TD>" ;
echo "<TD> ". _("from dd/mm/yyyy") ." <INPUT TYPE=\"TEXT\" NAME=\"FROMD\" ID=\"FROMD\" SIZE=\"1\" MAXLENGTH=\"2\"> / <INPUT TYPE=\"TEXT\" NAME=\"FROMM\" ID=\"FROMM\" SIZE=\"1\" MAXLENGTH=\"2\"> / <INPUT TYPE=\"TEXT\" NAME=\"FROMY\" ID=\"FROMY\" SIZE=\"2\" MAXLENGTH=\"4\"></TD>" ;
echo "<TD> ". _("to dd/mm/yyyy") ." <INPUT TYPE=\"TEXT\" NAME=\"TOD\" ID=\"TOD\" SIZE=\"1\" MAXLENGTH=\"2\"> / <INPUT TYPE=\"TEXT\" NAME=\"TOM\" ID=\"TOM\" SIZE=\"1\" MAXLENGTH=\"2\"> / <INPUT TYPE=\"TEXT\" NAME=\"TOY\" ID=\"TOY\" SIZE=\"2\" MAXLENGTH=\"4\"></TD>" ;
echo "<TD> " . _("Rooms") ;
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database Hotel-Rooms open failed"));

  	$query = "SELECT `ID`, `Desc` FROM `Rooms` ORDER BY `Desc` ASC" ;
 	$result = mysql_query($query) or die (_("Couldn't execute SQL query on Hotel-Users table."));
	mysql_close($dbconnection);
  	echo " <SELECT ID=\"RoomsComboBox\" NAME=\"RoomsComboBox\">";
  	echo "<OPTION VALUE=\"ALL\" SELECTED> ". _("All") ." </OPTION>";
  	while ($row = mysql_fetch_array($result))  {
   	echo "<OPTION VALUE=\"$row[0]\">" . $row[1] . "</OPTION>";
  	}
  	echo "</SELECT>";
echo "</TD>" ;
echo "<TD><INPUT TYPE=\"SUBMIT\" NAME=\"SearchButton\" VALUE=\"". _("Search") ."\"></TD>\n" ;
echo "</TR>\n" ;
echo "</TABLE></div>\n";
echo "</FORM>\n";

if(isset($_POST['SearchButton'])) :


echo "<TABLE cellSpacing=0 cellPadding=0 width=900 border=0>\n" ;
echo "<TR><TD>" . _("Id") . "</TD><TD>". _("Room") ."</TD><TD>". _("Name") ."</TD><TD>" . _("Check In") ."</TD><TD>". _("Check Out") ."</TD><TD>". _("Total") ."</TD><TD>". _("Action") ."</TD>" ;
 	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(_("Database connection failed"));
	mysql_select_db($dbname) or die(_("Database Hotel-Rates open failed"));

	$between = '';
	$room = '';

	$query = "SELECT * FROM `Users`";

	$RoomsComboBox = $_POST['RoomsComboBox'];

	$FROMD = $_POST['FROMD'] ;
	$FROMM = $_POST['FROMM'] ;
	$FROMY = $_POST['FROMY'] ;

	$TOD = $_POST['TOD'] ;
	$TOM = $_POST['TOM'] ;
	$TOY = $_POST['TOY'] ;

 	if ($RoomsComboBox !== 'ALL') {
		$room = " `Room` = '" . $RoomsComboBox . "'";
	}

 	if ($FROMD !== '' AND $FROMM !== '' AND $FROMY !== '') {
		$from = " `Checkout` >= '" . $FROMY . "-" . $FROMM . "-" . $FROMD . "'";
 		if ($TOD !== '' AND $TOM !== '' AND $TOY !== '') {
			$to = " AND `Checkout` <= '" . $TOY . "-" . $TOM . "-" . $TOD . "'";
		}
	$between = $from . $to;
	}


	If ($between !== '' OR $room !== '') {
		$query = $query . " WHERE" ;
	}
	
	If ($between !== '' AND $room !== '') {
		$query = $query . $between . " AND" . $room;
	}

	If ($between !== '' AND $room == '') {
		$query = $query . $between;
	}

	If ($between == '' AND $room !== '') {
		$query = $query . $room;
	}

	$query = $query . " ORDER BY ID DESC";
	//printf($query);

	$result = mysql_query($query) or die(_("Web site query failed"));
	mysql_close($dbconnection);
	while ($row = mysql_fetch_array($result)) {
 	echo "<TR><TD><FONT face=verdana,sans-serif>" . $row["ID"] . "</TD><TD>" . $row["Desc"]  . "</TD><TD>" .$row["Name"] ."</TD><TD>" . $row["Checkin"] . "</TD><TD>" . $row["Checkout"] . "</TD><TD>" . $row["Total"] . "</TD><TD><a href=\"ec.php?Ext=" .$row["Ext"] . "&Checkin=" . $row["Checkin"] . "&Checkout=" . $row["Checkout"] ."\">". _("Report") ."</a></TD></TR>\n" ;
	}
echo "</TABLE>\n";
endif;


include('footer.php');
?>
