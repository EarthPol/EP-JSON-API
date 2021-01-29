<?php require('../includes/config.php'); 

//Define our variables to be used if ?name= is set.
$resident = null;
if (isset($_GET['name'])) {
    $resident = $_GET['name'];
}

//Designate the COLUMN name, as in some databases, it is full capitals or no capitals. 
$column = 'towny_residents';

//Designate to the GETTER that this is JSON!
header('Content-type: application/json');

		if($resident == null){
			echo '{';
			try {
				$stmt = $tdb->query('SELECT * FROM '.$column.';');
				while($row = $stmt->fetch()){
					echo '"'.$row['name'].'": {';
					echo '"town": "'.$row['town'].'",';
					echo '"town-rank": "'.$row['town-ranks'].'",';
					echo '"nation-ranks": "'.$row['nation-ranks'].'",';
					echo '"lastOnline": "'.$row['lastOnline'].'",';
					echo '"registered": "'.$row['registered'].'",';
					echo '"title": "'.$row['title'].'",';
					echo '"surname": "'.$row['surname'].'",';
					echo '"friends": "'.$row['friends'].'",';
					echo '"uuid": "'.$row['uuid'].'"';
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
				$stmt->execute(array($resident));
				$stmt = $tdb->query('SELECT * FROM '.$column.' WHERE name = "'.$resident.'";');
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					echo '"'.$row['name'].'": {';
					echo '"town": "'.$row['town'].'",';
					echo '"town-rank": "'.$row['town-ranks'].'",';
					echo '"nation-ranks": "'.$row['nation-ranks'].'",';
					echo '"lastOnline": "'.$row['lastOnline'].'",';
					echo '"registered": "'.$row['registered'].'",';
					echo '"title": "'.$row['title'].'",';
					echo '"surname": "'.$row['surname'].'",';
					echo '"friends": "'.$row['friends'].'",';
					echo '"uuid": "'.$row['uuid'].'"';
					echo '}';
				}
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
			echo '}';
		}
		
		
 ?>



