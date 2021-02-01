<?php

class Kerisy_BBCode_Tag_I extends Kerisy_BBCode_Tag
{
	public function __construct()
	{
		$this->_single = false;
	}
	
	public function getBeginHtml()
	{
		return "<em>";
	}
	
	public function getEndHtml()
	{
		return "</em>";
	}
}
