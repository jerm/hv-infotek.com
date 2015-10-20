<?
include("../squash/db_connect.php");

$n = $_GET["n"];
mysql_query("delete from word_assoc where number = $n");

function createQuery($arr){

	for ($i=0;$i<count($arr);$i+=1){
		if ($arr[$i] == "1" || $arr[$i] == "0"){
		//	return "select * form words where word regexp '^$'";
		}
	}

	$query = "select * from words where word regexp '^";

	for ($i=0;$i<count($arr);$i+=1){
		$c = $arr[$i];
		switch($c){
			case "0":
				$query .= "0";
			case "1":
			//	echo "1";
				$query .= "1";	
				break;
			case "2":
			//	echo "2";
				$query .=  "[abc]";
				break;
			case "3":
			//	echo "3";
				$query .= "[def]";
				break;
			case "4":
			//	echo "4";
				$query .= "[ghi]";
				break;
			case "5":
			//	echo "5";
				$query .= "[jkl]";
				break;
			case "6":
			//	echo "6";
				$query .= "[mno]";
				break;
			case "7":
			//	echo "7";
				$query .= "[pqrs]";
				break;	
			case "8":
			//	echo "8";
				$query .= "[tuv]";
				break;
			case "9";
			//	echo "9";
				$query .= "[wxyz]"; 
				break;
		}
	}
	$query .= "\$' and word not in ('',' ')";
	return $query;
}


$arr = str_split($n);

function getResults($arr){
	$q = createQuery($arr);
	//echo $q ."<br>";
	$result = mysql_query($q);
	if (!$result) {
    	//	$message  = 'Invalid query: ' . mysql_error() . "\n";
    	//	$message .= 'Whole query: ' . $query;
    	//	die($message);
	}
	return $result;
}

function convertToArray ($result) {
	while ($row = mysql_fetch_assoc($result)){
	$arr[count($arr)] = $row['word'];	
	} 
	
	return $arr;
}


for ($i=0;$i<count($arr);$i++){
	for($j=0;$j<(count($arr)-$i);$j++){
		
		$word1 = str_split(substr($n,0,$i));
		$word2 = str_split(substr($n,$i,$j));
		$word3 = str_split(substr($n,$i+$j));
		
		$r1 = getResults ($word1);
		$r2 = getResults ($word2);
		$r3 = getResults ($word3);
		
		$a1 = convertToArray($r1);
		$a2 = convertToArray($r2);
		$a3 = convertToArray($r3);
		//printArray($a3);
		//print "<br>";

		//print ("Count before padding:" . count($a1). " ". count($a2) . " " . count($a3) . "<br>");
		
		$count_bp = count($a1) + count ($a2) + count ($a3); 
		//print (mysql_num_rows($r3). "<br>");	
		if (count($a1) > 0 ) {
			$a1[count($a1)] = substr($n,0,$i);
		} else {
		//	echo "(zero in 1)";
			$a1[0] = substr($n,0,$i);
		}
		if (count($a2) > 0) {
			$a2[count($a2)] = substr($n,$i,$j);
		} else {
		//	echo "(zero in 2)";
			$a2[0] = substr($n,$i,$j);
		}
		if (count($a3) > 0){ 
			$a3[count($a3)] = substr($n,$i+$j);
		} else {
			$a3[0] = substr($n,$i+$j);	
		//	echo "(zero in 3)";
		}
		
		//print ("Count after padding:" . count($a1). " ". count($a2) . " " . count($a3) . "<br>");
		
		if ($count_bp != 0){
			for ($x = 0;$x<count($a1);$x++){
                		for ($y = 0;$y<count($a2);$y++){
                			for ($z = 0;$z<count($a3);$z++){
						if (!($x == count($a1)-1 && $y == count($a2)-1 && $z == count($a3)-1)){ 
							//print ( $a1[$x] . "-" . $a2 [$y] . "-" . $a3[$z]  . "<br>");
							mysql_query("insert into word_assoc values ('" . $n .  "','" . $a1[$x] . $a2[$y] . $a3[$z] . 
"','')"); 
						} 
        				}
	      			}
		       	}
		}
	}
}

$fr = mysql_query("select distinct * from word_assoc where number = $n order by assoc desc");
//print "<hr>";
while ($row = mysql_fetch_assoc($fr)){ 
	print ($row['assoc']);
        print "|";
}


function printArray($arr){
	for ($i = 0;$i<count($arr);$i++){
		echo($arr[$i]);
		//echo("[".$i."]");	
	}

//	echo("[".$i."]");
}

?>
