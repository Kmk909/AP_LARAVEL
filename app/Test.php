<?php

namespace App;

class Test{
    public function smth(){
       dd('here is something');
    }
    protected $name;
    public function __construct($name){
       $this->name=$name;
    }

      public function execute(){
        dd('Something is executed.');
      }

}