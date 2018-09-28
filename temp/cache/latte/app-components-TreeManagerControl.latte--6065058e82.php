<?php
// source: C:\xampp\htdocs\divisionManager\app\components/TreeManagerControl.latte

use Latte\Runtime as LR;

class Template6065058e82 extends Latte\Runtime\Template
{
	public $blocks = [
		'_wholeList' => 'blockWholeList',
		'_tree' => 'blockTree',
	];

	public $blockTypes = [
		'_wholeList' => 'html',
		'_tree' => 'html',
	];


	function main()
	{
		extract($this->params);
		?><div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('wholeList')) ?>"><?php
		$this->renderBlock('_wholeList', $this->params) ?></div><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['key'])) trigger_error('Variable $key overwritten in foreach on line 12');
		if (isset($this->params['value'])) trigger_error('Variable $value overwritten in foreach on line 12');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockWholeList($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("wholeList", "static");
?>
<input type="number" id="addpid" placeholder="PID"><br>
	    <input type="button" value="Add" id="add" data-link="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("add!")) ?>"><br>
                <br>
		<input type="number" id="removeid" placeholder="ID" data-link="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("remove!")) ?>"><br>
	    <input type="button" value="Remove" id="remove">
<?php
		if ($tree) {
?>

<div id="<?php echo htmlSpecialChars($this->global->snippetDriver->getHtmlId('tree')) ?>"><?php $this->renderBlock('_tree', $this->params) ?></div><?php
		}
		$this->global->snippetDriver->leave();
		
	}


	function blockTree($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("tree", "static");
?>
        <div class="table">
<?php
		$previousLvl=NULL;
		$iterations = 0;
		foreach ($tree as $key => $value) {
			if ($value['lvl'] == $previousLvl) {
?>
                
                 <div class='cell' id="<?php echo LR\Filters::escapeHtmlAttr($value['id']) /* line 15 */ ?>" style="background-color:<?php
				echo $value['color'] /* line 15 */ ?>">id: <?php echo LR\Filters::escapeHtmlText($value['id']) /* line 15 */ ?> pid: <?php
				echo LR\Filters::escapeHtmlText($value['pid']) /* line 15 */ ?></div>
                 
<?php
			}
			elseif (!$previousLvl) {
?>
                   
                <div class='row'>
                    <div class='cell' id="<?php echo LR\Filters::escapeHtmlAttr($value['id']) /* line 20 */ ?>" style="background-color:<?php
				echo $value['color'] /* line 20 */ ?>">id: <?php echo LR\Filters::escapeHtmlText($value['id']) /* line 20 */ ?> pid: <?php
				echo LR\Filters::escapeHtmlText($value['pid']) /* line 20 */ ?></div>
                    
<?php
			}
			elseif ($value['lvl'] != $previousLvl) {
?>
                
                 </div>
                 <div class='row'>
                 <div class='cell' id="<?php echo LR\Filters::escapeHtmlAttr($value['id']) /* line 26 */ ?>" style="background-color:<?php
				echo $value['color'] /* line 26 */ ?>">id: <?php echo LR\Filters::escapeHtmlText($value['id']) /* line 26 */ ?> pid: <?php
				echo LR\Filters::escapeHtmlText($value['pid']) /* line 26 */ ?></div>
<?php
			}
?>
            
<?php
			$previousLvl = $value['lvl'];
			$iterations++;
		}
?>
        </div>
        
<?php
		$this->global->snippetDriver->leave();
		
	}

}
