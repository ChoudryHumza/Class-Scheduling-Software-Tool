<?php
include 'SchedulingFunctions.php';
//DB Name, CSC350GroupG
/////////////////////////////////////////////////////////
//Start of test data detailing sections to be scheduled
/////////////////////////////////////////////////////////
$testData =  array();
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(4,'CSC211',1));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(2,'GIS101',2));


array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
array_push($testData,new record(4,'CSC211',3));
array_push($testData,new record(4,'CSC211',2));
array_push($testData,new record(3,'CSC101',1));
array_push($testData,new record(3,'CSC101',2));
array_push($testData,new record(3,'CSC101',3));
array_push($testData,new record(2,'GIS101',1));
array_push($testData,new record(1,'GIS101',1));
/////////////////////////////////////////////////////////
//End of test data detailing sections to be scheduled
/////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////
//Test data, add extra rooms by pushing more strings to array
///////////////////////////////////////////////////////////////
    $listOfRooms = array();
    array_push($listOfRooms, 'F901');
    array_push($listOfRooms, 'F902');
    array_push($listOfRooms, 'F903');
    array_push($listOfRooms, 'F904');
    array_push($listOfRooms, 'F905');
    array_push($listOfRooms, 'F906');
    array_push($listOfRooms, 'F907');
    array_push($listOfRooms, 'F908');
    array_push($listOfRooms, 'F909');
    array_push($listOfRooms, 'F910');
    array_push($listOfRooms, 'F911');
    array_push($listOfRooms, 'F912');

//////////////////////////////////////////////////////////////////////
//End of Test data, add extra rooms by pushing more strings to array
//////////////////////////////////////////////////////////////////////
//Function Build Schedule creates, and saves a schedule to 
//The SQL DB
buildSchedule($listOfRooms,$testData);
//echo '<br>';


?>