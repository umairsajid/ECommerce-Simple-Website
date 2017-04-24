<?php 
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters

// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "../storescripts/connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
<html>
<head>
<title>Store Admin Area</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
<style>
body{
    background-image:url("style/bg.jpg");
}
</style>
</head>

<body>
<div align="center" id="mainWrapper">

<div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
  <tr>
    <td width="32%"><a href="../index.php"><img src="../style/logo.jpg" alt="Logo" width="252" height="36" border="0" /></a></td>
    <td width="68%" align="right"><a href="../cart.php">Your Cart</a></td>
  </tr>
  <tr>
    <td colspan="2"><a href="../index.php">Home</a> &nbsp; &middot; &nbsp; <a href="../product.php">Products</a> &nbsp; &middot; &nbsp; <a href="../help.php">Help</a> &nbsp; &middot; &nbsp; <a href="../contact.php">About Us</a></td>
    </tr>
  </table>
</div>

  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2>Hello store manager, what would you like to do today?</h2>
      <p><a href="inventory_list.php">Manage Watches Inventory</a><br />
      </p>
    </div>
    <br />
  <br />
  <br />
  </div>
  <?php include_once("../template_footer.php");?> 

</div>
</body>
</html>