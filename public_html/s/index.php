<?php
if (isset ( $_GET ["f"] )) {
	$fragment = intval ( $_GET ["f"] );
	if ($fragment > 0) {
		header ( "Location: https://muziekpraktijkvivo.nl/geluidsfragmenten/afspelen/?fragment=$fragment" );
		die ();
	}
}
header ( "Location: https://muziekpraktijkvivo.nl/geluidsfragmenten/" );
die ();
?>
