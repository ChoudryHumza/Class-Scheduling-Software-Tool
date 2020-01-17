drop database if exists CSC350GroupG;
create database CSC350GroupG;

drop table if exists Schedule;
create table Schedule (
MeetingTimeID INTEGER PRIMARY KEY,
Section VARCHAR(10),
Room VARCHAR(45),
StartTime INTEGER,
EndTime INTEGER,
DayOfWeek VARCHAR(45),
CourseNo CHAR(6)
);
drop table if exists AvailableClasses;
create table AvailableClasses(
CourseNo CHAR(6) PRIMARY KEY,
HoursMeeting INTEGER
);
ALTER TABLE Schedule ADD CONSTRAINT CourseNo FOREIGN KEY (CourseNo) REFERENCES AvailableClasses(CourseNo) ON DELETE RESTRICT ON UPDATE RESTRICT;
insert into AvailableClasses select 'CIS490','3';
insert into AvailableClasses select 'CIS100','3';
insert into AvailableClasses select 'CIS115','3';
insert into AvailableClasses select 'CIS120','2';
insert into AvailableClasses select 'CIS140','2';
insert into AvailableClasses select 'CIS155','4';
insert into AvailableClasses select 'CIS160','2';
insert into AvailableClasses select 'CIS165','3';
insert into AvailableClasses select 'CIS180','3';
insert into AvailableClasses select 'CIS200','3';
insert into AvailableClasses select 'CIS207','4';
insert into AvailableClasses select 'CIS220','3';
insert into AvailableClasses select 'CIS235','4';
insert into AvailableClasses select 'CIS255','3';
insert into AvailableClasses select 'CIS280','3';
insert into AvailableClasses select 'CIS316','3';
insert into AvailableClasses select 'CIS317','4';
insert into AvailableClasses select 'CIS325','3';
insert into AvailableClasses select 'CIS335','3';
insert into AvailableClasses select 'CIS345','3';
insert into AvailableClasses select 'CIS359','3';
insert into AvailableClasses select 'CIS362','3';
insert into AvailableClasses select 'CIS364','3';
insert into AvailableClasses select 'CIS365','4';
insert into AvailableClasses select 'CIS370','3';
insert into AvailableClasses select 'CIS385','3';
insert into AvailableClasses select 'CIS390','3';
insert into AvailableClasses select 'CIS395','3';
insert into AvailableClasses select 'CIS420','3';
insert into AvailableClasses select 'CIS440','3';
insert into AvailableClasses select 'CIS445','3';
insert into AvailableClasses select 'CIS455','3';
insert into AvailableClasses select 'CIS459','3';
insert into AvailableClasses select 'CIS465','3';
insert into AvailableClasses select 'CIS475','4';
insert into AvailableClasses select 'CIS480','3';
insert into AvailableClasses select 'CIS485','3';
insert into AvailableClasses select 'CIS495','3';
insert into AvailableClasses select 'CSC101','3';
insert into AvailableClasses select 'CSC110','4';
insert into AvailableClasses select 'CSC111','4';
insert into AvailableClasses select 'CSC210','3';
insert into AvailableClasses select 'CSC211','3';
insert into AvailableClasses select 'CSC215','3';
insert into AvailableClasses select 'CSC230','3';
insert into AvailableClasses select 'CSC231','4';
insert into AvailableClasses select 'CSC310','3';
insert into AvailableClasses select 'CSC330','3';
insert into AvailableClasses select 'CSC331','3';
insert into AvailableClasses select 'CSC350','3';
insert into AvailableClasses select 'CSC410','3';
insert into AvailableClasses select 'CSC430','3';
insert into AvailableClasses select 'CSC450','3';
insert into AvailableClasses select 'CSC470','4';
insert into AvailableClasses select 'GIS101','3';
insert into AvailableClasses select 'GIS201','4';
insert into AvailableClasses select 'GIS261','3';
insert into AvailableClasses select 'GIS325','2';
insert into AvailableClasses select 'GIS361','3';