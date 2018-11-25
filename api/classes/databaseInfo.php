<?php
//File is forbidden to be accessed directly with htaccess
function getDatabaseInformation()
{
    return new PDO('mysql:host=localhost;dbname=jazdectvoprekazdeho;charset=utf8mb4', 'dbconnector', 'N@jHpt%wS59Sw20');
}
?>