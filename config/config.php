<?php

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Base URL
function base_url($path = ''): string
{
	return rtrim($_ENV['APP_URL'], '/') . '/' . ltrim($path, '/');
}

function assets($path = ''): string
{
	return rtrim($_ENV['APP_URL'], '/') . '/public/' . ltrim($path, '/');
}
