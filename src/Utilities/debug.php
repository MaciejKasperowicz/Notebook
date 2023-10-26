<?php

declare(strict_types = 1);
error_reporting(E_ALL);
ini_set("display_errors", "1");

function deb($data){
    echo "<div style='
    display:inline-block;
    background: lightblue;
    padding: 0px 20px;
    border: 1px solid blue;
    '>
    <pre>";
    print_r($data);
    echo "</pre>
    </div><br><br>";
}
