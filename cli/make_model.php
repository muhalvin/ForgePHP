#!/usr/bin/env php
<?php

$modelName = $argv[2] ?? null;

if (!$modelName) {
	echo "Error: Model name is required.\n";
	echo "Usage: php forge create:model ModelName\n";
	exit(1);
}

$className = ucfirst($modelName);
$directory = __DIR__ . '/../app/Models';
$filepath = "$directory/$className.php";

if (!is_dir($directory)) {
	mkdir($directory, 0777, true);
}

if (file_exists($filepath)) {
	echo "Model already exists: $className\n";
	exit(1);
}

$template = <<<PHP
<?php

namespace App\Models;

use PDO;

class $className extends BaseModel
{
    public function __construct(PDO \$pdo)
    {
        parent::__construct(\$pdo);
    }

    // Model-specific methods go here
}
PHP;

file_put_contents($filepath, $template);

echo "Model created: app/Models/$className.php\n";
