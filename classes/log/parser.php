<?php
class Log_Parser 
{
	public static function parse_file($file) 
	{
		$items = file($file);
		$parsed = array();
		foreach ($items as $item)
		{
			if ($item[0] == '<' OR trim($item) == '')
				continue;
			$parsed[] = self::parse($item);
		}
		return $parsed;
	}

	public static function parse($item)
	{
		preg_match('/^(?<time>[^\[]+)\[(?<type>.*)\] script: "(?<script>.*)" message: "(?<message>.*)" client: (?<client>[^ ]+) uri: (?<uri>[^ ]+) referer: (?<referer>[^ ]*) agent: "(?<agent>.*)" cookie: "(?<cookie>.*)"/', $item, $matches);
		return $matches;
	}
}
