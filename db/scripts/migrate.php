<?php
    $i=1;
    $migrations_path = "../migrations";
    while (file_exists($full_path = $migrations_path . "/$i.php")) {
        include_once($full_path);
        $i++;
    }
?>