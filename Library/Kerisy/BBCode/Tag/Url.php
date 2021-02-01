<?php

class Kerisy_BBCode_Tag_Url extends Kerisy_BBCode_Tag
{
	public function __construct()
	{
		$this->_single = false;
		$this->_effective = false;
	}

	public function setParamsFromString($string)
	{
		if ($this->_close_tag)
		{
			$this->_effective = true;
			return $this;
		}
		
		if (!$string)
		{
			$this->_effective = true;
			return $this;
		}
		
		if (preg_match("/=(['\"])?([^'^\"]+)\\1?/", $string, $matches))
		{
			$this->_params['url'] = $matches[2];
			$this->_effective = true;
		}
		else
		{
			$this->_effective = false;
		}
		
		return $this;
	}
	
	public function getBeginHtml()
	{
		return "<a href=\"{$this->_params['url']}\" target=\"_blank\">";
	}
	
	public function getEndHtml()
	{
		return "</a>";
	}
}
