<?php
// source: C:\xampp\htdocs\divisionManager\app\components/TodoControl.latte

use Latte\Runtime as LR;

class Template9f4eb6db3a extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
            <input type="number" id="addpid" placeholder="PID"><br>
	    <input type="button" value="Add" id="add"><br>
                <br>
		<input type="number" id="removeid" placeholder="ID"><br>
	    <input type="button" value="Remove" id="remove">
	    
<div class='table'></div>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
