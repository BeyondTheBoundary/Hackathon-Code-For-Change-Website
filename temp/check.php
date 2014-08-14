<?php 
$connect = mysql_connect("mysql.freehosting.io", "u488574653_swf", "code4change") 
	or die("Check your connection!"); 
mysql_select_db("u488574653_swf");
echo "Okay man!";

$query = "SELECT username, billcode " . 
		 "FROM transaction " .
		 "ORDER BY username ";

$result = mysql_query($query) 
	or die(mysql_error());

while($row = mysql_fetch_array($result)) {
	extract($row);
	echo $username . " - " . $billcode . "<br />";
}
?>
