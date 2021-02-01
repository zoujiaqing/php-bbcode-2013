<?php

include_once 'Library/Kerisy/BBCode.php';

$content = '[b]ºÇºÇ[b]¹þ¹þ¹þ[/b]
		[/quote]
		[quote]
		[url="http://www.kerisy.com/"]°¡°¡[/url]
		[url=\'http://www.kerisy.com/\']°¡°¡[/url]
		[code]
		[color]CODE IN HERE![/color][font]/[font]
		[/code]';

$BBCode = new Kerisy_BBCode;
$html = $BBCode->parseBBCode($content);

echo $html;
