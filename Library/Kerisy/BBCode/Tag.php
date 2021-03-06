<?php

abstract class Kerisy_BBCode_Tag
{
	/*
	 * 标签名
	 * */
	protected $_tag_name = null;
	
	// 是否单标签
	protected $_single = false;
	
	// 是否有效
	protected $_effective = false;
	
	/*
	 * 是闭合标签？
	 * */
	protected $_close_tag = false;
	
	/*
	 * 标签长度
	 * */
	protected $_tag_length = 0;
	
	/*
	 * 标签在字符串中的位置
	 * */
	protected $_tag_position = 0;
	
	protected $_actived = false;
	
	protected $_ignore_bbcode = false;
	
	protected $_params = array();
	
	public function setTag($tag_name)
	{
		$this->_tag_name = $tag_name;
		return $this;
	}
	
	public function getTag()
	{
		if (!$this->_tag_name)
		{
			// TODO show error.
		}
		
		return $this->_tag_name;
	}
	
	public function ignoreBBCode()
	{
		return $this->_ignore_bbcode;
	}
	
	public function isActived()
	{
		return $this->_actived;
	}
	
	public function isSingle()
	{
		return $this->_single;
	}
	
	public function isEffective()
	{
		return $this->_effective;
	}
	
	public function setActived($actived = true)
	{
		$this->_actived = $actived;
	}
	
	public function isCloseTag()
	{
		return $this->_close_tag;
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
	}
	
	public function setCloseTag($close = true)
	{
		$this->_close_tag = $close;
		return $this;
	}

	public function setLength($length = 0)
	{
		$this->_tag_length = $length;
		return $this;
	}

	public function getLength()
	{
		return $this->_tag_length;
	}
	
	public function setPosition($position)
	{
		$this->_tag_position = $position;
		return $this;	
	}
	
	public function getPosition()
	{
		return $this->_tag_position;
	}
	
	public function getHtml()
	{
		if ($this->_close_tag)
		{
			return $this->getEndHtml();
		}

		return $this->getBeginHtml();
	}
	
	public function getBeginHtml()
	{
		return null;
	}
	
	public function getEndHtml()
	{
		return null;
	}
}
