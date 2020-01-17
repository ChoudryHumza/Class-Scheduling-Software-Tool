<?php
include 'rooms.php';
include 'classesClasses.php';


function cmpMeetingTimeDesc($a, $b) 
{
    return $b->getPriority() - $a->getPriority();
}
function cmpMeetingTimeAsc($a, $b) 
{
    return $a->getPriority() - $b->getPriority();
}
function runQuery($conn,$sql)
{
    $result = mysqli_query($conn, $sql);						
    if(!$result)												
        { echo "error running: ".$sql; }
}
class record{
    public $credits;
    public $classCode;
    public $timesMeetingPerWeek;
    function __construct($credits,$classCode,$timesMeetingPerWeek)
    {
        $this->credits = $credits;
        $this->classCode = $classCode;
        $this->timesMeetingPerWeek = $timesMeetingPerWeek;
    }

}

function findPartialAllocations(&$sectionList)
{
    $partials = array();
    foreach($sectionList as $section)
    {
        if($section->isPartiallyAllocated())
        {
            array_push($partials,$section);
        }
    }
    return $partials;
}
function buildSchedule($listOfRooms,$sectionRecords)
{
//////////////////////////////////////////////////////////////////////
//Start of code to create schedule in DB
//////////////////////////////////////////////////////////////////////
$rooms = new Rooms($listOfRooms);
$schedule = generateSchedule($sectionRecords,$rooms);
$hoursScheduled = 0;
$sn = 'localhost';
$un = 'root';
$pw = '';
$db = 'CSC350GroupG';
$conn = mysqli_connect($sn, $un, $pw, $db );
$sql = "truncate table Schedule";
runQuery($conn,$sql);

$sql = "insert into Schedule values";
foreach($schedule as $time)
{
    $meetingTimeId = $time->getMeetingTimeId();
    $sectionNo = $time->getSection()->getSectionCode();
    $roomNo = $time->getRoomNo();
    $startTime = $time->getStartHour();
    $endTime = $time->getEndHour();
    $DayOfWeek = $time->getDayOfWeek();
    $classCode = $time->getSection()->getClassCode();

     $sql .= "($meetingTimeId,'$sectionNo','$roomNo',$startTime,$endTime,'$DayOfWeek','$classCode'),";
    
}
$sql = substr($sql,0,strlen($sql)-1);
$sql = $sql.';';
runQuery($conn,$sql);
//////////////////////////////////////////////////////////////////////
//End of code to create schedule in DB
//////////////////////////////////////////////////////////////////////

}
function allocate(&$meetingTimeList,&$rooms)
{

    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesMondayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushMon($meetingTime);
        }
    }
    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesTuesdayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushTue($meetingTime);
        }
    }
    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesWednesdayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushWed($meetingTime);
        }
    }
    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesThursdayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushThu($meetingTime);
        }
    }
    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesFridayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushFri($meetingTime);
        }
    }
    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesSaturdayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushSat($meetingTime);
        }
    }
    foreach($meetingTimeList as $meetingTime)
    {
        $room = $rooms->doesSundayHaveSpace($meetingTime);
        if($room != false && $meetingTime->getStartHour() < 0)
        {
            $room->pushSun($meetingTime);
        }
    }
    
}
function generateSchedule($recordList,$rooms)
{


$sectionList = array();
foreach($recordList as $x)
{
    array_push($sectionList,
        new Section($x->credits,$x->classCode,$x->timesMeetingPerWeek));
}
$cred4 = array();
$cred3 = array();
$cred2 = array();
foreach($sectionList as $sec)
{
    /*
    $sec->print();
    echo '<br>';
    */
    if($sec->getCredits() == 3)
    {
        foreach($sec->getMeetingTimesList() as $meetingTime)
            array_push($cred3,$meetingTime);
    }
    else if($sec->getCredits() == 4)
    {
        foreach($sec->getMeetingTimesList() as $meetingTime)
            array_push($cred4,$meetingTime);
    }
    else if($sec->getCredits() == 2)
    {
        foreach($sec->getMeetingTimesList() as $meetingTime)
            array_push($cred2,$meetingTime);
    }
   /*else
    {
        //Only for debugging to show when a class is 
        //considered invalid by Algorithm
        echo 'invalid class no class with '.$sec->getCredits();
        echo ' credits exists ';
        echo 'class '.$sec->getClassCode();
        echo ' will not be processed<br>';
       
    }*/
}
usort($cred4, 'cmpMeetingTimeAsc');
usort($cred3, 'cmpMeetingTimeAsc');
usort($cred2, 'cmpMeetingTimeAsc');
/*For Testing sorting, and priority assignment
foreach($cred4 as $x)
{
    //if($x->getSection()->getMeetingTimeCount() == 2)
    {
        $x->print();
        echo '<br>';
    }
}*/

allocate($cred4,$rooms);
allocate($cred3,$rooms);
allocate($cred2,$rooms);
//For debugging to see generated schedule
/*
echo 'Allocations:<br>';
foreach($cred4 as $x)
{
    //if($x->getSection()->getMeetingTimeCount() == 2)
    {
       // $x->print();
       // echo '<br>';
    }
}
*/
//Start Deallocate all partial allocations
$toBeDeAllocated = findPartialAllocations($sectionList);

foreach($toBeDeAllocated as $sectionToDeAllocate)
{
    $rooms->deAllocateSection($sectionToDeAllocate);
}
//End Deallocate all partial allocations
//Start split deallocated times by credits
$deAllocatedTimes2 = array();
$deAllocatedTimes3 = array();
$deAllocatedTimes4 = array();
foreach($toBeDeAllocated as $sectionToDeAllocate)
{
    foreach($sectionToDeAllocate->getMeetingTimesList() as $time)
    {
        if($time->getSection()->getCredits() == 2)
            array_push($deAllocatedTimes2,$time);
        else if($time->getSection()->getCredits() == 3)
            array_push($deAllocatedTimes3,$time);
        else
            array_push($deAllocatedTimes4,$time);
    }   
}
//End split deallocated times by credits
//Start Sort for reallocation
usort($deAllocatedTimes2, 'cmpMeetingTimeAsc');
usort($deAllocatedTimes3, 'cmpMeetingTimeAsc');
usort($deAllocatedTimes4, 'cmpMeetingTimeAsc');
//End Sort for reallocation
//Start reallocate
allocate($deAllocatedTimes2,$rooms);
allocate($deAllocatedTimes3,$rooms);
allocate($deAllocatedTimes4,$rooms);
//End reallocate

//Final deallocation
$toBeDeAllocated = findPartialAllocations($sectionList);

foreach($toBeDeAllocated as $sectionToDeAllocate)
{
    $rooms->deAllocateSection($sectionToDeAllocate);
}
//End Final deallocation
$finalSchedule = array();
foreach($sectionList as $section)
{
    foreach($section->getMeetingTimesList() as $time)
    {
        if($time->getStartHour() != -1)//-1 start hour means time is unallocated
        {
            array_push($finalSchedule,$time);
        }
    }
}
return $finalSchedule;
}
?>