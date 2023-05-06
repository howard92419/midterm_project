<a href = "index.php"> 回上頁 </a> <p>
<?php
//確認student_id是否正確

include_once('db.php'); 
include_once('html.php');
include_once('html_utility.php');

//用session傳遞student_id
session_start();
$MyHead = $_POST["MyHead"];
$_SESSION["student_id"] = $MyHead;

//取得student_id
$sql = "SELECT * FROM student where student_id = \"".$MyHead."\";";
$results_id = mysqli_query($conn, $sql) or die('MySQL query error');

//取得password
$password=$_POST["password"];
$sql = "SELECT * FROM student where student_password = \"".$password."\";";
$password_result = mysqli_query($conn, $sql) or die('MySQL query error');


$invalid_data = 0;
$errormsg = 'student_id or student_password is invalid !!';
if ($results_id->num_rows > 0 && $password_result->num_rows > 0) {
    header("location: homepage.php");
  } else {
	$invalid_data = 1;
  }

?>

<html>
<head>
  <title>Login Page</title>
</head>
<body>

  <p>student_id or student_password is invalid !!</p>

</body>
</html>


<?php
$conn->close();
?>