<?php

namespace App\Model;

use Nette;
use Nette\SmartObject;
use Tracy\Debugger;
class CalculatorService {


    /**
     * Vypočítá příklad podle správného pořadí aritmetických operací
     * @param $components
     */
    public function calculate($components){
    //nahraď v poli components pozice od 0 do 3 výsledkem matematické operace $components[x]/$components[y]
        while(($index=array_search('/',$components))>0){
            array_splice($components,$index-1,3,(string)($components[$index-1]/$components[$index+1]));
        }
        while(($index=array_search('*',$components))>0){
            array_splice($components,$index-1,3,(string)($components[$index-1]*$components[$index+1]));
        }
        while(($index=array_search('-',$components))>0){
            array_splice($components,$index-1,3, (string)($components[$index-1]-$components[$index+1]));
        }        
        while(($index=array_search('+',$components))>0){
            array_splice($components,$index-1,3,(string)($components[$index-1]+$components[$index+1]));
        }
        return $components;

    }
    /**
     *  Parsování obdrženého string řetězce na číselně indexované pole s jednotlivými hodnotami a operátory
     */
    public function parse($example){
        //dělení nulou
        $zeroDiv = $this->checkZeroDivide($example);
         //kontrola povolených znaků
        $matches = $this->checkSymbolsExample($example);
        
        if(!$matches || $zeroDiv){
             return false;
        }
        //rozdělení prvků podle operátorů
        $components = preg_split('#([*/+-])#',$example,NULL,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        
        //ošetření +/- na první pozici
        if($components[0] == '+'){
            array_shift($components);
        }else if($components[0] == '-'){
            array_shift($components);
            $components[0] = '-'.$components[0];
        }
        return $components;
        
    }
    
    /**
     *  Uložení výrazu do pole $history, při maximálním počtu 3 uložených výrazů
     *  
     */
    public function save($expression, $saved){

        $history = [0 => $expression];
        $zeroDiv = $this->checkZeroDivide($expression);
        $matches = $this->checkSymbolsExpression($expression);
        if(!$matches || $zeroDiv){
             return $saved;
        }else{
            foreach($saved as $value){
                array_push($history, $value);
                }
            if(count($history) == 4){
                array_pop($history);
                }
        return $history;
        }
    }
    
    private function checkZeroDivide($stored){

        return mb_strpos($stored, '/0');
    }
    
    private function checkSymbolsExample($stored){

        return preg_match("/^\s*([-+]?)(\d+)(?:\s*([-+*.\/])\s*((?:\s[-+])?\d+)\s*)*$/", $stored);
    }
    private function checkSymbolsExpression($stored){

        return preg_match("/^\s*([-+]?)(\d+)(?:\s*([-+*.\/])\s*((?:\s[-+])?\d+)\s*)+([=])([-])?(\d+)*([E][\+])?([.](\d+))*([E][\+])?(\d+)$/", $stored);
    }
}

