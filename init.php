<?php

Route::set('log', 'log(/<day>)', array('day' => '[0-9]+\-[0-9]+\-[0-9]+'))
	->defaults(array(
		'controller' => 'log',
		'action' => 'view',
	));
