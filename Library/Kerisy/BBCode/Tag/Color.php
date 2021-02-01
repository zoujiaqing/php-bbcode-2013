<?php

class Kerisy_BBCode_Tag_Color extends Kerisy_BBCode_Tag
{
	public function __construct()
	{
		$this->_single = false;
	}
	
	public function getBeginHtml()
	{
		return "<span style=\"color: red;\">";
	}
	
	public function getEndHtml()
	{
		return "</span>";
	}
}
