<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');

//用session傳遞student_id
session_start();
$student_id = $_SESSION["student_id"];

//select student data
$sql = "select student_id,name,grade,department,total_credits from student where student_id = \"$student_id\""; 
$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
</head>
<body>

  <a href = "index.php"> 登出 </a> <p>

  <ul>
    <li><a href="selectpage.php">選課頁面(顯示可選課程)</a></li>
    <li><a href="selectedpage.php">已選課程(顯示此學生已選課程)</a></li>
    <li><a href="week.php">我的課表</a></li>
    <li><a href="allcourse.php">所有課程</a></li>
    <li><a href="homepage.php">學生資料</a></li>
  </ul>

  <br>
  <hr>
  <br>

  <div>
    <p> Student's infomation : </p>
    <p> <?php print 'student_id: ' . $row['student_id']; ?> </p>
    <p> <?php print " name: " . $row['name']; ?> </p>
    <p> <?php print " grade: "  . $row['grade']; ?> </p>
    <p> <?php print " department: " . $row['department']; ?> </p>
    <p> <?php print " total_credits: " . $row['total_credits']; ?> </p>
  </div>


</body>
</html>



<?php
$conn->close();
?>