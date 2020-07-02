<?php
defined( '_JEXEC' ) or die;

jimport('joomla.form.formfield');

class JFormFieldLoadlang extends JFormField
{
	protected $type = 'loadlang';
	
	protected $file;
	protected $path;
	
	public function __get($name)
	{
		switch ($name)
		{
			case 'file':
			case 'path':
				return $this->$name;
		}
		return parent::__get($name);
	}
	
	public function __set($name, $value)
	{
		switch ($name)
		{
			case 'file':
				$this->file = (string)$value;
				break;
			
			case 'path':
				$this->path = (string)$value;
				break;
			
			default:
				parent::__set($name, $value);
		}
	}
	
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		
		$result = parent::setup($element, $value, $group);
		
		if($result == true)
		{
			$file = (string)$this->element['file'];
			
			if($file)
			{
				$this->file = $file;
			}
			else
			{
				return false;
			}
			
			switch((string)$this->element['path'])
			{
				case 'admin':
					$this->path = JPATH_ADMINISTRATOR;
					break;
				case 'site':
					$this->path = JPATH_SITE;
					break;
				default:
					$this->path = JPATH_BASE;
			}
		}
		return $result;
	}
	
	public function renderField($options = array())
	{
		JFactory::getLanguage()->load($this->file);
	}
	
	protected function getInput()
	{
	}
	
	protected function getLabel()
	{
	}
}
