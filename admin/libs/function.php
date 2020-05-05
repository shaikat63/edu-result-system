round_cgpa<?php 

  require_once "config.php";


  //Username check function

	function userNameCheck($uname, $conn){

		$sql = "SELECT * FROM users WHERE uname= '$uname' ";
		$data = $conn -> query($sql);
		$num = $data -> num_rows;

		if ($num > 0) {
			return false;
			
		}else{
			return true;
		}
	}

	//Email check

	function emailCheck($email, $conn){

		$sql = "SELECT * FROM users WHERE email= '$email' ";
		$data = $conn -> query($sql);
		$num = $data -> num_rows;

		if ($num > 0) {
			return false;
			
		}else{
			return true;
		}

	}


	//Student Roll Check
	function rollNumberCheck($roll, $conn){

		$sql = "SELECT * FROM students_info WHERE roll= '$roll' ";
		$data = $conn -> query($sql);
		$num = $data -> num_rows;

		if ($num > 0) {
			return false;
			
		}else{
			return true;
		}

	}

	//Student Registration Number Check
	function regNumberCheck($reg, $conn){

		$sql = "SELECT * FROM students_info WHERE reg= '$reg' ";
		$data = $conn -> query($sql);
		$num = $data -> num_rows;

		if ($num > 0) {
			return false;
			
		}else{
			return true;
		}

	}




	// Create a Grad 
	function checkGrad($mark) {
		if( $mark >= 0 && $mark <= 32){
			$grad = 'F';
		}elseif($mark >= 33 && $mark <= 39){
			$grad = 'D';
		}elseif($mark >= 40 && $mark <= 49){
			$grad = 'C';
		}elseif($mark >= 50 && $mark <= 59){
			$grad = 'B';
		}elseif( $mark >= 60 && $mark <= 69 ){
			$grad = 'A-';
		}elseif($mark >= 70 && $mark <= 79){
			$grad = 'A';
		}elseif($mark >= 80 && $mark <= 100){
			$grad = 'A+';
		}else {
			$grad = 'Invalid';
		}

		return $grad;
	}



	// For  GPA Cal
	function checkGpa($mark ){

		if( $mark >= 0 && $mark <= 32){
			$grad = '0';
		}elseif($mark >= 33 && $mark <= 39){
			$grad = '1';
		}elseif($mark >= 40 && $mark <= 49){
			$grad = '2';
		}elseif($mark >= 50 && $mark <= 59){
			$grad = '3';
		}elseif( $mark >= 60 && $mark <= 69 ){
			$grad = '3.5';
		}elseif($mark >= 70 && $mark <= 79){
			$grad = '4';
		}elseif($mark >= 80 && $mark <= 100){
			$grad = '5';
		}else {
			$grad = 'Invalid';
		}

		return $grad;

	}

	// Calculate CGPA
	function checkCgpa($ban_gpa, $eng_gpa, $math_gpa, $s_gpa, $ss_gpa, $r_gpa){

		$total_gpa = $ban_gpa + $eng_gpa +  $math_gpa + $s_gpa + $ss_gpa + $r_gpa;

		$cgpa = $total_gpa / 6;

		return $cgpa;
	} 

	// Check  result 
	function checkResult($ban_gpa, $eng_gpa, $math_gpa, $s_gpa, $ss_gpa, $r_gpa){

		if( $ban_gpa == 0 || $eng_gpa == 0 || $math_gpa == 0 || $s_gpa == 0 || $ss_gpa == 0 || $r_gpa == 0   ){
			$result = "Failed";
		}else{
			$result = "Passed";
		}

		return $result;
	}



	//Check Grade 

	function checkGrade($round_cgpa , $ban_gpa, $eng_gpa, $math_gpa, $s_gpa, $ss_gpa, $r_gpa) {

		if( $ban_gpa == 0 || $eng_gpa == 0 || $math_gpa == 0 || $s_gpa == 0 || $ss_gpa == 0 || $r_gpa == 0   ){
			$grade = 'F';
		}else{
			if($round_cgpa == 5){
				$grade = 'A+';
			}elseif( $round_cgpa >= 4 && $round_cgpa < 5 ){
				$grade = 'A';
			}elseif($round_cgpa >= 3.5 && $round_cgpa < 4 ){
				$grade = 'A-';
			}elseif($round_cgpa >= 3 && $round_cgpa < 3.5){
				$grade = 'B';
			}elseif($round_cgpa >= 2 && $round_cgpa < 3){
				$grade = 'C';
			}elseif($round_cgpa >= 1 && $round_cgpa < 2){
				$grade = 'D';
			}else{
				$grade = 'F';
			}
		}

		return $grade;


	}

	 /*Check result (Update button, if num rows 1 then button update else 0 then it is not update)*/
	 
	function resultCheck($roll, $reg,  $conn ) {
		$sql = "SELECT * FROM students_results WHERE roll= '$roll' AND reg='$reg'";
		$data = $conn  -> query($sql);

		return $data -> num_rows;

	}
 




	



 ?>