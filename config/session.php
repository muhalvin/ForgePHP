<?php

return [
	'driver' 	=> $_ENV['SESSION_DRIVER'] ?? 'file',
	'lifetime' 	=> (int) ($_ENV['SESSION_LIFETIME'] ?? 120),
	'secure' 	=> ($_ENV['SESSION_SECURE'] ?? 'false') === 'true',
	'httponly' 	=> ($_ENV['SESSION_HTTPONLY'] ?? 'true') === 'true',
	'name' 		=> $_ENV['SESSION_NAME'] ?? 'forgephp_session',
];
