<?php require('../includes/config.php'); 
$nation = null;
if (isset($_GET['name'])) {
    $nation = $_GET['name'];
}

//Designate the COLUMN name, as in some databases, it is full capitals or no capitals. 
$column = 'towny_nations';

//Designate to the GETTER that this is JSON!
header('Content-type: application/json');
		if($nation == null){
			echo '{';
			try {
				$stmt = $tdb->query('SELECT * FROM '.$column.';');
				while($row = $stmt->fetch()){
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
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
			echo '"JSONAPI By 0xBit": {}}';
		} else {
			echo '{';
			try {
				$stmt = $tdb->prepare('SELECT * FROM '.$column.' WHERE name = ?;');
				$stmt->execute(array($nation));
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
		
		
 ?>



