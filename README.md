# Web Class Scheduling Software Tool


- This is an implementation of a class scheduling software tool.
- A web tool that generates a weekly schedule for all rooms based on user inputs (rooms, courses, and course-related information).
- Frontend: User input page for course and room data upload, option page, full schedule weekly grid, and weekly schedule grid of selected room.
- Backend: Algorithm that generate a weekly schedule based on user input of rooms, courses, meeting times, and number of hours each course meets per week.
Creating and querying an SQL database.
- Developed using HTML5, CSS, PHP, SQL, and MySQL Workbench.

CSVInputPage.php 
- This is the intial page that requires two text files, one with a list of rooms, and the other with a list of courses followed by the number of that particular course meets per-week (e.g. (CSC101, 3), (CSC111, 2)..etc).

Option.php
- This is the page the follows the inital page. One the user has submitted the two files and hit the submit button, they will be directed to this page.
- This page gives a few options to the user. 
  1) A drop down menue with a list of rooms. Once a room is picked and the user 

