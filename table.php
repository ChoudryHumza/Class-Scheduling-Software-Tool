<!DOCTYPE html>

<html>

<head>

<style>

    .block {

  display: block;

  width: 10%;

  border: none;

  background-color: black;

  color: white;

  padding: 14px 28px;

  font-size: 16px;

  cursor: pointer;

  text-align: center;

}



.block:hover {

  background-color: #ddd;

  color: black;

}

    </style>

</head>

</html>





<?php

    echo '<button class = "block" type="button" onclick="javascript:history.back()">Go Back</button>';

    //include 'testDriver.php';
    $sn = 'localhost';
    $un = 'root';
    $pw = '';
    $db = 'CSC350GroupG';
    $conn = mysqli_connect($sn, $un, $pw, $db );
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    else{
            echo "<form action=\"table.php\" method=\"get\">  
        <select id=\"roomchoice\" name=\"roomchoice\">";
        $sql=" SELECT DISTINCT Room FROM Schedule ORDER BY Room";
        $result = $conn->query($sql);
        if($result->num_rows < 1 ){
            echo "ERROR: No Rooms found to display in dropdown menue"; 
        }
        else{

        while($row = $result->fetch_assoc()){
            $roomFromFile = $row["Room"];
        echo '<option value="'.$roomFromFile.'">'.$roomFromFile.' </option>';
        
        }
    echo "</select>
        <input type=\"submit\" value=\"Submit!\">
        </form>";

        }
        
        $days = array(
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
        );
        $daytimes = array(
            array(8, 9), array(9, 10)
            , array(10, 11), array(11, 12)
            , array(12, 13), array(13, 14)
            , array(14, 15), array(15, 16)
            , array(16, 17), array(17, 18)
            , array(18, 19), array(19, 20)
            , array(20, 21)
        );


        $room = "";
        // SET UP SCHEDULE    
        $schedule = array();
        if (isset($_GET["roomchoice"]))
        {
            $room = $_GET["roomchoice"];
        }
        // get data for schedule
        $sql=" SELECT
                        Section, StartTime, EndTime, CourseNo, DayOfWeek, Room, Section
                    FROM
                        Schedule where Room = '{$room}'
                    ORDER BY
                            StartTime,
                        CASE
                                WHEN DayOfWeek = 'Monday' THEN 1
                                WHEN DayOfWeek = 'Tuesday' THEN 2
                                WHEN DayOfWeek = 'Wednesday' THEN 3
                                WHEN DayOfWeek = 'Thursday' THEN 4
                                WHEN DayOfWeek = 'Friday' THEN 5
                                WHEN DayOfWeek = 'Saturday' THEN 6
                                WHEN DayOfWeek = 'Sunday' THEN 7
                        END ASC";

        $addgap = false;
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            foreach ( $daytimes as $times ) {
            for($x = $row['StartTime'];$x<$row['EndTime'];$x++)
                if ($x == $times[0]) {
                    $schedule["{$times[0]}-{$times[1]}"][$row['DayOfWeek']][] = $row['CourseNo'].'_'.$row['Section'];
            }

            }
        }
    

// DISPLAY SCHEDULE, headers first
echo <<<EOT
<h2 align="center"> $room </h2>
<table border="1">
    <tr>
        <th align="center">Time</th><th align="center">Monday</th><th align="center">Tuesday</th><th align="center">Wednesday</th><th align="center">Thursday</th><th align="center">Friday</th><th align="center">Saturday</th><th align="center">Sunday</th>
    </tr>

EOT;

// iterate through hours
foreach ($daytimes as $times) {
    $timeslot = "{$times[0]}-{$times[1]}";
    $rowTime = "{$times[0]}";

    if ($rowTime > 12)
    {
        $rowTime -= 12;
        echo "<tr><th>$rowTime:00 PM</th>";
    }
    else
    {
        echo "<tr><th>$rowTime:00 AM</th>";
    }
        

    // iterate through days
    foreach ($days as $day) {
        echo '<td>';
        // check for course in this slot
        if ( isset($schedule[$timeslot][$day]) ) {
            // and display each
            foreach ( $schedule[$timeslot][$day] as $Course ) {
                echo "$Course<br>";
            }
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';
    }
    echo "";
    //<input type='button' value='option' class='homebutton' id='btnHome' onClick='location.href = "CSC350TermProjectGroupG_ForHumzaToTestGridView\\option.php"' />
?>

