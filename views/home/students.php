<html>
	<head>
		<meta charset="UTF-8" />
		<title>Зачетные книжки</title>

	</head>
	<body>
			<h1 align = "center">Зачетные книжки</h1>
			<a href="../index.php/student/add"><center>Добавить студента</center></a><br>
			<table align = "center" border = "5" width = "100%">
				<tr>
					<th>id</th>
					<th>name</th>
					<th>date</th>
					<th>activity</th>
				</tr>
				<?php
				foreach($result as $res)
						echo "<tr><td>".$res['id']."</td>"."<td>"."<a href='../index.php/student/".$res['id']."'>".$res['studname']."</a>"."  -  <a href='../index.php/student/edit/".$res['id']."'>Изменить</a>"."  -  <a href='../index.php/student/del/".$res['id']."'>Удалить</a>"."<br>"."</td>"."<td>".$res['date']."</td>"."<td>".(($res['activity']==1)? "Активно" : "Неактивно")."<a href='../index.php/student/setact/".$res['id']."'>Изменить</a>"."</tr>";

				?>
			</table>
	</body>
</html>