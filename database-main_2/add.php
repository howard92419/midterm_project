<a href = "selectpage.php"> 回上頁 </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');

session_start();
//$student_id = $_SESSION["student_id"];		

//print $stduent_id;
switch (get_request_var('action')) {
	case 'add':
		$student_id = get_request_var('student_id');
		$credits = get_request_var('credits');		
		//echo $student_id;
		
		$id = get_request_var('id');

		// add selected course_id to course table 	
		$sql = "insert into select_course (student_id,course_id) values(\"$student_id\", \"$id\")"; 
		$result = mysqli_query($conn, $sql) or die('MySQL query error : insert select course');	
		// echo $sql;

		$sql = "select total_credits from student where student_id = \"$student_id\""; 
		$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
		$row = mysqli_fetch_array($result);
		$credits = $row['total_credits'];		

		// current_people + 1
		$sql = "select current_people, credits from course where course_id = \"$id\""; 
		$result = mysqli_query($conn, $sql) or die('MySQL query error');	
		$row = mysqli_fetch_array($result);
		$people = $row['current_people'] + 1;
		
		// total_credits + credits
		$credits = $credits + $row['credits'];

		// update student table
		$sql = "update student set total_credits = $credits where student_id = \"$student_id\"";
		$result = mysqli_query($conn, $sql) or die('MySQL query error : update total_credits ');	
		
		// update course table
		$sql = "update course set current_people = $people where course_id = \"$id\""; 
		$result = mysqli_query($conn, $sql) or die('MySQL query error');	
		


		$sql = "select course_name from course where course_id = \"$id\"";
		$result = mysqli_query($conn, $sql) or die('MySQL query error');	
		$row = mysqli_fetch_array($result);
		$course_name = $row['course_name'];


		echo "已加選課程 : " .  $course_name . "  " . " course_id : " . $id;
		
		break;
}

?>


