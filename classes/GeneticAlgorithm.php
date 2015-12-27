<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 02:16
 */
//require_once "Population.php";
//require_once "Individual.php";

class GeneticAlgorithm {

    private $populationSize;
    private $mutationRate;
    private $crossoverRate;
    private $elitismCount;

    const ROULETTE = 1;
    const TOURNAMENT = 2;

    function __construct($populationSize, $crossoverRate, $mutationRate, $elitismCount)
    {
        $this->crossoverRate = $crossoverRate;
        $this->elitismCount = $elitismCount;
        $this->mutationRate = $mutationRate;
        $this->populationSize = $populationSize;
    }


    public function initPopulation($chromosomeLength){

        return new Population($this->populationSize, $chromosomeLength);
    }

    public function calcFitness(Individual $individual){

        $correctGenes = 0;

        for($locus = 0; $locus < $individual->getChromosomeLength(); $locus++){

            if($individual->getGene($locus) == 1){

                $correctGenes += 1;
            }
        }

        $fitness = (double) $correctGenes / $individual->getChromosomeLength();

        $individual->setFitness($fitness);

        return $fitness;
    }

    public function evalPopulation(Population $population){

        $populationFitness = 0;


        foreach ($population->getIndividuals() as $individual) {

            $populationFitness += $this->calcFitness($individual);
        }

        $population->setPopulationFitness($populationFitness);

    }

    public function isTerminationConditionMet(Population $population){

        foreach ($population->getIndividuals() as $individual) {

            if($individual->getFitness() == 1){

                return true;
            }
        }

        return false;
    }


    public function selectParentRoulette(Population $population){

        $individuals = $population->getIndividuals();

        $populationFitness = $population->getPopulationFitness();
        $rouletteWheelPosition = (double) Random::generate() * $populationFitness;

        $spinWheel = 0;
        foreach ($individuals as $individual) {
            $spinWheel += $individual->getFitness();

            if($spinWheel >= $rouletteWheelPosition){
                return $individual;
            }
        }

        return $individuals[$population->size() - 1];

    }

    public function selectParentTournament(Population $population, $tournamentSize){

        $tournament = new Population($tournamentSize);

        $population->shuffle();

        for($i = 0; $i<$tournamentSize;$i++){

            $tournamentIndividual = $population->getIndividual($i);
            $tournament->setIndividual($i, $tournamentIndividual);
        }

        return $tournament->getFittestIndividual(0);


    }

    public function crossoverUniform(Population $population, $selectionMethod = 2, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex > $this->elitismCount){
                $offspring = new Individual($parent1->getChromosomeLength());

                if($selectionMethod == 1){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == 2){

                    if($tournamentSize <= $population->size()){

                        $parent2 = $this->selectParentTournament($population, $tournamentSize);
                    }
                    else{
                        throw new Exception("Tournament size larger than populations");
                    }

                }


                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if(0.5 > Random::generate()){
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }

                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                $newPopulation->setIndividual($populationIndex, $parent1);
            }
        }

        return $newPopulation;
    }

    public function mutate(Population $population){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $individual = $population->getFittestIndividual($populationIndex);

            for($geneIndex = 0; $geneIndex < $individual->getChromosomeLength(); $geneIndex++){

                if($populationIndex >= $this->elitismCount){
                    if($this->mutationRate > Random::generate()){

                        $newGene = 1;

                        if($individual->getGene($geneIndex) == 1){
                            $newGene = 0;
                        }

                        $individual->setGene($geneIndex, $newGene);
                    }

                }
            }

            $newPopulation->setIndividual($populationIndex,$individual);

        }

        return $newPopulation;
    }

} 