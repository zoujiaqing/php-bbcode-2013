<?php

function ee($c)
{
	echo "<pre>";
	print_r($c);
	echo "</pre>";
	exit;
}

include_once 'BBCode/Tag.php';
include_once 'BBCode/Tag/B.php';
include_once 'BBCode/Tag/I.php';
include_once 'BBCode/Tag/Url.php';
include_once 'BBCode/Tag/Color.php';
include_once 'BBCode/Tag/Quote.php';
include_once 'BBCode/Tag/Code.php';

class Kerisy_BBCode
{
	private $_tags = array(
		'b' => 'Kerisy_BBCode_Tag_B',
		'url' => 'Kerisy_BBCode_Tag_Url',
		'color' => 'Kerisy_BBCode_Tag_Color',
		'code' => 'Kerisy_BBCode_Tag_Code',
		'quote' => 'Kerisy_BBCode_Tag_Quote'
	);
	
	private $_find_tags = array();
	
	public function parseBBCode($content)
	{
		// 初始化公用成员变量
		$this->_find_tags = array();
		
		if (preg_match_all('/(\[(\/?)(\w+)([^\]]+)?\])/', $content, $matches, PREG_OFFSET_CAPTURE))
		{
			//ee($matches);
			$current_index = 0;
			for ($i = 0; $i < count($matches[0]); $i++)
			{
				$tag['tag'] = strtolower($matches[3][$i][0]);

				if (!isset($this->_tags[$tag['tag']]))
				{
					continue;
				}
				
				$Tag = new $this->_tags[$tag['tag']];
				$Tag->setTag($tag['tag']);
				$Tag->setCloseTag($matches[2][$i][0] ? true : false);
				$Tag->setPosition($matches[0][$i][1]);
				$Tag->setLength(strlen($matches[0][$i][0]));
				$Tag->setParamsFromString(isset($matches[4][$i][0]) ? $matches[4][$i][0] : '');
				
				if (!$Tag->isEffective())
				{
					continue;
				}
				
				if (!$Tag->isCloseTag())
				{
					if ($Tag->isSingle())
					{
						$this->_find_tags[$current_index] = $Tag;
						$current_index++;
						continue;
					}
				}
				else 
				{
					// 如果是关闭的就检测一下上面是否有匹配到的开启标签
					if (count($this->_find_tags))
					{
						$max = count($this->_find_tags)-1;
						// 从后往前查找
						for ($j = $max; $j >= 0; $j--)
						{
							if ($Tag->getTag() == $this->_find_tags[$j]->getTag() && $this->_find_tags[$j]->isCloseTag() == false && $this->_find_tags[$j]->isActived() == false)
							{
								$this->_find_tags[$j]->setActived(true);
								$Tag->setActived(true);
								
								if ($Tag->ignoreBBCode())
								{
									$current_index = $j+1;
									if ($max-$j > 0) {
										for ($k=$j+1; $k<=$max; $k++)
										{
											unset($this->_find_tags[$k]);
										}
									}
								}
								
								break;
							}
						}
					}
					
					// 闭合标签没有找到对应开始标签直接作废
					if ($Tag->isActived() == false)
					{
						continue;
					}
				}

				$this->_find_tags[$current_index] = $Tag;
				$current_index++;
			}
		}

		return $this->replaceContentBBCodeTags($content);
	}
	
	public function replaceContentBBCodeTags($content)
	{
		if (!$content || !count($this->_find_tags))
		{
			return $content;
		}
		
		$i=(count($this->_find_tags)-1);
		for ( ; $i >= 0; $i--)
		{
			// 跳过无效标签
			if (!$this->_find_tags[$i]->isActived())
			{
				continue;
			}
			
			$content = substr($content, 0, $this->_find_tags[$i]->getPosition()) . $this->_find_tags[$i]->getHtml() . substr($content, $this->_find_tags[$i]->getPosition() + $this->_find_tags[$i]->getLength(), strlen($content));
		}
		
		return $content;
	}
	
	public function parseHtml($content)
	{
		
	}
}
