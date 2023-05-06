<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
session_start();
$array = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5=>'Fri');
for ($i = 1; $i <= 11; $i++) {
      for($j=1; $j <=5; $j++){
             $table[$i][$j] = "";
      }    
}

	if(isset($_SESSION["student_id"])) {
		$MyHead=$_SESSION["student_id"];	

        $sql="select time_slot_id, time_day, start_time, end_time  from time_slot";             
		$result = mysqli_query($conn, $sql) or die('MySQL query error : ');	
		//echo $sql;
        

		while($row = mysqli_fetch_array($result)){
       
            $i = $row['time_slot_id'];
            $time[$i][0]= $i;
            $time[$i][1]=  $row['time_day'];    
	        $time[$i][2]=  $row['start_time'];    
            $time[$i][3]=  $row['end_time'];                                  

        }        

		// select course_name  	
        $sql="select course_name, course_id, time_slot from course where course_id in (select course_id from select_course where student_id = \"$MyHead\")";
 		$result = mysqli_query($conn, $sql) or die('MySQL query error : insert select course');
		//echo $sql;

		while($row = mysqli_fetch_array($result)){
        
            $slot_id = $row['time_slot'];

            $day = $time[$row['time_slot']][1];
            
            $num1 = $time[$row['time_slot']][2];   
            $num3 = $time[$row['time_slot']][3];               
            if($num3 - $num1 ==2){
             	$num2 = $num1 + 1;               
           	}
            
            $key = array_search($day, $array);     
 			//echo  "  " . $slot_id . "  " . $num1 . "  " . $day . "  " .     $key . "  ";   
 
            $table[$num1][$key] = $row['course_name'];
            $table[$num3][$key] = $row['course_name'];
            if($num3 - $num1 ==2){         
	            $table[$num2][$key] = $row['course_name'];
        	}    
        
        }

		//print_r($table);
	
		html_start_box('******  我的課表  ******  ', '100%', '   ', '5', 'left', '   ');

		$display_text = array(
			array('display' => '        ', 'align' => 'left'),		
			array('display' => 'Monday  ', 'align' => 'left'),
			array('display' => 'Tuesday ', 'align' => 'left'),
			array('display' => 'Wednsday', 'align' => 'left'),
			array('display' => 'Thursday', 'align' => 'left'),
			array('display' => 'Friday  ', 'align' => 'left'),
		);
		html_header($display_text, 2, false);

		for ($i = 1; $i <= 11; $i++) {

			form_selectable_cell($i , $i, 20, "color: blue");

			form_selectable_cell($table[$i][1], $table[$i][1], 0, "padding-top:20px");
			form_selectable_cell($table[$i][2], $table[$i][2], 0, "padding-top:20px");
			form_selectable_cell($table[$i][3], $table[$i][3], 0, "padding-top:20px");			
			form_selectable_cell($table[$i][4], $table[$i][4], 0, "padding-top:20px");
			form_selectable_cell($table[$i][5], $table[$i][5], 0, "padding-top:20px");			
			
			form_end_row();
		}
		html_end_box(false);

	}
?>
