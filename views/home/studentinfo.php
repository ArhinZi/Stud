<html>
	<head>
		<meta charset="UTF-8" />
		<title>Студент</title>

	</head>
	<body>
			<h2><?php echo $stud[0]['studname']?>(<?php echo $stud[0]['id']?>)</h2>
			<h3 align = "left">Специализация: <?php echo $stud[0]['szname']?></h3>
			<h3 align = "left">Специальность: <?php echo $stud[0]['stname']?></h3>
			<h3 align = "left">Факультет: <?php echo $stud[0]['fname']?></h3>
			<h3 align = "left">Дата регистрации: <?php echo $stud[0]['date']?></h3>
			<h3 align = "left">Активность: <?php echo $stud[0]['activity']?></h3>
	
	</body>
</html>