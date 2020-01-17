<!DOCTYPE html> 
<html>
    <head>
    <style>
    html, body{
    width:100%;
    height:100%;
    margin:2%;
    padding:0%;
    border:0%;

    }
    table{
        border:2px solid black;
        border-collapse: collapse;
        width:80%;
        overflow-y: scroll;
        background-color: #ddd;
    }
    th,td{
    border-collapse: collapse;
    width:5%;
    text-align:center;
    border:2px solid black;
    overflow-y: scroll;
    background-color: #f2f2f2;
    }
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
     
 <title> 350 </title>
    </head>
    <body>
<h2 style = "text-indent: 450px"> Full Schedule Information </h2>
<?php


     $sn = 'localhost';
     $un = 'root';
     $pw = '';
     $db = 'CSC350GroupG';
     $conn = mysqli_connect($sn, $un, $pw, $db );
    echo "<table>";
    echo "<tr> <th> Class No </th>  <th> Section No </th> <th> Room No </th> <th> Start Time </th> <th> End Time </th> <th> Day Of Week </th>  </tr>";
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    else{
        $sql=" SELECT Section, Room, StartTime, EndTime, DayOfWeek, CourseNo FROM Schedule";
             $result = $conn->query($sql);
            
            if($result->num_rows < 1 ){//if no row was returned
               echo "ERROR: No data returned";
               echo '<button class = "block" type="button" onclick="javascript:history.back()">Go Back</button>';

            }
            else{
                echo '<button class = "block" type="button" onclick="javascript:history.back()">Go Back</button>';
            while($row = $result->fetch_assoc()){//loop through the returned rows
                $startTime = $row["StartTime"];
                $endTime = $row["EndTime"];
                $startTime .= ":00"; //append. Needed for the follwing function 
                $endTime .= ":00";
                $start_time_in_12_hour_format  = date("g:i a", strtotime($startTime));
                $end_time_in_12_hour_format  = date("g:i a", strtotime($endTime));

              echo "<tr> <td> ".$row["CourseNo"]." </td> <td>  ".$row["Section"]." </td> <td> ".$row["Room"]." </td> <td> ".$start_time_in_12_hour_format." </td> <td> ".$end_time_in_12_hour_format." </td><td> ".$row["DayOfWeek"]." </td> </tr>";
            }
        }

        }

         $conn->close();
        ?>
    </table>
    </body>
    </html>
