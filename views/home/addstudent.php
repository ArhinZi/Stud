<html>
	<head>
		<meta charset="UTF-8" />
		<title>Добавить студента</title>

	</head>
	<body>

	
			<h1 align = "center">Добавить студента</h1>
			<a href="../students"><center>Главная</center></a><br>
			<h2><?php echo $log;?></h2>
			<form action="" method="post">
				<p>
					<label>ФИО:<br></label>
					<input name="name" type="text" size="100" maxlength="50">
				</p>
				<p>
					<label>Номер зачетной книжки:<br></label>
					<input name="id" type="text" size="100" maxlength="50">
				</p>
				<p>
					<label>Специализация:<br></label>
					<select size="10" name="szid">
						<option disabled>Специализация</option>
						<?php
							foreach ($specs as $spec)
							{
								echo "<option value=".$spec['id'].">".$spec['name']."</option>";
							}
						?>
					</select>
				</p>
				
				<p>
					<input type="submit" name="submit" value="Добавить">
				</p>
			</form>
	</body>
</html>