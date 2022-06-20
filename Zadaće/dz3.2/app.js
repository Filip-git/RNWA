var express = require('express');
var app = express();
var bodyParser = require('body-parser');
var mysql = require('mysql');
var cors = require('cors')
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
	extended: true
}));
app.use(cors(
	{
		origin: '*'
	}
))
// default route
app.get('/', function (req, res) {
	return res.send({ error: true, message: 'hello' })
});
// connection configurations
var dbConn = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: '',
	database: 'northwind'
});
// connect to database
dbConn.connect();

// ==================================================== EMPLOYEE ROUTES ====================================================

// Retrieve all employees 
app.get('/employees', function (req, res) {
	dbConn.query('SELECT EmployeeID, LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM employees',
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'All employees list.' });
		});
});
// Retrieve employee with EmployeeID 
app.get('/employee/:id', function (req, res) {
	let EmployeeID = req.params.id;
	if (!EmployeeID) {
		return res.status(400).send({ error: true, message: 'Please provide EmployeeID' });
	}
	dbConn.query(
		`SELECT EmployeeID, LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM employees WHERE EmployeeID = ?`,
		EmployeeID,
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results[0], message: 'Single employee list.' });
		});
});
//Search employees
app.get('/search/employees', function (req, res) {
	let search = req.query.search

	dbConn.query(
		`SELECT EmployeeID, LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM employees WHERE LOWER(FirstName) LIKE LOWER(?) OR LOWER(LastName) LIKE LOWER(?)`,
		['%' + search + '%', '%' + search + '%'],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Searched employee list.' });
		});
});
// Add a new employee  
app.post('/employee', function (req, res) {
	let employee = req.body.employee;
	let EmployeeID = employee.EmployeeID;
	let FirstName = employee.FirstName;
	let LastName = employee.LastName;
	let BirthDate = employee.BirthDate;
	let HomePhone = employee.HomePhone;
	let HireDate = employee.HireDate;
	let Salary = employee.Salary;
	let Address = employee.Address;
	let ReportsTo = employee.ReportsTo;


	if (!employee) {
		return res.status(400).send({ error: true, message: 'Please provide employee' });
	}
	dbConn.query(
		`INSERT INTO employees 
		(EmployeeID ,FirstName, LastName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo)
		VALUES(?, ?, ?, ?, ?, ?, ?, ?)`,
		[EmployeeID, FirstName, LastName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'New Employee has been created successfully.' });
		});
});
//  Update employee with EmployeeID in body
app.put('/employee', function (req, res) {
	console.log('body :', req.body.employee);
	let employee = req.body.employee;
	let EmployeeID = employee.EmployeeID;
	let FirstName = employee.FirstName;
	let LastName = employee.LastName;
	let BirthDate = employee.BirthDate;
	let HomePhone = employee.HomePhone;
	let HireDate = employee.HireDate;
	let Salary = employee.Salary;
	let Address = employee.Address;
	let ReportsTo = employee.ReportsTo;

	//!variabla vraca true i za vrijednost 0, pa je zamijenjeno sa variabla == null (koje provjeri jeli null ili undefined)
	if (EmployeeID == null || employee == null) {
		return res.status(400).send({ error: employee, message: 'Please provide employee and EmployeeID' });
	}
	dbConn.query(
		`UPDATE employees 
		SET EmployeeID = ?,
		FirstName = ?, 
		LastName = ?, 
		BirthDate = ?, 
		HomePhone = ?, 
		HireDate = ?, 
		Salary = ?, 
		Address = ?, 
		ReportsTo = ? 
		WHERE EmployeeID = ?`,
		[EmployeeID, FirstName, LastName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo, EmployeeID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Employee has been updated successfully.' });
		});
});
//  Update employee with EmployeeID in params
app.put('/employee/:id', function (req, res) {
	let EmployeeID = req.params.id;
	if (EmployeeID == null) {
		return res.status(400).send({ error: employee, message: 'Please provide EmployeeID in url' });
	}

	console.log('body :', req.body.employee);
	let employee = req.body.employee;
	let FirstName = employee.FirstName;
	let LastName = employee.LastName;
	let BirthDate = employee.BirthDate;
	let HomePhone = employee.HomePhone;
	let HireDate = employee.HireDate;
	let Salary = employee.Salary;
	let Address = employee.Address;
	let ReportsTo = employee.ReportsTo;

	if (employee == null) {
		return res.status(400).send({ error: employee, message: 'Please provide employee' });
	}
	dbConn.query(
		`UPDATE employees 
		SET EmployeeID = ?,
		FirstName = ?, 
		LastName = ?, 
		BirthDate = ?, 
		HomePhone = ?, 
		HireDate = ?, 
		Salary = ?, 
		Address = ?, 
		ReportsTo = ?
		WHERE EmployeeID = ?`,
		[EmployeeID, FirstName, LastName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo, EmployeeID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Employee has been updated successfully.' });
		});
});
//  Delete employee
app.delete('/employee/:id', function (req, res) {
	let EmployeeID = req.params.id;
	if (EmployeeID == null) {
		return res.status(400).send({ error: true, message: 'Please provide EmployeeID' });
	}
	dbConn.query(
		`DELETE FROM employees WHERE EmployeeID = ?`,
		[EmployeeID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Employee  has been deleted successfully.' });
		});
});


// set port
app.listen(3001, function () {
	console.log('Node MySQL REST API app is running on port 3001');
});
module.exports = app;