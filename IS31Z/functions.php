<?php

function dbConnect($host = '', $username = '', $password = '', $dbName = ''){
    global $APP;
    if(empty($host))
        $host = $APP['database']['host'];
    $username = $username ?: $APP['database']['username'];
    $password = $password ?: $APP['database']['password'];
    $dbName = $dbName ?: $APP['database']['name'];
    $connection  = mysqli_connect($host, $username, $password, $dbName);
    if(!$connection)
        die('Database error');
    $APP['connections']['default'] = $connection;
    return $connection;
}


function dbSelect($query){
    global $APP;
    $result = mysqli_query($APP['connections']['default'], $query);
    $list = [];
    while($row = mysqli_fetch_assoc($result)){
        $list[] = $row;
    }
    return $list;
}