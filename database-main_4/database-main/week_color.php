<a href = "homepage.php"> 回上頁(Homepage) </a>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
session_start();
$array = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5=>'Fri');
$color = array(0=> "White", 1 => 'color:Cyan', 2 => 'color:Red', 3 => 'color:Green', 4 => 'color:DarkGrey', 5=>'color:Orange',
				6 => 'color:Black', 7 => 'color:Chocolate', 8 => 'color:Brown', 9 => 'color:BlueViolet', 10=>'color:GreenYellow',
				11 => 'color:Gold', 12 => 'color:SteelBlue', 13 => 'color:MediumSeaGreen', 14 => 'color:Navy', 15=>'color:Olive',
				16 => 'color:Tomato', 17 => 'color:Salmon', 18 => 'color:Maroon', 19 => 'color:Purple', 20=>'color:Peru');
				
				
for ($i = 1; $i <= 11; $i++) {
      for($j=1; $j <=5; $j++){
             $table[$i][$j][0] = "";
             $table[$i][$j][1] = 0;
             
             
      }    
}


	if(isset($_SESSION["student_id"])) {
		$MyHead=$_SESSION["student_id"];	



        $sql="select time_slot_id, time_day, start_time, end_time  from time_slot";             
		$result = mysqli_query($conn, $sql) or die('MySQL query error : insert select course');	
//		echo $sql;
        

        
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
//		echo $sql;

		while($row = mysqli_fetch_array($result)){
        
            $slot_id = $row['time_slot'];

            $day = $time[$row['time_slot']][1];		// day          
            $num1 = $time[$row['time_slot']][2];    // start_time
            $num3 = $time[$row['time_slot']][3];    // end_time           
            if($num3 - $num1 ==2){
             	$num2 = $num1 + 1;               	
           	}
            
            $key = array_search($day, $array);     
 //           echo  "  " . $slot_id . "  " . $num1 . "  " . $day . "  " .     $key . "  ";   
 
            $table[$num1][$key][0] = $row['course_name'];
            $table[$num1][$key][1] = $row['time_slot'];		// use to index to differnt color style
            
            $table[$num3][$key][0] = $row['course_name']; 
            $table[$num3][$key][1] = $row['time_slot'];           
            
            if($num3 - $num1 ==2){         
	            $table[$num2][$key][0] = $row['course_name'];
	            $table[$num2][$key][1] = $row['time_slot'];	            
        	}    
        
        }

	//	print_r($table);
	
		html_start_box('****  Courses  ****  ', '100%', '   ', '5', 'left', '   ');

		$display_text = array(
			array('display' => '          ', 'align' => 'left'),		
			array('display' => 'Monday    ', 'align' => 'left'),
			array('display' => 'Tuesday   ', 'align' => 'left'),
			array('display' => 'Wednsday  ', 'align' => 'left'),
			array('display' => 'Thursday  ', 'align' => 'left'),
			array('display' => 'Friday    ', 'align' => 'left'),
		);


		html_header($display_text, 2, false);


		for ($i = 1; $i <= 11; $i++) {

		
			form_selectable_cell($i , $i, 20, "color: blue");

			form_selectable_cell($table[$i][1][0], $table[$i][1][0], 0,  $color[$table[$i][1][1]]);

			form_selectable_cell($table[$i][2][0], $table[$i][2][0], 0, $color[$table[$i][2][1]]);

			form_selectable_cell($table[$i][3][0], $table[$i][3][0], 0, $color[$table[$i][3][1]]);

			form_selectable_cell($table[$i][4][0], $table[$i][4][0], 0, $color[$table[$i][4][1]]);

			form_selectable_cell($table[$i][5][0], $table[$i][5][0], 0, $color[$table[$i][5][1]]);		
				

			form_end_row();
			
		}
	


		html_end_box(false);


	}
?>
