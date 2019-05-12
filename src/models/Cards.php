<?php

namespace Models;

class Cards 
{
    public $type;
    public $number;
    public $name;

    public function __construct($Type, $Num, $Name,$Src) {
        $this->type   = $Type;
        $this->number = $Num;
        $this->name = $Name;
        $this->src= $Src;
}



    public function getcard(){
        return $this->name . " of " . $this->type ;
    }
    public function verif(){
        return [($this->type),($this->name)];
    }
    public function getType() {
        return $this->type;
}
public function getNum() {
    return $this->number;
}
public function getName() {
    return $this->name;
}
public function getSrc(){
    
    return $this->src;
}



}