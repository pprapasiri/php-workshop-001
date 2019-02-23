<?php

    $host = 'localhost';
    $user = 'admin';
    $pwd = 'admin';
    $dbName = 'webboard';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $pwd);
        // // echo "Connect success !!";

        // $sql   = 'SELECT * from profile_table';
        // $query = $conn->query($sql);
        // $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // print_r($results);

        // foreach($dbh->query('') as $row) {
        //     print_r($row);
        // }
        // $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>