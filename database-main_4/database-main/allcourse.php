<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');


	//select all course
	$sql = "select * from course"; 
	$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
	//$row = mysqli_fetch_array($result);
	

	//印出所有課程列表
	$result = mysqli_query($conn, $sql) or die('MySQL query error');
	html_start_box('******  所有課程列表  ******  ', '100%', '   ', '5', 'left', '   ');
	$display_text = array(
		array('display' => 'course_id',    'align' => 'left'),
		array('display' => 'Course Name',  'align' => 'left'),
		array('display' => 'Department',   'align' => 'left'),
		array('display' => 'Grade',        'align' => 'right'),
		array('display' => 'Credits',      'align' => 'right'),
		array('display' => 'Max People',   'align' => 'right'),
		array('display' => 'Current People','align' => 'right'),
		array('display' => 'Category',     'align' => 'right'),		
	);

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
			form_end_row();
		}
		html_end_box(false);

?>


<?php
$conn->close();
?>