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

?>


<p>Test</p>

<?php include_once "includes/masterpage/footer.php "; ?>