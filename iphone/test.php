<?
include("../squash/db_connect.php");

$myFile = "en_US.dic";
$fh=fopen($myFile,'r');
$i=0;
$line = fgets($fh);

while ($line = fgets($fh)){
	
	list($word,$extra) = split("/",$line,2);
	//echo($word);
	//echo("<br>");
	$query = "INSERT INTO words VALUES('$word')";
	$result = mysql_query($query);
	$i++;
}
fclose($fh);

print($i);

?>
