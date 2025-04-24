<?php

// State
$__sections     = [];
$__sectionStack = [];
$__pushes       = [];
$__pushStack    = [];
$__layout       = null;

// Section & Layout System
function extend(string $layoutPath): void
{
	global $__layout;
	$__layout = $layoutPath;
}

function section(string $name): void
{
	global $__sectionStack;
	$__sectionStack[] = $name;
	ob_start();
}

function endsection(): void
{
	global $__sections, $__sectionStack;
	$name = array_pop($__sectionStack);
	$__sections[$name] = ob_get_clean();
}

function forge(string $name): string
{
	global $__sections;
	return $__sections[$name] ?? '';
}

// Display layout
function display(): void
{
	global $__layout;

	if (!$__layout) {
		throw new RuntimeException("No layout defined. Call extend() first.");
	}

	include __DIR__ . '/../views/' . str_replace('.', '/', $__layout) . '.php';
}

// Push & Stack (like @push / @stack in Laravel)
function push(string $name): void
{
	global $__pushStack;
	$__pushStack[] = $name;
	ob_start();
}

function endpush(): void
{
	global $__pushes, $__pushStack;
	$name = array_pop($__pushStack);
	$__pushes[$name][] = ob_get_clean();
}

function stack(string $name): string
{
	global $__pushes;
	return isset($__pushes[$name]) ? implode(PHP_EOL, $__pushes[$name]) : '';
}

// View rendering
function view(string $viewPath, array $data = []): string
{
	return render($viewPath, $data);
}

function render(string $viewPath, array $data = []): string
{
	$fullPath = __DIR__ . '/../views/' . str_replace('.', '/', $viewPath) . '.php';

	if (!file_exists($fullPath)) {
		throw new RuntimeException("View not found: $viewPath");
	}

	extract($data, EXTR_SKIP);
	ob_start();
	include $fullPath;
	return ob_get_clean();
}

// View embedding (partial include)
function embed(string $viewPath, array $data = []): string
{
	return render($viewPath, $data); // same logic, just alias
}
