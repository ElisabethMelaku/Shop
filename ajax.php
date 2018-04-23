<?php
/**
 * Created by PhpStorm.
 * User: emela
 * Date: 22/04/2018
 * Time: 19:41
 */
include('vendor/autoload.php');
require "art.php";
use Klasse\art as Klasse;

$data = new Klasse\art('Spezialball',5, 'Wolle');

$items = [
    new Klasse\art("Fussball", 10, "Gummi"),
    new Klasse\art("Fussball", 10, "Gummi"),
    new Klasse\art("Fussball", 14, "Filz"),
    new Klasse\art("Basketball", 10, "Gummi"),
    new Klasse\art("Basketball", 7, "Leder"),
    new Klasse\art("Tennisball", 3, "Gummi"),
    new Klasse\art("Tennisball", 5, "Leder")
];

for ($i = 4; $i <= count($items)-1; $i++) {
    echo "\n";
    echo $i;
    echo "\n";
    //echo $data;
    echo $items[$i];
}

