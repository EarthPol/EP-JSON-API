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
$table_towns = "towny_towns";
$table_townblocks = "towny_townblocks";
$table_nations = "towny_nations";
$table_residents = "towny_residents";

// If you modify the querys below, use https://github.com/TownyAdvanced/Towny/blob/master/src/com/palmergames/bukkit/towny/db/SQL_Schema.java for reference
// Make sure you don't put any WHERE statements in the querys as that will break stuff

// Query for getting town data
$query_towns = "
    SELECT T.name, T.mayor, T.nation, T.assistants, T.townBoard, T.tag, T.open, T.public, T.spawn, T.outpostSpawns, T.outlaws, T.registered, COUNT(".$table_townblocks.".town)
    FROM ".$table_towns." AS T
    LEFT JOIN ".$table_townblocks."
    ON T.name = ".$table_townblocks.".town
    GROUP BY T.name
";

// Query for getting nation data
$query_nations = "
    SELECT N.name, N.capital, N.tag, N.allies, N.enemies, N.registered, N.nationBoard, N.mapColorHexCode, N.nationSpawn, N.isPublic, N.isOpen,
    FROM ".$table_nations." AS N
";

// Query for getting resident data
$query_residents = "
    SELECT R.name, R.town, R.town-rank, R.nation-ranks, R.lastOnline, R.registered, R.title, R.surname, R.friends, R.uuid
    FROM ".$table_residents." AS R
";

// READ-ONLY USER MYSQL COMMAND LINE
// GRANT SELECT, SHOW VIEW ON towny.* TO 'towny_readonly'@’localhost′ IDENTIFIED BY ‘supercalifragilisticexpialidocious‘;
?>
