<?php
session_start();
include "include/dbconfig.php";
include "functions.php";
if($_POST){
    extract($_POST);
    $result = ['success' => false, 'heads' => [], 'records'=>[]];
    $studentecord = [];  $subjects = []; $studentMarks = []; $count = $sl = 1;
    $subjectQuery = "SELECT * FROM `subjects` WHERE `course_id`='12'" ;
    $subjectRes   = mysqli_query($conn, $subjectQuery);
   
    while($subjectData = mysqli_fetch_assoc($subjectRes)){
        extract($subjectData);
        $subjectData['head_'.$count] = $subject ;
        $subjects[] = $subjectData;
        $count ++ ;
    }
    $result['heads'] =  $subjects ;
    $sql = "SELECT `marks`.`id`,`marks`.`student_id`,`student_info`.`St_Name` FROM `marks` 
            LEFT JOIN `student_info`  ON  `student_info`.`slno` =  `marks`.`student_id`
            WHERE `admission_id` IN (SELECT `pusuing_id` FROM `pursuing_course` WHERE `course_id`='12' 
            AND `current_status`='PURSUING' AND `session`='2022')";

    $res = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($res)){
        extract($row);
         $query = "SELECT * FROM `marks_details` WHERE `marks_id`='$id' AND `subject_id`='$subject'";
         $marksDetailRes = mysqli_query($conn,  $query);
         $studentecord[] = array('marks_id'=> $id, 'student_name'=> $St_Name);
    }

    foreach ($studentecord as $key => $record) {
        $sl = 1;
        $temp = [];
        $temp['student_name'] = $record['student_name'];
        foreach ($subjects as $key => $subject) {
            
             $query = "SELECT * FROM `marks_details` WHERE `marks_id`='$record[marks_id]' AND `subject_id`='$subject[id]'";
             $marksDetailRes = mysqli_query($conn,  $query);
             if(mysqli_num_rows($marksDetailRes) > 0){
                $marksData         = mysqli_fetch_assoc($marksDetailRes);
                $temp['head_'.$sl] = $marksData['obtained_marks'];
                $sl++;
             }else{
                $temp['head_'.$sl] = "";
                $sl++;
             }
        }
        $studentMarks[] =  $temp ;
       
    }
    $result['records'] =  $studentMarks ;
    echo json_encode($result);
}

?>