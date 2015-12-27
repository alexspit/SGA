<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26-Dec-15
 * Time: 18:26
 */

class Individual {


    private $chromosome;
    private $fitness = -1;
    private $elementId;
    private $elementName;



    public function __construct($chromosome, Element $element = null)
    {
       if(is_array($chromosome)){

           $this->chromosome = $chromosome;
       }
       else{

           $this->chromosome = new SplFixedArray($chromosome);
           for($gene = 0; $gene < $chromosome; $gene++){
               if(0.5 < Random::generate()){
                   $this->setGene($gene, 1);
               }
               else{
                   $this->setGene($gene, 0);
               }
           }

       }

    }

    public function getChromosome(){

        return $this->chromosome;
    }

    public function getChromosomeLength(){

        return count($this->chromosome);
    }

    public function setGene($locus, $gene){

        $this->chromosome[$locus] = $gene;
    }

    public function getGene($locus){

        return $this->chromosome[$locus];
    }

    /**
     * @return int
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * @param int $fitness
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }


    /**
     * @return mixed
     */
    public function getElementId()
    {
        return $this->elementId;
    }

    /**
     * @param mixed $elementId
     */
    public function setElementId($elementId)
    {
        $this->elementId = $elementId;
    }


    /**
     * @return mixed
     */
    public function getElementName()
    {
        return $this->elementName;
    }

    /**
     * @param mixed $elementName
     */
    public function setElementName($elementName)
    {
        $this->elementName = $elementName;
    }

    public function __toString(){
        $output = "";

        for($gene = 0; $gene< $this->getChromosomeLength(); $gene++){

            $output .= $this->getChromosome()[$gene];
        }

        return $output;
    }





} 