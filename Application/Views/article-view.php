<?php foreach ($data as $item): ?>

    <h1><?=$item['title']?></h1>
    <p><?=$item['text']?></p>

<?php endforeach;?>

<?php
var_dump($_SERVER);
var_dump($_GET);
var_dump($_ENV);
var_dump($_REQUEST);