<?php
include_once '../conexao.php';
try {
    $sql = "select * from entrada_saida where id_conta = :id_conta and dt_vencimento between :dt_inicio and :dt_fim";
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
