<?php
class Section{
private static $sectionCount = 0;
private $sectionId;
private $meetingTimeList;
private $credits;
private $classCode;
private $timesMeetingPerWeek;
private $dayOfWeekCode;
private $hourCode;

    function print()
    {   
        echo 'Credits: '.$this->credits.
        ' Times Meeting per week: '.$this->timesMeetingPerWeek.
        ' Class Code: '.$this->classCode.
        '-'.$this->getHourCode().$this->getDayOfWeekCode().$this->getSectionId()%10;
        echo ' SectionID: '.$this->getSectionId().' ';
    }
    function isPartiallyAllocated()
    {
        $allocated = false;
        foreach($this->meetingTimeList as $time)
        {
            if($time->getStartHour() == -1)
                $allocated = true;
        }
        return $allocated;
    }
    function deAllocateSection()
    {
        $this->dayOfWeekCode = '';
        $this->hourCode = -1;
    }
    function getClassCode()
    {
        return $this->classCode;
    }
    function getSectionCode()
    {
        return $this->getHourCode().$this->getDayOfWeekCode().$this->getSectionId()%10;
    }
    function setHourCode($code)
    {
        $this->hourCode = $code;
    }
    function getHourCode()
    {
        return $this->hourCode < 10?'0'.$this->hourCode:$this->hourCode;
    }
    function getSectionId()
    {
        return $this->sectionId;
    }
    function getSubPriority()
    {
        return $this->getMeetingTimeCount()*3;
    }
    function getMeetingTimesList()
    {
        return $this->meetingTimeList;
    }
    function getMeetingTimeCount()
    {
        return $this->timesMeetingPerWeek;
    }
    function getCredits()
    {
        return $this->credits;
    }
    function setDayOfWeekCode($code)
    {
        $this->dayOfWeekCode = $code;
    }
    function getDayOfWeekCode()
    {
        return $this->dayOfWeekCode;
    }
    function __construct($credits,$classCode,$timesMeetingPerWeek)
    {
        Section::$sectionCount++;
        $this->sectionId = Section::$sectionCount;
        $this->meetingTimeList = array();
        $this->classCode = $classCode;
        $this->credits = $credits;
        $this->timesMeetingPerWeek = $timesMeetingPerWeek;
        //meeting hours is the client dependent data
        //The rest will be static, and come from our db
        if($credits % $timesMeetingPerWeek == 0)
        {
            for($x = 0;$x<$timesMeetingPerWeek;$x++)
            {
                array_push($this->meetingTimeList,
                    new MeetingTime($credits/$timesMeetingPerWeek,$this));
            }
        }
        else
        {
            if($credits == 4 && $credits >= $timesMeetingPerWeek)
            {
                array_push($this->meetingTimeList,
                    new MeetingTime(3,$this));
                array_push($this->meetingTimeList,
                    new MeetingTime(1,$this));
            }
            else if($credits == 3 && $credits >= $timesMeetingPerWeek)
            {
                array_push($this->meetingTimeList,
                    new MeetingTime(2,$this));
                array_push($this->meetingTimeList,
                    new MeetingTime(1,$this));
            }
            else
            {
                echo 'Class Meeting Time Per Week combination: ';
                echo ' from Sections Class Constructor';
            }
        }
    }
}
class MeetingTime{
    private $section;
    private $hours;
    private $startHour;
    private $dayOfWeek;
    private $roomNo;
    private $id;
    private static $meetingTimeCount = 0;

    function __construct($hours,$sec)
    {
        $this->section = $sec;
        $this->hours = $hours;
        $this->startHour = -1;
        $this->dayOfWeek = -1;
        $this->roomNo = '';
        MeetingTime::$meetingTimeCount++;
        $this->id = MeetingTime::$meetingTimeCount;
    }
    function deAllocate()
    {
        $this->startHour = -1;
        $this->dayOfWeek = -1;
        $this->roomNo = '';
        $this->getSection()->deAllocateSection();
    }
    /*function getId()
    {
        return $this->id;
    }*/
    //day code is a numeric representation where 1 is monday 7 is sunday
    function getMeetingTimeId()
    {
        return $this->id;
    }
    function setDayOfWeek($dayCode)
    {
        $this->dayOfWeek = $dayCode;
    }
    function setRoomNo($roomNo)
    {
        $this->roomNo = $roomNo;
    }
    function setStartHour($time)
    {
        $this->startHour = $time + 8;
    }
    function getRoomNo()
    {
        return $this->roomNo;
    }
    function getStartHour()
    {
        return $this->startHour;
    }
    function getEndHour()
    {
        return $this->startHour + $this->hours;
    }
    function getPriority()
    {
        return $this->section->getSubPriority() + 8/$this->getHours();
    }
    function getSectionId()
    {
        return $this->section->getSectionId();
    }
    function getSection()
    {
        return $this->section;
    }
    function getHours()
    {
        return $this->hours;
    }
    function getDayOfWeek()
    {
        $dow = '';
        if($this->dayOfWeek == '1')
        {
            $dow = 'Monday';
        }
        else if($this->dayOfWeek == 2)
        {
            $dow = 'Tuesday';
        }
        else if($this->dayOfWeek == 3)
        {
            $dow = 'Wednesday';
        }
        else if($this->dayOfWeek == 4)
        {
            $dow = 'Thursday';
        }
        else if($this->dayOfWeek == 5)
        {
            $dow = 'Friday';
        }
        else if($this->dayOfWeek == 6)
        {
            $dow = 'Saturday';
        }
        else if($this->dayOfWeek == 7)
        {
            $dow = 'Sunday';
        }
        return $dow;
    }
    function print()
    {
        $this->section->print();
        echo ' StartingTime: '.$this->startHour;
        echo ' Ending Time: '.($this->startHour+$this->hours);
        echo ' Hours of this meeting: '.$this->hours.' '.$this->roomNo.' ';
        echo $this->getDayOfWeek();
        echo $this->getPriority();
    }
}

?>