<?php

function Logger(string $message, string $level = 'INFO'): void
{
	$logFile = __DIR__ . '/../storage/logs/pushcraft.log';
	$logDir = dirname($logFile);

	// Try creating log directory if it doesn't exist
	if (!is_dir($logDir)) {
		if (!mkdir($logDir, 0777, true) && !is_dir($logDir)) {
			echo "Error: Failed to create log directory at $logDir.\n";
			return;
		}
	}

	// Create the log file if it doesn't exist
	if (!file_exists($logFile)) {
		if (!touch($logFile)) {
			echo "Error: Failed to create log file at $logFile.\n";
			return;
		}
	}

	// Check if log file is writable
	if (!is_writable($logFile)) {
		echo "Error: Log file is not writable. Check permissions for $logFile.\n";
		return;
	}

	$timestamp = date('Y-m-d H:i:s');
	$logMessage = "[$timestamp] [$level] $message\n";

	file_put_contents($logFile, $logMessage, FILE_APPEND);

	// Log rotation if > 5 MB
	if (filesize($logFile) > 5 * 1024 * 1024) {
		$rotatedFile = $logDir . '/pushcraft.log.1';
		@rename($logFile, $rotatedFile);
		@touch($logFile);
	}
}
