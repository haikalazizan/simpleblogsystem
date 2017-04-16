<?php include("classes.php"); ?>
<?php

$master = new Master();
$master->setRootPage = "main.txt";
$master->setOwner = "Muhammad Haikal Azizan";
$master->setYear = "2017";

include("topics.php");
include("downloads.php");

$master->grabImage();

?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta property="og:image" content="<?php echo $master->thumbnailImage; ?>">
<title><?php echo $master->titlePage; ?> - Haikal Azizan</title>
<link rel="stylesheet" type="text/css" href="hklazizan.css"/>
</head>
<body>
<div class="header title-header">HAIKAL AZIZAN</div>
<div id="container">
	<div id="sidebar-right">
		<div class="nav-menu">
			<form class="nav-form">
				<select style='font-size: 18px;' name="menu" onChange='window.location.href = this.value;'>
					<option value='./'>&raquo; HAIKAL AZIZAN &laquo;</option>
					<option value='./'>HOME</option>
					<option value='http://www.intranetmjii.com/'>IntranetMJII</option>
					<option value='../suika'>Suika MJII</option>
					<option value='http://beseri.ikm.edu.my/'>IKM Beseri</option>
				</select>
			</form>
		</div>
		<?php $master->pages(); ?>
	</div>
	<div id="sidebar-left">
		<div class="subcontent">
			<h2 class="title">What's New?</h2>
			<?php $master->topic($topics); ?>
		</div>
		<div class="subcontent" align="center">
			<div id="clocktext"></div>
			<div><small>Kuala Lumpur, Malaysia</small></div>
			<script type="text/javascript">
				"use strict";
				
				var textElem = document.getElementById("clocktext");
				var textNode = document.createTextNode("");
				textElem.appendChild(textNode);
				var curFontSize = 24;  // Do not change
				
				function updateClock() {
					var d = new Date();
					var s = "";
					s += (10 > d.getHours  () ? "0" : "") + d.getHours  () + ":";
					s += (10 > d.getMinutes() ? "0" : "") + d.getMinutes() + ":";
					s += (10 > d.getSeconds() ? "0" : "") + d.getSeconds();
					textNode.data = s;
					setTimeout(updateClock, 1000 - d.getTime() % 1000 + 20);
				}
				
				function updateTextSize() {
					var targetWidth = 0.9;  // Proportion of full screen width
					for (var i = 0; 3 > i; i++) {  // Iterate for better better convergence
						var newFontSize = textElem.parentNode.offsetWidth * targetWidth / textElem.offsetWidth * curFontSize;
						textElem.style.fontSize = newFontSize.toFixed(3) + "pt";
						curFontSize = newFontSize;
					}
				}
				
				updateClock();
				updateTextSize();
				window.addEventListener("resize", updateTextSize);
			</script>
		</div>
		<div class="subcontent">
			<h2 class="title">DOWNLOADS</h2>
			<?php $master->download($download); ?>
		</div>
	</div>
	<?php echo $master->footer(); ?>
</div>
</body>
</html>