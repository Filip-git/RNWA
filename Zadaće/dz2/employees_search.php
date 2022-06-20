<?php
		// get the query parameter from URL into s variable
		if (isset($_REQUEST['s'])) {
			$s = $_REQUEST["s"];
		} else {
			$s='';
		}

		$hint = "";

		// lookup all hints from array if $q is different from "" 
		if ($s !== "") {
			$s = strtolower($s);
			$len=strlen($s);


		//query database
		$db = mysqli_connect("localhost","root","");

		if($db) {

		$result = mysqli_select_db($db, "northwind") or die("Došlo je do problema prilikom odabira baze...");
		$sql="SELECT * FROM employees where FirstName LIKE '%$s%' OR LastName LIKE '%$s%'";
		//echo $sql;
		$result2 = mysqli_query($db, $sql) or die("Došlo je do problema prilikom izvrsavanja upita...");
		$n=mysqli_num_rows($result2);

		if ($n > 0){
			$hint .= '<div>
				<table class="table">
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Title</th>
			
						<th>Birth Date</th>
						<th>Hire Date</th>
						<th>Address</th>
						<th>Salary</th>
						<th></th>
					</tr>';
		
			while ($myrow=mysqli_fetch_row($result2)){
					//echo $myrow[0].",".$myrow[1].",".$myrow[2];
					//$hint .= "<div name=\"result\" id=\"".$myrow[1]."\">".$myrow[0].",".$myrow[1].",</div>";
					$hint .= '
					<tr>
						<td>'.$myrow[0].'</td>
						<td>'.$myrow[1].'</td>
						<td>'.$myrow[2].'</td>
						<td>'.$myrow[3].'</td>
						<td>'.$myrow[5].'</td>
						<td>'.$myrow[6].'</td>
						<td>'.$myrow[7].'</td>
						<td>'.$myrow[18].'</td>
						<td><button class="search-crud-button">Detalji</button>
								<button class="search-crud-button">Uredi</button>
								<button class="search-crud-button">Obrisi</button>
						<br>
						</td>
					</tr>
				';
				}
			}
		else {
		//echo "No patern rows returned<br>";
		}	
		}
		else {
		echo "<br>Nije proslo spajanje<br>";
		}
		/**********************************************************/
			
		}

		// Output "no suggestion" if no hint was found or output correct values 
		echo $hint === "" ? "<p class='no-results'>No results</p>" : $hint;

?>