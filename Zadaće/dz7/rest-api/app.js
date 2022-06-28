require('dotenv').config();
const {
	DB_HOST,
	DB_USERNAME,
	DB_PASSWORD,
	DB_DATABASE,
	AUTH_USER,
	AUTH_PASSWORD
} = process.env;
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
	host: DB_HOST,
	user: DB_USERNAME,
	password: DB_PASSWORD,
	database: DB_DATABASE
});
// connect to database
dbConn.connect();



// ==================================================== AUTH ===============================================================

app.post('/*', function (req, res, next) {
	console.log(req.headers)
	if (!req.headers.authorization || req.headers.authorization.indexOf('Basic ') === -1) {
		return res.status(401).json({ message: 'Missing Authorization Header' });
	}

	// verify auth credentials
	const base64Credentials = req.headers.authorization.split(' ')[1];
	console.log(base64Credentials)
	const credentials = Buffer.from(base64Credentials, 'base64').toString('ascii');
	const [username, password] = credentials.split(':');
	console.log(username, password)
	if (username !== AUTH_USER || password !== AUTH_PASSWORD) {
		return res.status(401).json({ message: 'Invalid Authentication Credentials' });
	}

	next();
})
app.put('/*', function (req, res, next) {
	if (!req.headers.authorization || req.headers.authorization.indexOf('Basic ') === -1) {
		return res.status(401).json({ message: 'Missing Authorization Header' });
	}

	// verify auth credentials
	const base64Credentials = req.headers.authorization.split(' ')[1];
	const credentials = Buffer.from(base64Credentials, 'base64').toString('ascii');
	const [username, password] = credentials.split(':');
	if (username !== AUTH_USER || password !== AUTH_PASSWORD) {
		return res.status(401).json({ message: 'Invalid Authentication Credentials' });
	}

	next();
})
app.delete('/*', function (req, res, next) {
	if (!req.headers.authorization || req.headers.authorization.indexOf('Basic ') === -1) {
		return res.status(401).json({ message: 'Missing Authorization Header' });
	}

	// verify auth credentials
	const base64Credentials = req.headers.authorization.split(' ')[1];
	const credentials = Buffer.from(base64Credentials, 'base64').toString('ascii');
	const [username, password] = credentials.split(':');
	if (username !== AUTH_USER || password !== AUTH_PASSWORD) {
		return res.status(401).json({ message: 'Invalid Authentication Credentials' });
	}

	next();
})

// ==================================================== EMPLOYEE ROUTES ====================================================

// Retrieve all Employees 
app.get('/Employees', function (req, res) {
	dbConn.query('SELECT EmployeeID, LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM Employees',
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'All Employees list.' });
		});
});
// Retrieve Employee with EmployeeID 
app.get('/Employee/:id', function (req, res) {
	let EmployeeID = req.params.id;
	if (!EmployeeID) {
		return res.status(400).send({ error: true, message: 'Please provide EmployeeID' });
	}
	dbConn.query(
		`SELECT EmployeeID, LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM Employees WHERE EmployeeID = ?`,
		EmployeeID,
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results[0], message: 'Single Employee list.' });
		});
});
//Search Employees
app.get('/search/Employees', function (req, res) {
	let search = req.query.search

	dbConn.query(
		`SELECT EmployeeID, LastName, FirstName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo FROM Employees WHERE LOWER(FirstName) LIKE LOWER(?) OR LOWER(LastName) LIKE LOWER(?)`,
		['%' + search + '%', '%' + search + '%'],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Searched Employee list.' });
		});
});
// Add a new Employee  
app.post('/Employee', function (req, res) {
	let Employee = req.body.Employee;
	let FirstName = Employee.FirstName;
	let LastName = Employee.LastName;
	let BirthDate = Employee.BirthDate;
	let HomePhone = Employee.HomePhone;
	let HireDate = Employee.HireDate;
	let Salary = Employee.Salary;
	let Address = Employee.Address;
	let ReportsTo = Employee.ReportsTo;


	if (!Employee) {
		return res.status(400).send({ error: true, message: 'Please provide Employee' });
	}
	dbConn.query(
		`INSERT INTO Employees 
		(FirstName, LastName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo)
		VALUES(?, ?, ?, ?, ?, ?, ?, ?)`,
		[FirstName, LastName, BirthDate, HomePhone, HireDate, Salary, Address, ReportsTo],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'New Employee has been created successfully.' });
		});
});
//  Update Employee with EmployeeID in body
app.put('/Employee', function (req, res) {
	console.log('body :', req.body.Employee);
	let Employee = req.body.Employee;
	let EmployeeID = Employee.EmployeeID;
	let FirstName = Employee.FirstName;
	let LastName = Employee.LastName;
	let BirthDate = Employee.BirthDate;
	let HomePhone = Employee.HomePhone;
	let HireDate = Employee.HireDate;
	let Salary = Employee.Salary;
	let Address = Employee.Address;
	let ReportsTo = Employee.ReportsTo;

	//!variabla vraca true i za vrijednost 0, pa je zamijenjeno sa variabla == null (koje provjeri jeli null ili undefined)
	if (EmployeeID == null || Employee == null) {
		return res.status(400).send({ error: Employee, message: 'Please provide Employee and EmployeeID' });
	}
	dbConn.query(
		`UPDATE Employees 
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
//  Update Employee with EmployeeID in params
app.put('/Employee/:id', function (req, res) {
	let EmployeeID = req.params.id;
	if (EmployeeID == null) {
		return res.status(400).send({ error: Employee, message: 'Please provide EmployeeID in url' });
	}

	console.log('body :', req.body.Employee);
	let Employee = req.body.Employee;
	let FirstName = Employee.FirstName;
	let LastName = Employee.LastName;
	let BirthDate = Employee.BirthDate;
	let HomePhone = Employee.HomePhone;
	let HireDate = Employee.HireDate;
	let Salary = Employee.Salary;
	let Address = Employee.Address;
	let ReportsTo = Employee.ReportsTo;

	if (Employee == null) {
		return res.status(400).send({ error: Employee, message: 'Please provide Employee' });
	}
	dbConn.query(
		`UPDATE Employees 
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
//  Delete Employee
app.delete('/Employee/:id', function (req, res) {
	let EmployeeID = req.params.id;
	if (EmployeeID == null) {
		return res.status(400).send({ error: true, message: 'Please provide EmployeeID' });
	}
	dbConn.query(
		`DELETE FROM Employees WHERE EmployeeID = ?`,
		[EmployeeID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Employee  has been deleted successfully.' });
		});
});

// ==================================================== REGION ROUTES ====================================================

// Retrieve all Regions
app.get('/Regions', function (req, res) {
	dbConn.query('SELECT * FROM Region',
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'All Regions list.' });
		});
});
// Retrieve Region with RegionID 
app.get('/Region/:id', function (req, res) {
	let RegionID = req.params.id;
	if (!RegionID) {
		return res.status(400).send({ error: true, message: 'Please provide RegionID' });
	}
	dbConn.query(
		`SELECT * FROM Region WHERE RegionID = ?`,
		RegionID,
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results[0], message: 'Single Region list.' });
		});
});
//Search Region
app.get('/search/Regions', function (req, res) {
	let search = req.query.search

	dbConn.query(
		`SELECT * FROM Region WHERE LOWER(RegionDescription) LIKE LOWER(?)`,
		['%' + search + '%'],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Searched Region list.' });
		});
});
// Add a new Region  
app.post('/Region', function (req, res) {
	let Region = req.body.Region;
	let RegionID = Region.RegionID;
	let RegionDescription = Region.RegionDescription;

	if (!Region) {
		return res.status(400).send({ error: true, message: 'Please provide Region' });
	}
	dbConn.query(
		`INSERT INTO Region 
		(RegionID, RegionDescription)
		VALUES(?, ?)`,
		[RegionID, RegionDescription],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'New Department has been created successfully.' });
		});
});
//  Update Region with RegionID in body
app.put('/Region', function (req, res) {
	console.log('body :', req.body.Region);
	let Region = req.body.Region;
	let RegionID = Region.RegionID;
	let RegionDescription = Region.RegionDescription;

	if (RegionID == null || Region == null) {
		return res.status(400).send({ error: Region, message: 'Please provide Region and RegionID' });
	}
	dbConn.query(
		`UPDATE Region 
		SET RegionDescription = ?, 
		WHERE RegionID = ?`,
		[RegionDescription, RegionID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Region has been updated successfully.' });
		});
});
//  Update Region with RegionID in params
app.put('/Region/:id', function (req, res) {
	let RegionID = req.params.id;
	if (RegionID == null) {
		return res.status(400).send({ error: Region, message: 'Please provide RegionID in url' });
	}

	console.log('body :', req.body.Region);
	let Region = req.body.Region;
	let RegionDescription = Region.RegionDescription;


	if (Region == null) {
		return res.status(400).send({ error: Region, message: 'Please provide Region' });
	}
	dbConn.query(
		`UPDATE Region 
		SET RegionDescription = ?
		WHERE RegionID = ?`,
		[RegionDescription, RegionID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Department has been updated successfully.' });
		});
});
//  Delete Region
app.delete('/Region/:id', function (req, res) {
	let RegionID = req.params.id;
	if (RegionID == null) {
		return res.status(400).send({ error: true, message: 'Please provide RegionID' });
	}
	dbConn.query(
		`DELETE FROM Region WHERE RegionID = ?`,
		[RegionID],
		function (error, results, fields) {
			if (error) throw error;
			return res.send({ error: false, data: results, message: 'Region  has been deleted successfully.' });
		});
});


// set port
app.listen(3001, function () {
	console.log('Node MySQL REST API app is running on port 3001');
});
module.exports = app;