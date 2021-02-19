<?php
// CONFIGURATION FILE (Written by 0xBit#1312, Developer of EarthPol MC)
//==========================================================================================================
// Please ensure that you set these configurations up following the installation guide.
// Misconfiguration can lead to SQL Injection vulnerabilities that may compromise your 
// MYSQL's databse. Only setup this API with a READ-ONLY User Account.
//======================================================================================

// Determine if API Keys are enable.
// True = Requires key to submit a query.
// False = No keys required to submit a query. (Not recommended)
// Keys can be found in "keys.php" and are set to default keys.
$apiKeys = true;


// CONNECTION SETTINGS
$host = "localhost";
$port = 3306;
$database = "towny";
$username = "towny_readonly";
$password = "supercalifragilisticexpialidocious";
//Read the Installation Guide on how to create a READ-ONLY user account for MYSQL Towny!

//Do not edit unless you need to add additional flags.
$dsn = "mysql:host=${host};port=${port};dbname=${database}";

//Establishes PDO Connection to MySQL Database
$pdo = new PDO($dsn, $username, $password);



// For Windows based MySQL servers, typically all database are lower case.
// For UNIX based MySQL servers, typically all databases are capitalized unless specified to not be.
// You will need to capitalize these if it fails to find your database.
$column_towns = "towny_towns";
$column_nations = "towny_nations";
$column_residents = "towny_residents";


// The columns to be returned to the user for each endpoint
$rows_towns = array('name', 'mayor', 'nation', 'assistants', 'townBoard', 'tag', 'open', 'public', 'spawn', 'outpostSpawns', 'outlaws', 'registered');
$rows_nations = array('name', 'capital', 'tag', 'allies', 'enemies', 'registered', 'nationBoard', 'mapColorHexCode', 'nationSpawn', 'isPublic', 'isOpen');
$rows_residents = array('name', 'town', 'town-rank', 'nation-ranks', 'lastOnline', 'registered', 'title', 'surname', 'friends', 'uuid');

// READ-ONLY USER MYSQL COMMAND LINE
// GRANT SELECT, SHOW VIEW ON towny.* TO 'towny_readonly'@’localhost′ IDENTIFIED BY ‘supercalifragilisticexpialidocious‘;
?>
