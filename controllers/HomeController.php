<?php

include_once ROOT. '/models/Model.php';

class HomeController {

	public function actionStudents() //список всех студентов
	{
		
		$newsList = array(); 
		$result = Model::getStudents();
		require_once(ROOT . '/views/home/students.php');//открываем страницу
		return true;
	}

	public function actionStudent($id) //информация о студенте
	{
		//print_r($id[0]. 'sdgsd');
		$stud = Model::getStudent($id[0]);
		//print_r($stud[0]);
		if(isset($stud[0]))  //Определяем, была ли установлена переменная значением отличным от NULL
		{
			//print_r('qwer(0)');
			require_once(ROOT . '/views/home/studentinfo.php');
			return true;
		}
		else
		{	
			return false;			
		}
	}
	
	public function actionAddstudent() //действие на добавление студента в базу
	{
		@$id = $_POST['id'];
		@$name = $_POST['name'];
		@$szid = $_POST['szid'];
		$specs = Model::GetSpecializations();//выбираем специализации
		$log = (Model::SaveStudent($name,$id,$szid));//вывод результата добавления
		require_once(ROOT . '/views/home/addstudent.php');
		return true;
	}
	
	public function actionEditstudent($id) //изменение студента в базу
	{
		$stud = Model::getStudent($id[0]);
		if($stud === array()) return false;
		@$name = $_POST['name'];
		@$id = $_POST['id'];
		@$szid = $_POST['szid'];
		$specs = Model::GetSpecializations();//выбираем специализации
		$log = (Model::EditStudent($stud[0],$name,$id,$szid));
		if ($log == "Успешно") header("Location: http://localhost/stud/index.php/students");
		require_once(ROOT . '/views/home/editstudent.php');
		return true;
	}
	
	public function actionDelstudent($id) //действие на добавление студента в базу
	{
		Model::DelStudent($id[0]);//вывод результата добавления
		header("Location: http://localhost/stud/index.php/students");
		return true;
	}
	
	public function actionSetact($id) //действие на добавление студента в базу
	{
		Model::Setact($id[0]);//вывод результата добавления
		header("Location: http://localhost/stud/index.php/students");
		return true;
	}

}

