<?
print("<body bgcolor=black>");
print("<font face=\"Verdana\" Color=#FFFFFF>"); 




include("../squash/db_connect.php");


for ($i = 0; $i < rand(0,20); $i++){
	for($j = 0; $j<rand(0,20); $j++){
		$query = "select * from words";
		$result = mysql_query($query);
		$n = mysql_num_rows($result);
		$x = rand(0,$n);
		

//        while ($row = mysql_fetch_assoc($result)){
  //      $arr[count($arr)] = $row['word'];
    //    } 

		while ($x > 0){
			$row = mysql_fetch_assoc($result);
			$x = $x - 1;	
		}
		echo $row['word'];
		echo " ";	
	}	 
	echo ".<br>";

} 


?>
