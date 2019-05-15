<?php

namespace Models;
include_once "frDeck.php";
include_once "Cards.php";


class frDeck {
    private $players = [];
    private $status = "initial";
    

    //Les 3 parmètres suivants me servent juste à défini mon jeu de carte .
    private $type = array('Clubs', 'Diamonds', 'Hearts', 'Spades');
    private $nbName = array(
    'Ace'=> 11, 
    2 => 2, 
    3 => 3, 
    4 => 4, 
    5 => 5, 
    6 => 6, 
    7 => 7, 
    8 => 8, 
    9 => 9, 
    10 => 10, 
    'Jack' => 10, 
    'Queen'=>10, 
    'King'=>10);

    private $my52cards=[];
        
    function __construct() {
        $this->init();
        $this->shuffleCards();
        

    }

    public function shuffleCards() {
        shuffle($this->my52cards);
         
    }

    public function GetDeck(){
        return $this->my52cards;
    }


    private function init(){
        $arrCards = array();
        foreach($this->type as $Type) {
            foreach ($this->nbName as $name=>$Card) {
                $cheminVersImage = "images/cards/".$name . "_" . "$Type" . ".png";
                $arrCards[] = new Cards($Type, $Card,$name,$cheminVersImage);
            }
        }
        $this->my52cards = $arrCards;
    }

    public function dealCard() {
        return array_pop($this->my52cards);
    }
    public function suppress($array) {
        array_pop($array);
        return $array;
    }
}