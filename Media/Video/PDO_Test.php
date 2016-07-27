<?php

//print_r(PDO::getAvailableDrivers());
try {
    $handler = new PDO('mysql:host=127.0.0.1;dbname=db_pdo','root','azerty');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    die("Database PDO error");
}
/**
$query = $handler->query('SELECT * FROM guestbook');

//fetch result from query
while($r = $query->fetch()) {
    echo $r['message'], '<br>';
}


$r = $query->fetch(PDO::FETCH_OBJ);
echo '<pre>', print_r($r), '</pre>';


while($r = $query->fetch(PDO::FETCH_OBJ)) {
    echo $r->message, '<br>';
}


$query -> setFetchMode(PDO::FETCH_CLASS,'GuestbookEntry');
while($r = $query->fetch()) {
    echo '<pre>', print_r($r), '</pre>';
}

class GuestbookEntry {
     public $name, $message, $posted,
            $entry; //id automatisch gecreerd

}

//fetch all
$results = $query->fetchAll(PDO::FETCH_ASSOC);

if(count($results)) {
    echo "There are results";
} else {
    echo "there are no results";
}

//prepared statements
$name = 'Joshua';
$message = 'Test';

$sql = "INSERT INTO guestbook (name,message,posted) VALUES (:name,:message, NOW())";
//$handler->query($sql);
$query = $handler->prepare($sql);

$query->execute(array(
    ":name" => $name,
    ":message" => $message
));

echo $handler->lastInsertId();
 * **/

if($query->rowCount()) {
    while($r = $query->fetch(PDO::FETCH_OBJ)) {
        echo $r->message,  "<br>";
    }
} else {
    echo "no results";
}