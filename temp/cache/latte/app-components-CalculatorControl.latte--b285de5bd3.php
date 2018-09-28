<?php
// source: C:\xampp\htdocs\calculator\app\components/CalculatorControl.latte

use Latte\Runtime as LR;

class Templateb285de5bd3 extends Latte\Runtime\Template
{
	public $blocks = [
		'_history' => 'blockHistory',
		'_display' => 'blockDisplay',
		'_continuos' => 'blockContinuos',
	];

	public $blockTypes = [
		'_history' => 'html',
		'_display' => 'html',
		'_continuos' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<div id="calculator">
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('history')) ?>"><?php $this->renderBlock('_history', $this->params) ?></div>        <div id="wholedisplay">    
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('display')) ?>"><?php $this->renderBlock('_display', $this->params) ?></div>        </div>
          <div id="keyboard">
    <ul>
        <button id="clear">C</button>
        <button class="operator" value="/">/</button>
        <button class="operator" value="*">×</button>
        <button id="back">↩</button>
    </ul>
    <ul>
        <button class="num" value="7">7</button>
        <button class="num" value="8">8</button>
        <button class="num" value="9">9</button>
        <button class="operator" value="-">-</button>    
     </ul>
    <ul>
        <button class="num" value="4">4</button>
        <button class="num" value="5">5</button>
        <button class="num" value="6">6</button>
       <button class="operator" value="+">+</button>
     </ul>
    <ul>
        <button class="num" value="1">1</button>
        <button class="num" value="2">2</button>
        <button class="num" value="3">3</button>
         <button id="allClear" data-link="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("allClear!")) ?>">AC</button>
     </ul>
    <ul>
        <button class="operator" value=".">,</button>
        <button class="num" value="0">0</button>
        <button id="equals" data-link="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("calculate!")) ?>">=</button>
       
     </ul>
</div>

</div>
    
    
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['key'])) trigger_error('Variable $key overwritten in foreach on line 6');
		if (isset($this->params['value'])) trigger_error('Variable $value overwritten in foreach on line 6');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHistory($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("history", "static");
		?>            <div id="resultsHistory" data-link="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("saveHistory!")) ?>">
<?php
		if (isset($history)) {
			$iterations = 0;
			foreach ($history as $key => $value) {
				?>                    <p class="singleResult" id="result<?php echo LR\Filters::escapeHtmlAttr($key) /* line 7 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($value) /* line 7 */ ?></p>
<?php
				$iterations++;
			}
		}
?>
            </div>
<?php
		$this->global->snippetDriver->leave();
		
	}


	function blockDisplay($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("display", "static");
?>
            <input type="textarea" id="display" maxlength="24"
                   <?php
		if (isset($displayVal) && $displayVal !== 'error') {
			?>value="<?php echo LR\Filters::escapeHtmlAttr($displayVal) /* line 15 */ ?>"<?php
		}
?>placeholder="0">
<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('continuos')) ?>"><?php $this->renderBlock('_continuos', $this->params) ?></div><?php
		$this->global->snippetDriver->leave();
		
	}


	function blockContinuos($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("continuos", "static");
		?>                <p id="continuosResult" data-link="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("continuosResult!")) ?>"><?php
		if (isset($displayConVal)) {
			echo LR\Filters::escapeHtmlText($displayConVal) /* line 17 */;
		}
?></p>
<?php
		$this->global->snippetDriver->leave();
		
	}

}
