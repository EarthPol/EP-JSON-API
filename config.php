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

// Are you using TheNewEconomy with Towny? 
// (Requires you give MySQL Read-only user access to TNE Database)
$tne = true;


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
$table_towny_towns = "towny_towns";
$table_towny_townblocks = "towny_townblocks";
$table_towny_nations = "towny_nations";
$table_towny_residents = "towny_residents";
$table_tne_ecoids = "tne_ecoids";
$table_tne_balances = "tne_balances";

// If you modify the querys below, use https://github.com/TownyAdvanced/Towny/blob/master/src/com/palmergames/bukkit/towny/db/SQL_Schema.java for reference
// Make sure you don't put any WHERE statements in the querys as that will break stuff

// Query for getting town data
 $query_towns = '';

if($tne == true){
	$query_towns = "
    SELECT T.name, T.mayor, T.nation, T.assistants, T.townBoard, T.tag, T.open, T.public, T.spawn, T.outpostSpawns, T.outlaws, T.registered, COUNT(".$table_towny_townblocks.".town) AS claimCount
    FROM ".$table_towny_towns." AS T
    LEFT JOIN ".$table_towny_townblocks."
    ON T.name = ".$table_towny_townblocks.".town
    %WHERE
    GROUP BY T.name
	";
} else {

$query_towns = "
    SELECT T.name, T.mayor, T.nation, T.assistants, T.townBoard, T.tag, T.open, T.public, T.spawn, T.outpostSpawns, T.outlaws, T.registered, COUNT(".$table_towny_townblocks.".town) AS claimCount, ".$table_tne_balances.".balance
    FROM ".$table_towny_towns." AS T
    LEFT JOIN ".$table_towny_townblocks."
    ON T.name = ".$table_towny_townblocks.".town
    INNER JOIN ".$table_tne_ecoids."
    ON ".$table_tne_ecoids.".username COLLATE utf8mb4_general_ci = CONCAT('town-', T.name)
    INNER JOIN tne_balances
    ON ".$table_tne_ecoids.".uuid = ".$table_tne_balances.".uuid
    %WHERE
    GROUP BY T.name
";
}


// Query for getting nation data
$query_nations = "
    SELECT name, capital, tag, allies, enemies, registered, nationBoard, mapColorHexCode, nationSpawn, isPublic, isOpen
    FROM ".$table_towny_nations."
    %WHERE
";

// Query for getting resident data
$query_residents = "
    SELECT name, town, 'town-rank', 'nation-ranks', lastOnline, registered, title, surname, friends, uuid
    FROM ".$table_towny_residents."
    %WHERE
";

// READ-ONLY USER MYSQL COMMAND LINE
// GRANT SELECT, SHOW VIEW ON towny.* TO 'towny_readonly'@'localhost' IDENTIFIED BY 'supercalifragilisticexpialidocious';

//Error Responses
$error400 = '{"Unauthorized_Access":"Verify you are using name= in your request URL."}';
$error401a = '{"Unauthorized_Access":"Please use a valid API Key provided to you by the System Administrator"}';
$error401b = '{"Unauthorized_Access":"Verify you are using an API Key in your request URL."}';
?>
