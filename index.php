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
    $obj["volumen"] = $ball->calculateVolumen();
    return $obj;
}

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


if (isset($_GET["type"]) && $_GET["type"]=="json"){
    header('Content-Type: application/json');
    //als Json umwandeln
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

                $view->assignMultiple(
                    array (
                        //"alle" =>$ball
                        "Fussballname" => $ball->getName(),
                        "Fussballmaterial" => $ball->getMaterial(),
                        "Fussballdurchmesser" => $ball->getDurchmesser(),
                        "Fussballvolumen" => $ball->calculateVolumen()
                    )
                );
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



// In this example we assign all our variables in one array. Alternative is
// to repeatedly call $view->assign('name', 'value').
$view->assignMultiple(
    array (
        "F1n" => $items[0]->getName(),
        "F1m" => $items[0]->getMaterial(),
        "F1d" => $items[0]->getDurchmesser(),
        "F1v" => $items[0]->calculateVolumen(),

        "b1n" => $items[3]->getName(),
        "b1m" => $items[3]->getMaterial(),
        "b1d" => $items[3]->getDurchmesser(),
        "b1v" => $items[3]->calculateVolumen(),

        "T1n" => $items[5]->getName(),
        "T1m" => $items[5]->getMaterial(),
        "T1d" => $items[5]->getDurchmesser(),
        "T1v" => $items[5]->calculateVolumen()
    )
);

// Rendering the View: plain old rendering of single file, no bells and whistles.
$output = $view->render();

echo $output;





