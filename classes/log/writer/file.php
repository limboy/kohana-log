<?php defined('SYSPATH') or die('No direct script access.');

class Log_Writer_File extends Kohana_Log_Writer {

	protected $_directory;

	public function __construct($directory)
	{
		if ( ! is_dir($directory) OR ! is_writable($directory))
		{
			throw new Kohana_Exception('Directory :dir must be writable',
				array(':dir' => Kohana::debug_path($directory)));
		}

		$this->_directory = realpath($directory).DIRECTORY_SEPARATOR;
	}

	public function write(array $messages)
	{
		if (!file_exists($filename = $this->_directory.date('Y-m-d').'.php'))
		{
			file_put_contents($filename, '<?php die();?>'.PHP_EOL);
		}

		foreach ($messages as $message)
		{
			$log_cnt = $this->_format($message);
			file_put_contents($filename, PHP_EOL.$log_cnt, FILE_APPEND);
		}
	}

	protected function _format($message)
	{
		$return = $message['time'].' ';
		$return .= '['.$message['type'].'] ';

		/* it is hard to archive in current version
		$script = '';
		foreach(debug_backtrace() as $debug_info) {
			if(!empty($debug_info['file']))
			{
				$file = $debug_info['file'];
				if (strpos($file, MODPATH) !== false)
				{
					$file = 'MODPATH/'.str_replace(MODPATH, '', $file);
				}
				elseif (strpos($file, APPPATH) !== false)
				{
					$file = 'APPPATH/'.str_replace(APPPATH, '', $file);
				}
				elseif (strpos($file, SYSPATH) !== false)
				{
					$file = 'SYSPATH/'.str_replace(SYSPATH, '', $file);
				}
				$script .= $file.'#'.$debug_info['line'].'; ';
			}
		}
		$return .= 'script: "'.rtrim($script,"; ").'" ';
		//*/

		$body = $message['body'];
		if(!(is_string($body))) {
			$body = str_replace("\n", '', var_export($body, true));
		}
		$return .= 'message: "'.$body.'" ';

		$return .= 'client: '.Request::$client_ip.' ';

		$return .= 'uri: '.$_SERVER['REQUEST_URI']." ";

		if (isset($_SERVER['HTTP_REFERER']))
		{
			$return .= 'referer: '.$_SERVER['HTTP_REFERER']." ";
		}
		else 
		{
			$return .= 'referer: "" ';
		}

		$return .= 'agent: "'.$_SERVER['HTTP_USER_AGENT'].'" ';

		$return .= 'cookie: "'.str_replace("\n", '', var_export($_COOKIE, true)).'" ';

		return $return;
	}

} // End Kohana_Log_File

