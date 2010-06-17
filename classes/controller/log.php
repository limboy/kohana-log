<?php
class Controller_Log extends Controller 
{
	public function action_view()
	{
		$log_dir = VARPATH.'log';
		$day = $this->request->param('day', date('Y-m-d'));
		if (!file_exists($log_file = $log_dir.DIRECTORY_SEPARATOR.$day.'.php'))
		{
			throw new Log_Exception('log file :file not exists', array(
				':file' => $log_file,
			));
		}
		$logs = Log_Parser::parse_file($log_file);
		$this->request->response = View::factory('log_view')
			->set('logs', $logs)
			;
	}
}
