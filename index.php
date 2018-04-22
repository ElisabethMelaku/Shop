<?php
/**
 * Created by PhpStorm.
 * User: emela
 * Date: 21/04/2018
 * Time: 12:09
 */
require "art.php";
use Klasse\art as Klasse;

$items = [
    new Klasse\art("Fussball", 10, "Gummi"),
    new Klasse\art("Fussball", 10, "Gummi"),
    new Klasse\art("Fussball", 14, "Filz"),
    new Klasse\art("Basketball", 10, "Gummi"),
    new Klasse\art("Basketball", 7, "Leder"),
    new Klasse\art("Tennisball", 3, "Gummi"),
    new Klasse\art("Tennisball", 5, "Leder")
];

//im browser type=json&material=gummi
function arrayUmwandeln($array) {
    $ergebnis = [];

    foreach ($array as $ball) {
        //Schau nach, ob material als Parameter gegeben ist
        if (isset($_GET["material"])) { //Material ist als Parameter gegeben, jetzt filtern wir

            //Schau nach, ob das Material übereinstimmt mit dem was im Parameter steht
            if (strcasecmp($ball->getMaterial(), $_GET["material"]) === 0) {
                //Hänge das umgewandelte Objekt an das Ergebnis-Array an
                $ergebnis[] = Objektumwandeln($ball);
            }
        } else { //Material ist als Parameter nicht gegeben, also geben wir alle Bälle aus
            //Hänge das umgewandelte Objekt an das Ergebnis-Array an
            $ergebnis[] = Objektumwandeln($ball);
        }
    }
    return $ergebnis;
}

////json

function Objektumwandeln($ball ){
    $obj = [];
    $obj["name"] = $ball->getName();
    $obj["durchmesser"] = $ball->getDurchmesser();
    $obj["material"] = $ball->getMaterial();

    return $obj;
}

if (isset($_GET["type"]) && $_GET["type"]=="json"){
    header('Content-Type: application/json');
    echo json_encode(arrayUmwandeln($items));
} else {
    header('Content-Type: text/html');
    foreach ($items as $ball) {
        if (isset($_GET["material"])) { //Material ist als Parameter gegeben, jetzt filtern wir

            //Schau nach, ob das Material übereinstimmt mit dem was im Parameter steht
            if (strcasecmp($ball->getMaterial(), $_GET["material"]) === 0) {
                //Hänge das umgewandelte Objekt an das Ergebnis-Array an

                echo $ball;
                echo "<br>";
            }
        } else { //Material ist als Parameter nicht gegeben, also geben wir alle Bälle aus
            //Hänge das umgewandelte Objekt an das Ergebnis-Array an

            echo $ball;
            echo "<br>";
        }
    }
}








//---------------------
//$myBall = new Klasse\art(
//    "Fussball",
//10,
//"Gummi");
//
//$myFussball1 = new Klasse\art(
//    "Fussball",
//    10,
//    "Gummi");
//
//$myFussball2 = new Klasse\art(
//    "Fussball",
//    14,
//    "Filz");
//
//$myBasketball1 = new Klasse\art(
//    "Basketball",
//    10,
//    "Gummi");
//
//$myBasketball2 = new Klasse\art(
//    "Basketball",
//    7,
//    "Leder");
//
//$myTennisball1 = new Klasse\art(
//    "Tennisball",
//    3,
//    "Gummi");
//
//$myTennisball2 = new Klasse\art(
//    "Tennisball",
//    5,
//    "Leder");



//$a = array(
//    Objektumwandeln($myFussball1),
//    Objektumwandeln($myBasketball1),
//    Objektumwandeln($myTennisball1)
//);
