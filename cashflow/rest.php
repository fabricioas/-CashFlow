<?php
try {
    $user = "cashflow";
    $pass = "cashflow";
    $dbh = new PDO('mysql:host=localhost;dbname=cashflow', $user, $pass);
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $tableName = null;
            $criteria = null;
            if (array_key_exists("table", $_GET)) {
                $tableName = $_GET["table"];
            }
            if (array_key_exists("criteria", $_GET)) {
                $criteria = $_GET["criteria"];
            }
            if ($tableName) {
                $sql = "SELECT * FROM " . $tableName;
                if ($criteria != null) {
                    $sql = $sql . " WHERE " . $criteria;
                }
                $resultSet = array();
                foreach ($dbh->query($sql, PDO::FETCH_ASSOC) as $row) {
                    $resultSet[] = $row;
                }
                echo json_encode($resultSet);
            }
            break;
        case 'POST':
            $json = file_get_contents("php://input");
            if ($json) {
                $obj = json_decode($json);
                $tableName = $obj->table;
                $criteria = $obj->criteria;
                $data = $obj->data;
                $campos = "";
                foreach ($data as $key => $value) {
                    $campos = $campos . $key . " = :" . $key . " ,";
                }
                $campos = substr($campos, 0, strlen($campos) - 1);
                $update = "UPDATE " . $tableName . " SET " . $campos . " WHERE " . $criteria;
                $parametros = array();
                foreach ($obj->data as $key => $value) {
                    $parametros[$key] = $value;
                }
                $sth = $dbh->prepare($update, array(
                    PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
                ));
                $sth->execute($parametros);
                echo "Updated!";
            }
            break;
        case 'PUT':
            $json = file_get_contents("php://input");
            if ($json) {
                $obj = json_decode($json);
                $tableName = $obj->table;
                $id = "id_". $tableName;
                $sequence = 0;
                $sqlMaxId = "SELECT max(". $id .") as id FROM ".$tableName;
                $maxId = 0;
                foreach ($dbh->query($sqlMaxId , PDO::FETCH_ASSOC) as $row ) {
                    $maxId  = $row["id"];
                }

                $campos = $id;
                $values = ":" . $id;
                
                foreach ($obj->data as $key => $value) {
                    $campos = $campos . " ," . $key;
                    $values = $values . ", :". $key;
                }
                $insert = "INSERT INTO " . $tableName . "(" . $campos . ") VALUES ( " . $values . ")";
                $parametros = array();
                print_r($maxId);
                $parametros[$id] = $maxId + 1;
                foreach ($obj->data as $key => $value) {
                    $parametros[$key] = $value;
                }
                $sth = $dbh->prepare($insert, array(
                    PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
                ));
                $sth->execute($parametros);
                echo "Insert Realizado!";
            }
            break;
        case 'DELETE':
            $tableName = null;
            $criteria = null;
            if (array_key_exists("table", $_GET)) {
                $tableName = $_GET["table"];
            }
            if (array_key_exists("criteria", $_GET)) {
                $criteria = $_GET["criteria"];
            }
            if ($tableName && $criteria) {
                $delete = "DELETE FROM " . $tableName . " WHERE " . $criteria;
                $count = $dbh->exec($delete);
                echo json_encode(array(
                    "count" => $count
                ));
            }
            break;
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>