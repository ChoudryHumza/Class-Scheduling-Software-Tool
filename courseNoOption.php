
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
     
 <title> Grid </title>

    </head>
    <body>
<h2 style = "text-indent: 450px">  Schedule  </h2>
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
      $sql=" SELECT DISTINCT CourseNo FROM Schedule";
      $result = $conn->query($sql);
      if($result->num_rows < 1 ){
          echo "ERROR: No Courses found to display in dropdown menue";
       }
      else{
      echo "<form action=\"courseNoOption.php\" method=\"get\">
      <select id=\"courseChoice\" name=\"courseChoice\">";
      
      $courseArray = array();
      $courseNumberArray = array();
       while($row = $result->fetch_assoc()){
          $courseNo = $row["CourseNo"];
          $splitCourseNumberArray = str_split($courseNo, 3); //Serparate course from the number. EX. CSC101 = CSC and 101.
          $courseArray[] = $splitCourseNumberArray[0];
          $courseNumberArray[] = $splitCourseNumberArray[1];
      }
       // Delete duplicate courses. Otherwise duplicate course display in dropdown.
       $courseArrayNoDuplicate = array_unique($courseArray);
       $courseNumberArrayNoDuplicate = array_unique($courseNumberArray);
       $arrayLength = count($courseArray); 
       for($i = 0; $i < $arrayLength; $i++){
           if($courseArrayNoDuplicate[$i] != "")
          echo '<option value="'.$courseArrayNoDuplicate[$i].'">'.$courseArrayNoDuplicate[$i].' </option>';
       }
       echo '<option value="*"> * </option>';
     echo "</select>
     <select id=\"courseNumberChoice\" name=\"courseNumberChoice\">";
      for($i = 0; $i < $arrayLength; $i++){
          if($courseNumberArrayNoDuplicate[$i] != "")
         echo '<option value="'.$courseNumberArrayNoDuplicate[$i].'">'.$courseNumberArrayNoDuplicate[$i].' </option>';
      }
      echo '<option value="*"> * </option>';
    echo "</select>
      <input type=\"submit\" value=\"Submit!\">
      </form>";
  
      }
          echo '<button class = "block" type="button" onclick="javascript:history.back()">Go Back</button>';

                    $courseOption = $_GET['courseChoice'];
                    $courseNumberOption = $_GET['courseNumberChoice'];
                    $invaildOption = false;
                    $astriskOption = false;
                    if($courseOption == "*" || $courseNumberOption == "*"){
                      if($courseOption == "*" && $courseNumberOption == "*" ){
                        $sql=" SELECT * FROM Schedule";
                        $astriskOption = true;
                      }
                      else{
                       $invaildOption = true;
                       echo "Invaild Option: Must Select '*' From BOTH Drop Down Menue's! Try Again.";
                      } 
                    }
                    if($astriskOption == false){
                    $courseOption .= $courseNumberOption; // append string - course and courseNo
                    $sql=" SELECT Section, Room, StartTime, EndTime, DayOfWeek, CourseNo FROM Schedule WHERE CourseNo = '$courseOption'";
                    }
                    if($invaildOption == false){
                    $result = $conn->query($sql);
                    
                        if($result->num_rows < 1 ){//if no row was returned
                           echo "Invaild Option: This combination of course and course number does not exist. Please choose a vaild option";
                        }
                        else{
                
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




        }
         $conn->close();
        ?>
    </table>
    </body>
    </html>
