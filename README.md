Kohana's built in log is a bit weak , so I rewrite myself.

![screenshot](http://farm5.static.flickr.com/4043/4709236594_3334031e69.jpg)

Usage:
======

**1) put log module in MODPATH**

**2) in bootstrap.php**

add log to Kohana::modules
	Kohana::modules(array(
		'auth' => MODPATH.'auth',
		'cache' => MODPATH.'cache',
		//...
		'log' => MODPATH.'log',
	));

then replace origin with this
	Kohana::$log->attach(new Log_Writer_File(VARPATH.'log'));
	// this is just for test
	Kohana::$log->add(Kohana::INFO, 'someone just click the east egg!');

**3) edit MODPATH/log/classes/controller/log.php**

replace $log_dir to your own log dir;

**4) browser http://localhost/path/to/log/day**

first it will show exception, because log file is not exists, then add error to log.
refresh , it should show the page.
