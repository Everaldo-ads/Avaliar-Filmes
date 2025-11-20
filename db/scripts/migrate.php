<?php
    $i=1;
    $migrations_path = "../migrations";
    $full_path = $migrations_path . "/$i.php";
    while (file_exists($full_path)) {
        include_once($full_path);
        $i++;
        $full_path = $migrations_path . "/$i.php";
    }
?>