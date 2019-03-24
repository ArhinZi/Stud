<?php


class Model
{

	public static function getStudents()
	{
		//mysql_query("SET CHARACTER SET 'utf8'");
		$db = Db::getConnection();
		$result = $db->query( //выполняет запрос к бд
								'select *
									from(
										select `record_book`.`id_srb` as id, `record_book`.`date`, `record_book`.`activity`, `record_book`.`name` as studname
											from `record_book`
											order by id desc
										) AS T 
								order by id'
						    );
		$result->setFetchMode(PDO::FETCH_ASSOC); //Задаем режим выборки по умолчанию для объекта запроса
		$List = $result->fetchAll(); //возвращает все строки результирующего набора.

		return $List;


	}
	
	public static function getSpecializations()
	{
		//mysql_query("SET CHARACTER SET 'utf8'");
		$db = Db::getConnection();
		$result = $db->query(
								"
										select *
											from `specialization`
											order by id
								"
										
						    );
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$List = $result->fetchAll();
		return $List;


	}

	public static function getStudent($id)
	{
		//mysql_query("SET CHARACTER SET 'utf8'");
		$db = Db::getConnection();
		//print_r($id);
		$result = $db->query(
								"select `record_book`.`id_srb` as id, `record_book`.`date`, `record_book`.`activity`, `record_book`.`name` as studname, `specialization`.`id` as szid, `specialization`.`name` as szname, `specialty`.`name` as stname, `faculty`.`name` as fname
									from `record_book` join `specialization` on `specialization`.`id` = `record_book`.`id_specialization`  join `specialty` on `specialty`.`id` = `specialization`.`id_specialty`  join `faculty` on `faculty`.`id` = `specialty`.`id_faculty` 
									WHERE `record_book`.`id_srb` = ".$id
						    );
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$List = $result->fetchAll();
		return $List;
	}
	
	public static function getStudentRBid($num)
	{
		//mysql_query("SET CHARACTER SET 'utf8'");
		$db = Db::getConnection();
		//print_r($id);
		$result = $db->query(
								"select `id_srb` 
									from `record_book`
									WHERE `id_srb` = ".$num
						    );
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$List = $result->fetchAll(); 
		return $List;
	}
	
	public static function saveStudent($name,$id,$szid) //метод добавления студентов
	{
		if($name==null && $id==null && $szid==null) return "";
		if($name==null || $id==null || $szid==null) return "Введите все данные";
		$db = Db::getConnection();
		//print_r($id);
		if(Model::getStudentRBid($id)!=null) return "Error: Зачетка есть в Базе";
		$db->exec("INSERT INTO `record_book`(`id_srb`, `name`, `id_specialization`, `date`, `activity`) VALUES ('".$id."','".$name."','".$szid."','".date("Y-m-d")."', 1)");
		return "Успешно добавлен в Базу";
	}
	
	public static function EditStudent($stud,$name,$id,$szid)
	{
		if($name==null && $id==null && $szid==null) return "";
		$db = Db::getConnection();
		print_r($stud);
		$oldid = $stud['id'];
		if($name != "") $stud['studname'] = $name;
		if($id != null) $stud['id'] = $id;
		if($szid != null) $stud['szid'] = $szid;
		print_r($id);
		$db->exec("Update `record_book` Set `id_srb` = ".$stud['id'].", `name` = '".$stud['studname']."', `id_specialization` = ".$stud['szid']." where `id_srb` = ".$oldid);
		return "Успешно";
	}
	
	public static function DelStudent($id)
	{
		$db = Db::getConnection();
		$db->exec("DELETE FROM `record_book` WHERE `id_srb` =".$id);
		return true;
	}
	
	public static function Setact($id)
	{
		$db = Db::getConnection();
		$result = $db->query(
								"select `activity` 
									from `record_book`
									WHERE `id_srb` = ".$id
						    );
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$List = $result->fetchAll();
		if($List[0]['activity']==1) $db->exec("UPDATE `record_book` SET `activity`=0 WHERE `id_srb` =".$id);
		else 			$db->exec("UPDATE `record_book` SET `activity`=1 WHERE `id_srb` =".$id);
		return true;
	}

}