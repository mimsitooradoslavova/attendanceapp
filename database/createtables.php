<?php

$path =$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendanceapp/database/database.php";
function clearTable($dbo,$tabName){
    $c="delete from :tabname";
    $S=$dbo->conn->prepare($c);
    try{
    $s->execute([":tabname"=>$tabName]);
    }
    catch(PDOException $oo) {	

    }
};
$dbo=new Database();
$c="create table student_details
(
    id int auto_increment primary key,
    roll_no varchar(20) unique,
    name varchar(50)
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>student_details created");
}
catch(PDOException $o) {
    echo("<br>student_details not created");
}

$c="create table course_details
(
    id int auto_increment primary key,
    code varchar(20) unique,
    title varchar(50),
    credit int
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>course_details created");
}
catch(PDOException $o) {
    echo("<br>course_details not created");
}

$c="create table faculty_details
(
    id int auto_increment primary key,
    user_name varchar(20) unique,
    name varchar(100),
    password varchar(50)
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>faculty_details created");
}
catch(PDOException $o) {
    echo("<br>faculty_details not created");
}

$c="create table session_details
(
    id int auto_increment primary key,
    year int,
    term varchar(50),
    unique (year,term)
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>session_details created");
}
catch(PDOException $o) {
    echo("<br>session_details not created");
}

$c="create table course_registration
(
    student_id int,
    course_id int,
    session_id int,
    primary key (student_id,course_id,session_id)
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>course_registration created");
}
catch(PDOException $o) {
    echo("<br>course_registration not created");
}

$c="create table course_allotment
(
    faculty_id int,
    course_id int,
    session_id int,
    primary key (faculty_id,course_id,session_id)
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>course_allotment created");
}
catch(PDOException $o) {
    echo("<br>course_allotment not created");
}

$c="create table attendance_details
(
    faculty_id int,
    course_id int,
    session_id int,
    student_id int,
    on_date date,
    status varchar(10,)
    primary key (faculty_id,course_id,session_id,student_id,on_date)
)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
    echo("<br>attendance_details created");
}
catch(PDOException $o) {
    echo("<br>attendance_details not created");
}

$c="insert into student_details
(id,roll_no,name)
values
    //Tuka trqba da se vkarat dannite za studentite
(),
()";

$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o) {
    echo("<br>duplicate entry");
}

$c="insert into faculty_details
(id,user_name,password,name)
values
    //Tuka trqba da se vkarat dannite za faculty
(),
()";

$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o) {
    echo("<br>duplicate entry");
}

$c="insert into session_details
(id,year,term)
values
    //Tuka trqba da se vkarat dannite za session
(),
()";

$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o) {
    echo("<br>duplicate entry");
}

$c="insert into course_details
(id,title,code,credit)
values
    //Tuka trqba da se vkarat dannite za course
(),
()";

$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o) {
    echo("<br>duplicate entry");
}

//if any record already there in the table delete them
clearTable($dbo,"course_registration");
$c= "insert into course_registration
(student_id,course_id,session_id)
values
(:sid,:cid,:sessid)";
$s=$dbo->conn->prepare($c);
//iterate over all the 24 students
//for each of them chose max 3 random courses,from1 to 6

for($i=1;$i<=24;$i++)
{
    for($j=0;$j<3;$j++)
    {
        $cid=rand(1,6);
        //insert the selected course into course_registration table for
        //session 1 and student_id $i
        try{
            $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>1]);
        }
        catch(PDOException $pe) {

        }

        //repeat for session 2
        $cid=rand(1,6);
        //insert the selected course into course_registration table for
        //session 1 and student_id $i
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>2]);
        }
        catch(PDOException $pe) {

        }
    }
}

//if any record already there in the table delete them
clearTable($dbo,"course_allotment");
$c= "insert into course_allotment
(faculty_id,course_id,session_id)
values
(:fid,:cid,:sessid)";
$s=$dbo->conn->prepare($c);
//iterate over all the 6 teachers
//for each of them chose max 3 random courses,from1 to 6

for($i=1;$i<=6;$i++)
{
    for($j=0;$j<2;$j++)
    {
        $cid=rand(1,6);
        //insert the selected course into course_allotment table for
        //session 1 and fac_id $i
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>1]);
        }
        catch(PDOException $pe) {

        }

        //repeat for session 2
        $cid=rand(1,6);
        //insert the selected course into course_allotment table for
        //session 1 and fac_id $i
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>2]);
        }
        catch(PDOException $pe) {

        }
    }
}