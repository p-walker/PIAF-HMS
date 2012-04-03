<?php 
	// localization
	if (isset($lang)) {
		setlocale(LC_ALL,  $lang);
		putenv("LANGUAGE=".$lang);
	} else {
		setlocale(LC_ALL,  'en_US');
	}
	bindtextdomain('hotel','./i18n');
	bind_textdomain_codeset('hotel', 'utf8');
	textdomain('hotel');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _("PIAF Hospitality Management System") ?></title>
<link rel="stylesheet" type="text/css" href="css/Hotel.css"/>
</head>
<body>

<div id="HeadLine">
<?php echo _("PIAF H.M.S.") ?>
</div>
<div id="MenuTop">
<a href="index.php"><img src="img/Menutop_Home.png" alt="<?php echo _("Home") ?>"><?php echo _("Home") ?></a>
<a href="rooms.php"><img src="img/Menutop_Camere.png" alt="<?php echo _("Rooms") ?>"><?php echo _("Rooms") ?></a>
<a href="rates.php"><img src="img/Menutop_Tariffe.png" alt="<?php echo _("Rates") ?>"><?php echo _("Rates") ?></a>
<a href="checkin.php"><img src="img/Menutop_CheckIn.png" alt="<?php echo _("Check In") ?>"><?php echo _("Check In") ?></a>
<a href="checkout.php"><img src="img/Menutop_CheckOut.png" alt="<?php echo _("Check out") ?>"><?php echo _("Check out") ?></a>
<a href="bills.php"><img src="img/Menutop_EC.png" alt="<?php echo _("Bills") ?>"><?php echo _("Bills") ?></a>
<a href="wakeup.php"><img src="img/Menutop_Sveglie.png" alt="<?php echo _("Wake Up") ?>"><?php echo _("Wake Up") ?></a>
</div>
<div id="Content">
