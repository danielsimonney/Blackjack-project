<?php
namespace Models;

include_once "frDeck.php";
include_once "Cards.php";

class player {
    
    public $name;
    public $status;
    public $cards;
    public $ArgentJoueur;
    public $MiseJoueur;
    
    
    
    public function __construct($name,$argent=100){
        $this->name=$name;
        $this->status="undefined";
        $this->cards=[];
        $this->ArgentJoueur=$argent;
        $this->MiseJoueur=0;
        
    }
    public function verifyBet($bet){
        $verify=true;
        if($bet>$this->ArgentJoueur){
            $verify= false;
        }
        if($bet==0){
            $verify= false;
        }
        if($verify==true){
            $this->MiseJoueur=$bet;
            return $verify;
            
            
            
        }
    }
    
    public function pioche($deck){
        array_push($this->mamain,$deck->dealcard());
    }
   

    public function writeCards(){
        $arrayCards=[];
        foreach ($this->getCard() as  $value) {
            array_push($arrayCards,$value->getCard());
        }
        return $arrayCards;
    }
    
    public function addCard($macarte){
        array_push($this->cards,$macarte);
    }
    
    public function getCard(){
        return $this->cards;
    }
    public function getname(){
        return $this->name;
    }
    
    public function GetTheAs(){
        $i=0;
        foreach ($this->getCard() as $key => $value) {
            if ($value->getName()=="Ace"){
                $i+=1;
            }
        }
        
        return $i;
    }
    public function GetSum(){
        $sum=0;
        foreach ($this->getCard() as $key => $value) {
            $sum+=$value->getNum();
        }
        
        if($sum>21){
            
            if($this->GetTheAs()>0){
                $myAs=$this->GetTheAs();
                while($sum>=21 || $myAs!=0 ){
                    $sum=$sum-10;
                    $myAs=$myAs-1;
                    if($myAs==0){
                        return $sum;
                    }
                }   
            }
        }
        
        return $sum;
    }
    
    
    public function getSrc(){
        $tabl=[];
        foreach($this->cards as $value){
            
            array_push($tabl,$value->getSrc());
            
        }
        return $tabl;
    }
    
    public function showFirstCard(){
        return $this->cards[0]->getSrc();
    }

    public function firstCardValue(){
        return $this->cards[0]->getCard();
    }
    
    
    public function setStatus($status){
        $this->status=$status;
        
    }
    public function getStatus(){
        return $this->status;
    }
    public function result(){
        $res=$this->getStatus();
        if($res=="WinBy21"){
            return $this->getname()." a eu 21 points grâce à ses cartes ".$this->getname()." avait ".$this->GetSum()." points";
        }elseif($res=="lose"){
            return $this->getname()." a été trop gourmand et a tout perdu!! ".$this->getname()." avait ".$this->GetSum()." points";
        }elseif($res=="egaliteParPerdu"){
            return $this->getname()." a été trop gourmand mais le croupier aussi: égalité!! ".$this->getname()." avait ".$this->GetSum()." points";
        }elseif($res=="winByCroupierDefeat"){
            return $this->getname()." a gagné car le croupier a perdu en ayant plus de 21 points!!".$this->getname()." avait ".$this->GetSum()." points";
            
        }elseif($res=="loseByCroupierWin"){
            return $this->getname()." a perdu car le croupier a eu 21 points quel chanceux!!".$this->getname()." avait ".$this->GetSum()." points";
            
        }elseif($res=="winByHand"){
            return $this->getname()." a eu plus de points que le croupier!!".$this->getname()." avait ".$this->GetSum()." points";
            
        }elseif($res=="LoseByHand"){
            return $this->getname()." a eu moins de points que le croupier!!".$this->getname()." avait ".$this->GetSum()." points";
        }elseif($res=="EqualityByHand"){
            return $this->getname()." a eu autant de points que le croupier dans sa main".$this->getname()." avait ".$this->GetSum()." points";
        }
    }
    public function resolveBet(){
        $res=$this->getStatus();
        if($res=="WinBy21"){
            $this->ArgentJoueur=$this->ArgentJoueur+$this->MiseJoueur;
            
        }elseif($res=="lose"){
            $this->ArgentJoueur=$this->ArgentJoueur-$this->MiseJoueur;
        }elseif($res=="egaliteParPerdu"){
            
            $this->ArgentJoueur=$this->ArgentJoueur;
        }elseif($res=="winByCroupierDefeat"){
            
            $this->ArgentJoueur=$this->ArgentJoueur+$this->MiseJoueur;
            
        }elseif($res=="loseByCroupierWin"){
            
            
            $this->ArgentJoueur=$this->ArgentJoueur-$this->MiseJoueur;
            
        }elseif($res=="winByHand"){
            
            
            $this->ArgentJoueur=$this->ArgentJoueur+$this->MiseJoueur;
            
        }elseif($res=="LoseByHand"){
            
            $this->ArgentJoueur=$this->ArgentJoueur-$this->MiseJoueur;
        }elseif($res=="EqualityByHand"){
            
        }
        
    }
    
    public function printBet(){
        
        $res=$this->getStatus();
        if($res=="WinBy21"){
            return $this->name." avait ".(string)($this->ArgentJoueur-$this->MiseJoueur)."€ ,il a misé ".(string)$this->MiseJoueur."€ et a gagné, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
            
        }elseif($res=="lose"){
            return $this->name." avait ".(string)($this->ArgentJoueur+$this->MiseJoueur)."€ ,il a misé ".(string)$this->MiseJoueur."€ et a perdu, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
        }elseif($res=="egaliteParPerdu"){
            return $this->name." avait ".(string)$this->ArgentJoueur."€ ,il a misé ".(string)$this->MiseJoueur."€ et a eu égalité, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
            
        }elseif($res=="winByCroupierDefeat"){
            return $this->name." avait ".(string)($this->ArgentJoueur-$this->MiseJoueur)."€ ,il a misé ".(string)$this->MiseJoueur."€ et a gagné, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
            
        }elseif($res=="loseByCroupierWin"){
            return $this->name." avait ".(string)($this->ArgentJoueur+$this->MiseJoueur)."€ ,il a misé ".(string)$this->MiseJoueur."€ et a perdu, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
        
        }elseif($res=="winByHand"){
            return $this->name." avait ".(string)($this->ArgentJoueur-$this->MiseJoueur)."€ ,il a misé ".(string)$this->MiseJoueur."€ et a gagné, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
                      
        }elseif($res=="LoseByHand"){
            return $this->name." avait ".(string)($this->ArgentJoueur+$this->MiseJoueur)."€ ,il a misé ".(string)$this->MiseJoueur."€ et a perdu, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
            
        }elseif($res=="EqualityByHand"){
            return $this->name." avait ".(string)$this->ArgentJoueur."€ ,il a misé ".(string)$this->MiseJoueur."€ et a eu égalité, il a donc maintenant ".(string)($this->ArgentJoueur)."€";
            
        }
        
        
    }

    public function initialstate(){
        $this->status="undefined";
        $this->MiseJoueur=0;
        $this->cards=[];
    }
    
}