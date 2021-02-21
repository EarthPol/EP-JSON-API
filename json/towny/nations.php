<?php
	require('../../config.php');
	//	header('Content-type: application/json');
	
	//Get Key from URL
	if (isset($_GET['key'])) {
		//Set Key to a variable
		$key = $_GET['key'];
		
		//Load (keys.php)
		include('../../keys.php');
		
		//Verify Key exists in Defined Keys (keys.php)
		if(in_array($key, $keys)){
			// KEYS WERE SET AND VALID
			
			//Set Variable for Nation above requests to define as a global variable.
			$nation = null;
			
			//Gets ?name= from URL and sets it to $nation variable, if ?name= is set.
			if (isset($_GET['name'])) {
				$nation = $_GET['name'];

				// Build the query
				$query = $query_nations;
				$params = array();
				if($nation !== 'allnations'){
					// A nation was provided so ammend the query
					$query .= ' WHERE name = :name';
					$params[':name'] = $nation;
				}

				try {
					// Run the query
					$stmt = $pdo->prepare($query);
					$stmt->execute($params);

					// Get the resulting data
					$results = array();
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						$results[$row['name']] = $row;
						unset($results[$row['name']]['name']);
					}
				} catch(PDOException $e) {
					die($e->getMessage());
				}

				// Add in 0x's name
				$results['JSONAPI By 0xBit'] = ':)';

				// Set the header and return the results
				header('Content-type: application/json');
				echo json_encode($results);
			} else {
				//INVALID REQUEST BECAUSE NAME WASN'T DEFINED.
				http_response_code(400);
				echo "<h1>400 - Bad Request</h1><h3>Verify you are using 'name=' in your request URL. </h3>";
			}
		} else {
			//INVALID KEY, VERIFY KEY IS VALID KEY FROM ADMIN
			http_response_code(401);
			echo "<h1>401 - Unauthorized Access</h1><h3>Please use a valid API Key provided to you by the System Administrator</h3>";
		}
	} else {
		//Let the user know they are not authorized.
		http_response_code(401);
		echo "<h1>401 - Unauthorized Access</h1><h3>Verify you are using an API Key in your request URL. </h3>";
	}
?>
