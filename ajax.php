<?php
/**
 * Created by PhpStorm.
 * User: emela
 * Date: 22/04/2018
 * Time: 19:41
 */
require "art.php";
use Klasse\art as Klasse;

include('vendor/autoload.php');
$data = new Klasse\art('Spezialball',30, 'Kautschuk');

echo $data;