<?php
/**
 * Created by PhpStorm.
 * User: emela
 * Date: 21/04/2018
 * Time: 12:09
 */
require "art.php";
use Klasse\art as Klasse;
require "./vendor/autoload.php";
use TYPO3Fluid\Fluid;

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

//json

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
//aufrufen
//http://localhost/shops/index.php?type=json&material=gummi
//http://localhost/shops/index.php?type=html&material=filz


//fluid

// Initializing the View: rendering in Fluid takes place through a View instance
// which contains a RenderingContext that in turn contains things like definitions
// of template paths, instances of variable containers and similar.
$view = new \TYPO3Fluid\Fluid\View\TemplateView();

// TemplatePaths object: a subclass can be used if custom resolving is wanted.
$paths = $view->getTemplatePaths();

// Assigning the template path and filename to be rendered. Doing this overrides
// resolving normally done by the TemplatePaths and directly renders this file.
$paths->setTemplatePathAndFilename(__DIR__ . '/templates/BallListe.html');

// In this example we assign all our variables in one array. Alternative is
// to repeatedly call $view->assign('name', 'value').
$view->assignMultiple(
    array (
        "Fussballname" => $items[0]->getName(),
        "Fussballmaterial" => $items[0]->getMaterial(),
        "Fussballdurchmesser" => $items[0]->getDurchmesser(),

        "Basketballname" => $items[3]->getName(),
        "Basketballmaterial" => $items[3]->getMaterial(),
        "Basketballdurchmesser" => $items[3]->getDurchmesser(),

        "Tennisname" => $items[5]->getName(),
        "Tennismaterial" => $items[5]->getMaterial(),
        "Tennisdurchmesser" => $items[5]->getDurchmesser()
    )
);

// Rendering the View: plain old rendering of single file, no bells and whistles.
$output = $view->render();

echo $output;





