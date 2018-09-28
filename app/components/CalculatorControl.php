<?php

namespace App\Components;

use App\Model\CalculatorService;
use Nette\Application\UI;
use Tracy\Debugger;
use Tracy;

class CalculatorControl extends UI\Control {

	/** @var CalculatorService @inject */
	public $calculatorService;
        
	public function render() {
            $this->template->setFile(__DIR__ . '/CalculatorControl.latte');
            $this->template->render();
	}
            
	public function handleCalculate($result) {
            if($result == 'chyba'){
                $this->template->displayVal = null;
                $this->template->displayConVal = null;
            }else{
                $this->template->displayVal = $result;
                $this->template->displayConVal = null;
            }
            $this->redrawControl('display');
	}
        
      	public function handleContinuosResult($continuosExample) {
            $parsed = $this->calculatorService->parse($continuosExample);
            if(!$parsed){
                $result[0] = "chyba";
            }else{
                $result = $this->calculatorService->calculate($parsed);
            }
            $this->template->displayVal = $continuosExample;
            $this->template->displayConVal = $result[0];
            $this->redrawControl('continuos');
	}

        public function handleSaveHistory($expression, $saved = array()) {
            $this->template->history = $this->calculatorService->save($expression, $saved);     
            $this->redrawControl('history');
        }
    
        public function handleAllClear() {
            $this->redrawControl();
	}
        
}
