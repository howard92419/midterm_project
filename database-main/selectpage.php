<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
session_start();

if(isset($_SESSION["student_id"])) {
	$MyHead=$_SESSION["student_id"];	

	//select total_credits
	$sql = "select total_credits from student where student_id = \"$MyHead\""; 
	$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
	$row = mysqli_fetch_array($result);
	$total_credits = $row['total_credits'];

	$over_selected = 0;
	
	//處理加選時的boundary問題
	if ( (30 - $total_credits) >= 3) { 
		$sql = "select course_id, course_name, department, grade, credits, max_people, current_people, category 
			from course
			where current_people < max_people
			and (course_id ) not in (select course_id from select_course 
					where student_id = (select student_id from student
					where student_id = \"$MyHead\" ))
			and (time_slot) not in(select time_slot from course
					where course_id in (select course_id
										from select_course
										where student_id = \"$MyHead\"))";		
	} elseif ((30 - $total_credits) == 2) {
		$sql = "select course_id, course_name, department, grade, credits, max_people, current_people, category 
			from course
			where (current_people < max_people and credits = 2)
			and (course_id ) not in (select course_id from select_course 
					where student_id = (select student_id from student
					where student_id = \"$MyHead\" ))
			and (time_slot) not in(select time_slot from course
					where course_id in (select course_id
										from select_course
										where student_id = \"$MyHead\"))";		
	} else {
		$over_selected = 1;				
	}



	//印出我的可選課程列表
	$result = mysqli_query($conn, $sql) or die('MySQL query error');
	html_start_box('******  我的可選課程列表  ******  ', '100%', '   ', '5', 'left', '   ');
	$display_text = array(
		array('display' => 'course_id',             'align' => 'left'),
		array('display' => 'Course Name',         'align' => 'left'),
		array('display' => 'Department',       'align' => 'left'),
		array('display' => 'Grade',     'align' => 'right'),
		array('display' => 'Credits', 'align' => 'right'),
		array('display' => 'Max People',   'align' => 'right'),
		
		array('display' => 'Current People',   'align' => 'right'),
		array('display' => 'Category',   'align' => 'right'),		
		array('display' => 'Action',   'align' => 'left'),
	);

	if ($over_selected == 1) {

			echo "已達到學分上限，不能再加選囉 !!";

	} else {

		html_header($display_text, 2, false);

		while($row = mysqli_fetch_array($result)){
			form_selectable_cell($row['course_id'] , $row['course_id']);
			form_selectable_cell($row['course_name'], $row['course_name']);			
			form_selectable_cell($row['department'], $row['department']);
			form_selectable_cell($row['grade'], $row['grade']);			
			form_selectable_cell($row['credits'], $row['credits']);	
			form_selectable_cell($row['max_people'], $row['max_people']);				
			form_selectable_cell($row['current_people'], $row['current_people']);	
			form_selectable_cell(($row['category'] == 'Required' ? "必修" : "選修"), $row['category']);					
			form_selectable_cell(filter_value("Add", "", 'add.php?action=add&id=' . $row['course_id'] . '&student_id=' . $MyHead . '&credits=' . $row['credits']), "Add");						
			form_end_row();
		}
		html_end_box(false);
	}	

}
?>


<?php
$conn->close();
?>