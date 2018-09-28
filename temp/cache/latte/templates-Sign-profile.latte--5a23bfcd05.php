<?php
// source: C:\xampp\htdocs\divisionManager\app\presenters/templates/Sign/profile.latte

use Latte\Runtime as LR;

class Template5a23bfcd05 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		$this->renderBlock('title', get_defined_vars());
		
	}


	function blockTitle($_args)
	{
		extract($_args);
		?><h1>Profil uživatele: <?php echo LR\Filters::escapeHtmlText($user->getIdentity()->username) /* line 2 */ ?></h1>
<?php
	}

}
