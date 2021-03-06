<?php
require_once('databaseInfo.php');

function getData($sql, $conditions = null)
{
    $link = getDatabaseInformation();
    $output = array();
    try{
        $query = $link->prepare($sql);
        if ($query->execute($conditions))
        {
            while ($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $output[] = $row;
            }
            return $output;
        }
    }
    catch (PDOException $e){
        echo $e;
    }
    finally{
        $link = null;
    }
}

function insertData($sql, $values = null)
{
    $link = getDatabaseInformation();
    try{
        $data_to_insert = $link->prepare($sql);
        foreach($values as $item => $value)
        {
            $data_to_insert->bindValue(':'.$item, $value,PDO::PARAM_STR);
        }
        $data_to_insert->execute();
        
        if ($data_to_insert->errorInfo()[1] == 1062) { //error code duplicate
            return 'false';
        }
        else if ($link->lastInsertId() > 0){
            return $link->lastInsertId();
        }
        else{
            return $data_to_insert->rowCount(); 
        }
    }
    catch (PDOException $e){
        echo $e;
    }
    finally{
        $link = null;
    }
}

?>
