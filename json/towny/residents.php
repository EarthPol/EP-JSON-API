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
			
			//Set Variable for RESIDENT above requests to define as a global variable.
			$resident = null;
			
			//Gets ?name= from URL and sets it to $resident variable, if ?name= is set.
			if (isset($_GET['name'])) {
				$resident = $_GET['name'];

				// Check if parameters have been provided
				$params = array();
				$filter = array();
				if($resident !== 'allresidents') {
					// A resident was provided so ammend the query
					$filter[] = 'name = :name';
					$params[':name'] = $resident;
				}

				// Build the query
				if(empty($filter)) {
					$filter = "";
				} else {
					$filter = "WHERE ".implode(" AND ", $filter);
				}
				$query = strtr($query_residents, array("%WHERE" => $filter));

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
				header('Content-type: application/json');
				echo $error400;
			}
		} else {
			//INVALID KEY, VERIFY KEY IS VALID KEY FROM ADMIN
			http_response_code(401);
			header('Content-type: application/json');
			echo $error401a;
		}
	} else {
		//Let the user know they are not authorized.
		http_response_code(401);
		header('Content-type: application/json');
		echo $error401b;
	}
?>
