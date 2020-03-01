<?php
$ini = parse_ini_file("lazy.ini");
?>

<?php

$var = file('var', FILE_IGNORE_NEW_LINES);


if ($var[0] == 'NHL') {
	$newvar = 'MLB';
} else {
	$newvar = 'NHL';
}
$varlow = strtolower($var[0]);
$newvarlow = strtolower($newvar);
if (isset($_POST['change']) ) {
	$var[0]= $newvar;
	$fpvar = fopen('var', 'w');
	fwrite($fpvar, $newvar);
	fclose($fpvar);
	header("Refresh:0");
}


?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<div class="column-left">
		<img id="lazyman_img" src="https://styles.redditmedia.com/t5_3a9ks/styles/communityIcon_upxs7101my131.png">
		<img id="logo" src="<?php echo $ini[$varlow . '_logo']; ?>">
	</div>
	<div class="column-right">
		LazyMan / LazyStream Recorder<br><?php echo $var[0]; ?> Team Selector
	</div>
</div>

<?php
// see if form was submitted
if (isset($_POST['submit'])) 
{

	$fp = fopen($ini['lazystream_loc'] . '/teams_' . $varlow . '.txt', 'w');

    foreach ($_POST['lines'] as $number => $line) 
    {
	if ($line == "1")
	{
		fwrite($fp, $_POST['linestext'][$number] . '1' . "\n");
	} else {
		fwrite($fp, $_POST['linestext'][$number] . '0' . "\n");
	}
    }
    fclose($fp);

}

$lines = file($ini['lazystream_loc'] . '/teams_' . $varlow . '.txt');

?>
<div class="links">
	<div class="link-left">
		<a id="standings-link_<?php echo $varlow; ?>" href="<?php echo $ini[$varlow . '_standings']; ?>" target="_blank"><?php echo $var[0]; ?> Standings</a>
	</div>
	<div class="link-right">
		<form method="post">
			<input id="other-link" type="submit" name="change" value="<?php echo $newvar; ?> Team Selector" />
		</form>
	</div>
</div>
<div class="table-sel">
	<table id="table_teams_<?php echo $varlow; ?>">
	<col width="80%">
	<col width="20%">
	<tr>
	<th>Team</th>
	<th>Record? (1=yes, 0=no)</th>
	</tr>
	<form method="post">
		<?php foreach ($lines as $number => $text): ?>
		<tr>
		<td>
        	<label for="<?php $cols = explode(';', $text); echo $cols[0] ?>"><?php $cols = explode(';', $text); echo $cols[0] ?></label>
		<input type="hidden" name="linestext[]" value="<?php $cols = explode(';', $text); echo $cols[0] . ';' . $cols[1] .';' ?>">
		</td>
		<td align="center">
		<input type="text" name="lines[]" maxlength="1" size="1" pattern="[0-1]" value="<?php $cols = explode(';', $text); echo $cols[2] ?>" required>
		</td>
		</tr>
		<?php endforeach ?>
		<tr>
		<td />
		<td>
		<input id="submit2" type="submit" name="submit" value="Submit Changes" />
		</td>
		</tr>
	</form>
	</table>
</div>
</body>
</html>
