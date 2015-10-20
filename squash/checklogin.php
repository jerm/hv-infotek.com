<? 
include("db_connect.php");

$username=$_POST['myusername'];
$password=$_POST['mypassword'];

$query = "SELECT * FROM squash_users WHERE username='$username' AND password='$password'"; 
$result = mysql_query($query);

if(mysql_num_rows($result)==1){
session_register("myusername");
session_register("mypassword");

header("location:portal.php");
} else {
echo "Wrong username or password";
}

?>
