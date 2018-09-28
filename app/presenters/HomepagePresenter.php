<?php

namespace App\Presenters;

use App\Components\CalculatorControlFactory;
use App\Model\CalculatorService;
use App\Components\CalculatorControl;

class HomepagePresenter extends BasePresenter {

	/** @var CalculatorControlFactory @inject */
	public $calculatorControlFactory;

	public $user;

	public function actionDefault() {

	}

	/**
	 * Calculator
	 * @return CalculatorControl
	 */
	protected function createComponentCalculator() {
		$control = $this->calculatorControlFactory->create();
		return $control;
	}

	public function actionDrop() {

		$control = $this->getComponent('calculator');
		$control->drop();
		$this->redirect('Homepage:');
	}
}