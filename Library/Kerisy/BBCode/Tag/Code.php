<?php

class Kerisy_BBCode_Tag_Code extends Kerisy_BBCode_Tag
{
	public function __construct()
	{
		$this->_single = false;
		
		$this->_ignore_bbcode = true;
	}
	
	public function getBeginHtml()
	{
		return "<pre class=\"code\">";
	}
	
	public function getEndHtml()
	{
		return "</pre>";
	}
}
