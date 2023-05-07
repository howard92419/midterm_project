<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
@header("Content-type:text/html;charset=utf-8");

session_start();

if(isset($_SESSION["student_id"])) {
	$student_id =$_SESSION["student_id"];	


	//Student Selected Courses
	$sql = "select course_id, course_name, department, grade, credits, category
			from course 
			where course_id in (select course_id from selected_course
				where student_id = \"$student_id\")";

	//印出我的已選課程列表			
	$result = mysqli_query($conn, $sql) or die('MySQL query error');
	html_start_box('*****  我的已選課程列表 ******  ', '70%', '   ', '5', 'left', '   ');

	$display_text = array(
		array('display' => 'course_id',             'align' => 'left'),
		array('display' => 'Course Name',         'align' => 'left'),
		array('display' => 'Department',     'align' => 'left'),
		array('display' => 'Grade',     'align' => 'right'),
		array('display' => 'Credits', 'align' => 'right'),
		array('display' => 'Category', 'align' => 'right'),	
	);
	/*html_header($display_text, 2, false);*/

	echo '<table style="border-collapse: collapse; border: 1px solid black;">';
	echo '<tr>';

	foreach ($display_text as $column) {
		echo '<th style="border: 1px solid black; padding: 5px;">' . $column['display'] . '</th>';
	}
	echo '</tr>';

	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_id'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_name'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['department'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['grade'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['credits'] . '</td>';
		$row['category'] == 'Required' ? "必修" : "選修";
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['category'] . '</th>';
		echo '</tr>';
	}
	
	echo '</table>';

	



	while($row = mysqli_fetch_array($result)){

		form_selectable_cell($row['course_id'] , $row['course_id']);
		form_selectable_cell($row['course_name'], $row['course_name']);
		form_selectable_cell($row['department'], $row['department']);			
		form_selectable_cell($row['grade'], $row['grade']);
		form_selectable_cell($row['credits'], $row['credits']);			
		form_selectable_cell(($row['category'] == 'Required' ? "必修" : "選修"), $row['category']);				
		form_end_row();
	}
	html_end_box(false);



	//Student Could Withdraw Courses
	
	//select total_credits
	$sql = "select total_credits from student where student_id = \"$student_id\""; 
	$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
	$row = mysqli_fetch_array($result);
	$total_credits = $row['total_credits'];

	$under_selected = 0;


	//處理退選時的boundary問題
	if ( ($total_credits - 9) >= 3) { 
		$sql = "select course_id, course_name, department, grade, credits
				from course 
				where course_id in (select course_id from selected_course
					where student_id = \"$student_id\") and category = \"Elective\"";	
	} elseif (($total_credits - 9) == 2) {
		$sql = "select course_id, course_name, department, grade, credits
				from course 
				where course_id in (select course_id from selected_course
					where student_id = \"$student_id\") and category = \"Elective\" and credits = 2";		
	} else { //(total_credits - 9) = 0 or 1
		$under_selected = 1; 			
	}


	//印出我的可退選課程列表
	$result = mysqli_query($conn, $sql) or die('MySQL query error');		
	html_start_box('******  我的可退選課程列表 ******  ', '50%', '   ', '5', 'left', '   ');

	$display_text = array(
		array('display' => 'course_id',             'align' => 'left'),
		array('display' => 'Course Name',         'align' => 'left'),
		array('display' => 'Department',       'align' => 'left'),
		array('display' => 'Grade',     'align' => 'right'),
		array('display' => 'Credits', 'align' => 'right'),
		array('display' => 'Action', 'align' => 'right'),		
	);

	if ($under_selected == 1) {
		echo "已達到學分下限，不能再退選囉 !!";
	} else {
		echo '<table style="border-collapse: collapse; border: 1px solid black;">';
		echo '<tr>';

		foreach ($display_text as $column) {
			echo '<th style="border: 1px solid black; padding: 5px;">' . $column['display'] . '</th>';
		}
		echo '</tr>';

		while($row = mysqli_fetch_array($result)){
			echo '<tr>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_id'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_name'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['department'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['grade'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['credits'] . '</td>';
			form_selectable_cell(filter_value("Delete", "", 'delete.php?action=delete&id=' . $row['course_id'] . '&student_id=' . $student_id), "Delete");
			echo '</tr>';
			
		}

		echo '</table>';
		html_end_box(false);
	}

}


?>


<?php
$conn->close();
?>