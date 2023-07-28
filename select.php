<?php

$db = new mysqli(
    'localhost',
    'root',
    '',
    'php'
);

$sql = 'SELECT * FROM users';
$result = $db->query($sql);

foreach($result as $row){
    printf(
        '<li><span style="color: %s">%s (%s)</span></li>',
        htmlspecialchars($row['color'], ENT_QUOTES),
        htmlspecialchars($row['name'], ENT_QUOTES), 
        htmlspecialchars($row['gender'], ENT_QUOTES));
}

$db->close();

?>