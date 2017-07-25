<?php
include_once './fluxo_caixa_sql.php';
try {
    $user = "cashflow";
    $pass = "cashflow";
    $dbh = new PDO('mysql:host=localhost;dbname=cashflow', $user, $pass);
    $resultSet = array();
    foreach ($dbh->query($sql, PDO::FETCH_ASSOC) as $row){
        $resultSet[] = $row;
    }
    $dbh = null;
    echo json_encode($resultSet);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>