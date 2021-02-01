<?php

class Kerisy_BBCode_Tag_B extends Kerisy_BBCode_Tag
{
	public function __construct()
	{
		$this->_single = false;
	}
	
	public function getBeginHtml()
	{
		return "<strong>";
	}
	
	public function getEndHtml()
	{
		return "</strong>";
	}
}
