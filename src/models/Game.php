<?php

namespace Models;

class Game{
  private $players = [];
  private $status = "initial";
  private $deck=[];
  private $numeroDuJoueurEnCours=0;
  private $alert="";
  public $IsBetSet=false;
  
// fonctions qui vont effectuer des actions concrètes tel que supprimer un joueur ou bien changer le tour ou bien distribuer des cartes 
  public function DealCard(){
      $joueur=$this->getPlayerWhoPlay();
      $joueur->addCard($this->deck[0]);
      array_shift($this->deck);
      
    }
  public function ChangeTurn(){
    if($this->numeroDuJoueurEnCours<sizeof(($this->players))-1){
      $this->numeroDuJoueurEnCours= $this->numeroDuJoueurEnCours+1;
      if($this->alert==""){
        $this->PlayerChange($this->getLastPlayer()->getname(),$this->getPlayerWhoPlay()->getname());
      }else{
        
      }
      
    }else{
      
    }
  }

  public function dealCroupierCards(){
      
      $croupier=$this->getCroupier();
      
      $croupier->addCard($this->deck[0]);
      array_shift($this->deck);
    }


  public function suppress($name)
  {
    $i=0;
    foreach ($this->players as $key=>$value) {
      $i=$i+1;
      if( $name==$value->getname()){ 
        $supppress=$key;
      }
    }
    unset(($this->players)[$supppress]);
  }
  
   public function addcroupier(){
    array_push($this->players,new player('croupier'));
  }
  public function addPlayer($name){
    $test=true;
    foreach ($this->players as $value) {
      if( $name==$value->getname()){
        $test=false;
        $this->SetAlertPlayerExisted();
      }else{ 
      }
      if ($this->countPlayers()>=4){
        $this->TooMuchPlayer();
        $test=false;
      }
    }
    
    if($test==true){
      array_push($this->players,new player($name));
    }else{
      return false;
    }
  }
  
  
  // fonctions utilitaires qui me return des informations et me get un élément dont j'ai besoin dans mon game comme par exemple mes joueurs
  // ou bien le nombre de joueurs , le deck 
  public function getLastPlayer(){
    return $this->getPlayers()[$this->numeroDuJoueurEnCours-1];
  }
  public function getPlayerWhoPlay(){
    return $this->getPlayers()[$this->numeroDuJoueurEnCours];
  }
  public function getNextPlayer(){
    return $this->getPlayers()[$this->numeroDuJoueurEnCours+1];
  }
  public function getCroupier(){
    return $this->getPlayers()[sizeof($this->players)-1];
  }
  public function countPlayers(){
    $i=0;
    foreach ($this->players as $value) {
      $i=$i+1;
    }
    return $i;
  }
   public function getSum(){
    $joueur=$this->getPlayerWhoPlay();
    $joueur->GetSum();
    return $joueur->GetSum();
  }
  public function getDeck(){
    return $this->deck;
  }
  
  public function NumberofPlayers(){
    return sizeof($this->players);
  }

  
  public function getPlayers(){
    return $this->players;
  }
  public function getStatus(){
    return $this->status;
  }




  // fonctions qui permettent de mettre le status du game, celui ci empêche l'utilisateur de circuler comme il veut entre les pages
  public function startBet(){
    $this->status = "mise";
  }
  public function SetStateTurnCroupier(){
    
    $this->status = "croupierTurn";
  }
  public function startGame(){
    $this->status = "begin";
  }
  
  public function stateResults(){
    $this->status = "results";
  }
  public function redirect(){
    header("Location:/?controller=index&action=home");
  }
  
  
  //save tt le game et récupère tt le game
  public function EntireSave($game){
    $_SESSION['game']=$game;
  }
  
  public function EntireLoad(){
    return $_SESSION['game'];
  }

  // fonction pour build le deck
  public function builDeck(){
    if ($this->deck==[]){
      $deck= new frDeck();
      $this->deck= $deck->GetDeck();
    }
    
  }
  // fonctions de vérif pour gérer des certains cas et empêcher certaines situations de se 
  // produire comme par exemple qu'un joueur continue à piocher des cartes après avoir eu plus de 21 points
  public function VerirfyIfWinCroupier(){
    $joueur=$this->getPlayerWhoPlay();
    $sum=$joueur->GetSum();
    if($sum==21){
      $joueur->setStatus('win'); 
    }  
    else if($sum>21){
      $joueur->setStatus('lose');
    }
  }
  public function VerirfyIfWin(){
    $joueur=$this->getPlayerWhoPlay();
    $sum=$joueur->GetSum();
    if($sum==21){
      $joueur->setStatus('win');
      $this->PlayerWinChange($this->getPlayerWhoPlay()->getname(),$this->getNextPlayer()->getname());
      $this->EntireSave($this, false);
      header("Location:/?controller=game&action=changePlayer");
      exit();
    }
    else if($sum>21){
      $joueur->setStatus('lose');
      $this->PlayerLoseChange($this->getPlayerWhoPlay()->getname(),$this->getNextPlayer()->getname());
      $this->EntireSave($this);
      header("Location:/?controller=game&action=changePlayer");
      exit();
    }    
  }

   public function verifyNumberOfCards()
   {
    $joueur=$this->getPlayerWhoPlay();
    return (sizeof($joueur->getCard()));
   }
  public function verifyNumberOfCardsOfCroupier(){
    $croupier=$this->getCroupier();
    return (sizeof($croupier->getCard()));
  }
 public function verifyIfPlayer0(){
    $i=0;
    foreach ($this->players as $value=>$key) {
      $i=$i+1;
      if( $value->ArgentJoueur==0){ 
        $supppress=$key;
      }
    }
    $this->SetAlertPlayerMustQuitt(($this->getPlayers()[$supppress])->getname());
    unset(($this->players)[$supppress]);
  }
  public function verify(){
    if((sizeof($this->players))!=0){
      return true;
      
    }else{
      
      return false;
    }
    
  }

  public function isTurnCroupier(){
    if($this->alert==""){
      
    }
    if($this->numeroDuJoueurEnCours==(sizeof(($this->players))-1)){
      
      return true;
      
    }
  }
  
  // fonction qui vérifie qui a gagné  et qui set les status en fonction de la main du croupier
  public function verifyHowWin(){
    $croupier=$this->getCroupier();
    for ($i=0; $i < (sizeof($this->players)-1) ; $i++) { 
      if(($this->players[$i])->getStatus()=="win"){
        ($this->players[$i])->setStatus("WinBy21");
      }
      if(($this->players[$i])->getStatus()=="lose"){
        if($croupier->getStatus()=="lose"){
          ($this->players[$i])->setStatus("egaliteParPerdu");
        }
      }
      if(($this->players[$i])->getStatus()=="undefined"){
        if($croupier->getStatus()=="lose"){
          ($this->players[$i])->setStatus("winByCroupierDefeat");
        }else if(($croupier->getStatus()=="win")){
          ($this->players[$i])->setStatus("loseByCroupierWin");
        }else if(($croupier->getStatus()=="undefined")){
          if(($this->players[$i])->GetSum()>$croupier->GetSum()){
            $this->players[$i]->setStatus("winByHand");
          }
          if(($this->players[$i])->GetSum()<$croupier->GetSum()){
            $this->players[$i]->setStatus("LoseByHand");
          }
          if(($this->players[$i])->GetSum()==$croupier->GetSum()){
            $this->players[$i]->setStatus("EqualityByHand");
            
          }
        }
      }
    }
  }
  
  // Je mets ici toutes les fonctions en relation avec l'affichage
  public function showImg(){
    $joueur=$this->getPlayerWhoPlay();
    foreach(($joueur->getSrc()) as $value){
      echo "<img src='$value' class='img'>";
    }
  }
  
  public function showFirstImg(){
    $croupier=$this->getCroupier();
    $card=$croupier->showFirstCard();
    echo "<img src='$card' class='imgcroup'>";
    echo "<img src='images/cards/Back.png' class='imgcroup'>";
  }

  public function firstcardName(){
    $croupier=$this->getCroupier();
    return $croupier->firstCardValue();
  }

  public function writeTheCards(){
    $joueur=$this->getPlayerWhoPlay();
    return ($joueur->writeCards());
  }
  
  
  //  gestion des alertes
  public function getMyAlert(){
    
    if($this->alert!=""){
      
      $alert=$this->alert["alert"];
      $type=$this->alert["type"];
      $title=$this->alert["title"];
      echo'<input type="hidden" title="'.$title.'"  name="'.$type.'" id="myalert" value="'.$alert.'">';
      $this->alert="";
      
    }
  }
  public function SetAlertBetNotGood(){
    $message="La mise doit être pour chaque joueur inférieur à son argent et ne pas être égal à 0";
    $type="error";
    $title="Erreur";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
    
    
  }
  public function SetAlertPlayerExisted(){
    $message="Ce joueur existe déjà";
    $type="error";
    $title="Interdit";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
    
    
  }
  
  public function SetAlertPlayerQuitTable($player,$argent){
    $message="il s'en va avec la somme de".$argent."€ dans les poches";
    $type="error";
    $title=$player."quitte la table du blackjack";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
    
    
  }
  
  public function SetAlertResults(){
    $message="Place aux résultats désormais bravo à ceux qui ont gagné et bonne chance pour la prochaine partie pour les autres";
    $type="succsess";
    $title="LE jeu est fini";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
    
    
  }
  public function GameCantBegin(){
    $message="Vous ne pouvez pas commencer la partie sans joueur";
    $type="warning";
    $title="attention";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
  }
  
  public function TooMuchPlayer(){
    $message="Quelqun doit quitter la table si un nouveau joueur veut jouer!!!";
    $type="error";
    $title="Ce jeu a une capacité maximale de 4 joueurs";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
  }
  
  
  
  public function gameBegin(){
    $message="Les cartes ont été mélangé vous allez pouvoir jouer";
    $type="success";
    $title="Enjoy";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
  }
  
  public function PlayerWinChange($player,$playerSuivant){
    $message=$player." a eu de la chance et a eu 21 points c'est donc maintenant au tour de".$playerSuivant." !!";
    $type="success";
    $title="Enjoy";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
  }
  public function PlayerLoseChange($player,$playerSuivant){
    $message=$player." a été trop gourmand c'est donc maintenant au tour de".$playerSuivant." !!";
    $type="error";
    $title="C'est dommage";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
    
  }
  public function PlayerChange($player,$playerSuivant){
    $message="il verra à la fin le résultat. C'est maintenant au tour de ".$playerSuivant." !!";
    $type="warning";
    $title=$player."a passé son tour";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
  }

  public function SetAlertPlayerMustQuitt($player){
    $message="C'est dommage";
    $type="warning";
    $title=$player." a du nous quitté car il n'avait plus d'argent à miser ,c'est dommage
    mais il faut s'attendre à perdre quand on joue, espérons qu'il revienne un autre jour avec plus d'argent .";
    $this->alert=array("alert"=>$message,"type"=>$type,"title"=>$title);
    
  }
 
  //Je mets ici le traitement des mises . 
  public function miseresolved(){
    $this->IsBetSet=true;
  }
  public function isBetSet(){
    return $this->IsBetSet;
  }
  public function verifyBet($sumBet,$idPerso){
    $perso= $this->getPlayers()[$idPerso];
    $verify=$perso->verifyBet($sumBet);
    return $verify;
  } 
  
  public function resolveBet(){
    for ($i=0; $i < (sizeof($this->players)-1) ; $i++) {
      $player=$this->players[$i];
      $player->resolveBet();
      
    }
    
  }
  // ici je fais une fonction qui me réinitialise tout les statuts sauf l'argent de mes joueurs et leurs noms
  public function replay(){
    $this->startBet();
    $myplayers=$this->getPlayers();
    
    foreach ($myplayers as  $player) {
      $player->initialstate();
    }
    array_pop($this->players);
    $this->deck=[];
    $this->numeroDuJoueurEnCours=0;
    $this->alert="";
    $this->IsBetSet=false;
  }
  public function reinit(){
    session_destroy();
    
  }
  
}