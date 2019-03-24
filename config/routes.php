<?php
return array(
	
	'stud/index.php/student/([0-9]+)' => 'home/student/$1',
	'stud/index.php/students' => 'home/students',
	'stud/index.php/student/add' => 'home/addstudent',
	'stud/index.php/student/del/([0-9]+)' => 'home/delstudent/$1',
	'stud/index.php/student/edit/([0-9]+)' => 'home/editstudent/$1',
	'stud/index.php/student/setact/([0-9]+)' => 'home/setact/$1',
	'stud/index.php/([-_a-z0-9]+)' => '404',
	

	);