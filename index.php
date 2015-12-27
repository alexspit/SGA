<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24-Dec-15
 * Time: 23:04
 */

include_once "includes/masterpage/header.php"; ?>


<h1>This is my title</h1>


<?php
/*
$element = new Element("h1", 1);

$element->addProperty(new Property(1, "color", ["red", "blue", "green", "black", "white"]));
$element->addProperty(new Property(2, "text-align", ["center", "left", "right", "justified"]));
$element->addProperty(new Property(3, "text-decoration", ["overline", "underline", "line-through"]));
$element->addProperty(new Property(4, "font-family", ["serif", "sans-serif", "monospace"]));
$element->addProperty(new Property(5, "font-style", ["normal", "italic", "oblique"]));
$element->addProperty(new Property(6, "font-weight", ["normal", "lighter", "bold"]));
$element->addProperty(new Property(7, "letter-spacing", ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"]));
$element->addProperty(new Property(7, "background-color", ["red", "blue", "green", "black", "white"]));


$individuals = [new Individual($element), new Individual($element), new Individual($element), new Individual($element), new Individual($element), new Individual($element), new Individual($element)];
*/


    $ga = new GeneticAlgorithm(25, 0.95, 0.01, 3);


    $population = $ga->initPopulation(30);

    $ga->evalPopulation($population);
	
	$generation = 1;

    while($ga->isTerminationConditionMet($population) == false){

        echo "Generation: $generation ";
        echo "Average fitness: ".$population->getPopulationFitness()/$population->size()." ";
        echo "Fittest Individual: ".$population->getFittestIndividual(0)->getFitness()."<br>";

        $population = $ga->crossoverUniform($population, GeneticAlgorithm::TOURNAMENT,5);

	    $population = $ga->mutate($population);

        $ga->evalPopulation($population);

        $generation++;
    }

    echo "Found solution is $generation generations.<br>Best solutions: ".$population->getFittestIndividual(0);

/*
 for($i = 0; $i<20;$i++){

     //echo Random::generate();

    echo Random::generate().PHP_EOL;

     $length = 10;

     $swapPoint1 = rand(1,$length-3);

     $swapPoint2 = rand($swapPoint1+1, $length-2);

     echo $swapPoint1." ".$swapPoint2."<br>";

 }*/

/*
foreach ($individuals as $id => $individual) {
    $id++;
    echo "<h1 id='individual{$id}'>This is a Title</h1>";
}
*/

?>


<p>Test</p>

<?php include_once "includes/masterpage/footer.php "; ?>