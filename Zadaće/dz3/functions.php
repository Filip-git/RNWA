<?php

function get_employees($id = NULL)
{
	global $connection;
	$query = "SELECT LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM employees";
	if(!is_null($id))
	{
		$query .= " WHERE EmployeeID=".$id." LIMIT 1";
	}
	$response = array();
	$result = mysqli_query($connection, $query);
		while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
}

function insert_employee()
	{
		global $connection;

		$data = json_decode(file_get_contents('php://input'), true);
		$employee_first_name = $data["FirstName"];
		$employee_last_name	= $data["LastName"];
		$employee_birth_date = $data["BirthDate"];
		$employee_home_phone = $data["HomePhone"];
		$employee_hire_date = $data["HireDate"];
		$employee_salary = $data["Salary"];
		$employee_address= $data["Address"];
		$employee_reports_to = $data["ReportsTo"];
		
		$query = "INSERT INTO employees (LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo) 
				VALUES ('".$employee_last_name."','".$employee_first_name."','".$employee_birth_date."',
				'".$employee_home_phone."','".$employee_hire_date."','".$employee_salary."',
				'".$employee_address."','".$employee_reports_to."')";
		
		
		if(mysqli_query($connection, $query))
		{
			$broj_redaka = mysqli_affected_rows($connection);
			
			if ($broj_redaka > 0){
				$response=array(
				'status' => 1,
				'query' => $query,
				'broj_redaka' => $broj_redaka,
				'status_message' => 'Employee Added Successfully.'
				);
				
			}
			else {
				$response = array(
				'status' => 0,
				'query' => $query,
				'broj_redaka' => $broj_redaka,
				'status_message' => 'Employee Insert Error.'
				);
				
			}
			
		}
		else
		{

			$response = array(
				'status' => 0,
				'query' => $query,
				'status_message' => 'Employee Addition Error.',
				'sql_error' => mysqli_error($connection)
				
			);
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}
function update_employee($id)
	{
		global $connection;
		$employee_first_name = $data["FirstName"];
		$employee_last_name	= $data["LastName"];
		$employee_birth_date = $data["BirthDate"];
		$employee_home_phone = $data["HomePhone"];
		$employee_hire_date = $data["HireDate"];
		$employee_salary = $data["Salary"];
		$employee_address= $data["Address"];
		$employee_reports_to = $data["ReportsTo"];
		
		$query = "UPDATE employees SET FirstName='".$employee_first_name."', LastName='".$employee_last_name."', BirthDate='".$employee_birth_date."',
										 HomePhone='".$employee_home_phone."', HireDate='".$employee_hire_date."', Salary='".$employee_salary."',
										 Address='".$employee_address."', ReportsTo='".$employee_reports_to."' WHERE EmployeeID=".$id;
		
		$result = mysqli_query($connection, $query);
		$broj_redaka = mysqli_affected_rows($connection);
		
		if($result)
		{
			$response = array(
				'status' => 1,
				'query' => $query,
				'broj_redaka' => $broj_redaka,
				'status_message' =>'Employee Updated Successfully.'
			);
		}
		else
		{
			$response = array(
				'status' => 0,
				'query' => $query,
				'broj_redaka' => $broj_redaka,
				'status_message' => 'Employee Updation Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

function delete_employee($id)
{
	global $connection;
	$query = "DELETE FROM employees WHERE EmployeeID=".$id;
	if($result = mysqli_query($connection, $query))
	{
		$broj_redaka = mysqli_affected_rows($connection);
		//echo $broj_redaka;
		if ($broj_redaka === 1) {
			$response = array(
			'status' => 1,
			'broj_redaka' => $broj_redaka,
			'status_message' => 'Employee Deleted Successfully.'
		);
		}
		else {
			$response = array(
			'status' => 0, //some internal error status
			'broj_redaka' => $broj_redaka,
			'status_message' => 'Employee Deletion Error'
		);
			
		}

	}
	else
	{
		$response = array(
			'status' => 0,
			'status_message' => 'Employee Deletion Failed.'
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}


?>
