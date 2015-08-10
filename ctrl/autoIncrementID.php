<?php
include './DBCon.php';
$table = $_SESSION['table'];

$query = "SELECT * FROM $table ORDER BY id DESC LIMIT 1;";

if ($query_run = mysql_query($query)) {
    if (mysql_num_rows($query_run) != NULL) {
        while ($row = mysql_fetch_assoc($query_run)) {
            $id = $row["id"] + 1;
        }
    }
}

if (isset($id)) {
    $_SESSION['id'] = $id;
}else{
    $_SESSION['id'] = 1;
}
?>