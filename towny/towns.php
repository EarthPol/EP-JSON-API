<?php require('../includes/config.php'); 

//Define our variables to be used if ?name= is set.
$town = null;
if (isset($_GET['name'])) {
    $town = $_GET['name'];
}

//Designate the COLUMN name, as in some databases, it is full capitals or no capitals. 
$column = 'towny_towns';

//Designate to the GETTER that this is JSON!
header('Content-type: application/json');
	if($town == null){
		echo '{';
		try {
			$stmt = $tdb->query('SELECT * FROM '.$column.';');
			while($row = $stmt->fetch()){
				echo '"'.$row['name'].'": {';
				echo '"mayor": "'.$row['mayor'].'",';
				echo '"nation": "'.$row['nation'].'",';
				echo '"assistants": "'.$row['assistants'].'",';
				echo '"townBoard": "'.$row['townBoard'].'",';
				echo '"tag": "'.$row['tag'].'",';
				echo '"open": "'.$row['open'].'",';
				echo '"public": "'.$row['public'].'",';
				echo '"spawn": "'.$row['spawn'].'",';
				echo '"outpostSpawns": "'.$row['outpostSpawns'].'",';
				echo '"outlaws": "'.$row['outlaws'].'",';
				echo '"registered": "'.$row['registered'].'"';
				echo '},';
			}
		} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		echo '"JSONAPI By 0xBit": {}}';
	} else {
		echo '{';
		try {
			$stmt = $tdb->prepare('SELECT * FROM '.$column.' WHERE name = ?;');
			$stmt->execute(array($town));
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				echo '"'.$row['name'].'": {';
				echo '"mayor": "'.$row['mayor'].'",';
				echo '"nation": "'.$row['nation'].'",';
				echo '"assistants": "'.$row['assistants'].'",';
				echo '"townBoard": "'.$row['townBoard'].'",';
				echo '"tag": "'.$row['tag'].'",';
				echo '"open": "'.$row['open'].'",';
				echo '"public": "'.$row['public'].'",';
				echo '"spawn": "'.$row['spawn'].'",';
				echo '"outpostSpawns": "'.$row['outpostSpawns'].'",';
				echo '"outlaws": "'.$row['outlaws'].'",';
				echo '"registered": "'.$row['registered'].'"';
				echo '}';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		echo '}';
	}
 ?>



