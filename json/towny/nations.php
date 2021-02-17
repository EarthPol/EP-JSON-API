<?php
	require('../../config.php');
	//	header('Content-type: application/json');
	
	//Get Key from URL
	if (isset($_GET['key'])) {
		//Set Key to a variable
		$key = $_GET['key'];
		
		//Load (keys.php)
		include('../keys.php');
		
		//Verify Key exists in Defined Keys (keys.php)
		if(in_array($key, $keys)){
			// KEYS WERE SET AND VALID
			
			//Set Variable for Nation above requests to define as a global variable.
			$nation = null;
			
			//Gets ?name= from URL and sets it to $nation variable, if ?name= is set.
			if (isset($_GET['name'])) {
				
				$nation = $_GET['name'];
				header('Content-type: application/json');
				if($nation == "allnations"){
					//Returns results for ALL NATIONS!
						echo '{';
							try {
								// Selects all nations and gets the results
									$stm = $pdo->query("SELECT * FROM `".$column_nations."`");
									while($row = $stm->fetch(PDO::FETCH_ASSOC)){
										echo '"'.$row['name'].'": {';
										echo '"capital": "'.$row['capital'].'",';
										echo '"tag": "'.$row['tag'].'",';
										echo '"allies": "'.$row['allies'].'",';
										echo '"enemies": "'.$row['enemies'].'",';
										echo '"registered": "'.$row['registered'].'",';
										echo '"nationBoard": "'.$row['nationBoard'].'",';
										echo '"mapColorHexCode": "'.$row['mapColorHexCode'].'",';
										echo '"nationSpawn": "'.$row['nationSpawn'].'",';
										echo '"isPublic": "'.$row['isPublic'].'",';
										echo '"isOpen": "'.$row['isOpen'].'"';
										echo '},';
									}
								}
							 catch(PDOException $e){
								echo $e->getMessage();
							}
						echo '"JSONAPI By 0xBit": {}}';
				} else {
					echo '{';
					try {
							$stm = $pdo->prepare("SELECT * FROM `".$column_nations."` WHERE name = ?");
							$stm->bindValue(1,$nation);
							$stm->execute();
							while($row = $stm->fetch(PDO::FETCH_ASSOC)){
								echo '"'.$row['name'].'": {';
								echo '"capital": "'.$row['capital'].'",';
								echo '"tag": "'.$row['tag'].'",';
								echo '"allies": "'.$row['allies'].'",';
								echo '"enemies": "'.$row['enemies'].'",';
								echo '"registered": "'.$row['registered'].'",';
								echo '"nationBoard": "'.$row['nationBoard'].'",';
								echo '"mapColorHexCode": "'.$row['mapColorHexCode'].'",';
								echo '"nationSpawn": "'.$row['nationSpawn'].'",';
								echo '"isPublic": "'.$row['isPublic'].'",';
								echo '"isOpen": "'.$row['isOpen'].'"';
								echo '}';
							}
						} catch(PDOException $e) {
							echo $e->getMessage();
						}
					echo '}';
				}
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