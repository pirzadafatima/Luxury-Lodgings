<?php

$serverName = "DESKTOP-8ORBQRL\SQLEXPRESS";
$database = "luxuryLodgings";
$uid = "";   //userId
$pass = "";  //password 

$connection = [

    "Database" => $database,
    "UID" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName,$connection);

if(!$conn)
{
    die(print_r(sqlsrv_errors(),true));
}
else
{
    echo 'Connection Established';
}

// $tsql = "select * from Rooms";
// $stmt = sqlsrv_query($conn, $tsql);

// if($stmt == false)
// {
//     echo 'Error';
// }

// while($obj = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
//     echo $obj['Room_ID'].'</br>';
// }

// sqlsrv_free_stmt($stmt);
// sqlsrv_close($conn);

?>