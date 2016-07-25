<?php

//print_r(PDO::getAvailableDrivers());
try {
    $handler = new PDO('mysql:host=127.0.0.1;dbname=db_pdo','root','azerty');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    die("Database PDO error");
}

$query = $handler->query('SELECT * FROM guestbook');
/**
//fetch result from query
while($r = $query->fetch()) {
    echo $r['message'], '<br>';
}


$r = $query->fetch(PDO::FETCH_OBJ);
echo '<pre>', print_r($r), '</pre>';


while($r = $query->fetch(PDO::FETCH_OBJ)) {
    echo $r->message, '<br>';
}
 **/

$query -> setFetchMode(PDO::FETCH_CLASS,'GuestbookEntry');
while($r = $query->fetch()) {
    echo '<pre>', print_r($r), '</pre>';
}

class GuestbookEntry {
     public $name, $message, $posted,
            $entry; //id automatisch gecreerd

}