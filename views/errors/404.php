<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Page Not Found | ForgePHP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= assets() ?>error/main.css">
</head>

<body>
	<div class="error-container">
		<div class="error-icon">
			<i class="fas fa-exclamation-triangle"></i>
		</div>
		<div class="error-code">404</div>
		<h1 class="error-title">Page Not Found</h1>
		<p class="error-message">
			Sorry, the page you are looking for could not be found.
			It may have been removed or the URL might be incorrect.
		</p>
		<a href="<?= base_url() ?>" class="btn-home">
			<i class="fas fa-home"></i> Back to Home
		</a>
		<div class="additional-links">
			<a href="<?= base_url('contact') ?>">Contact Us</a> •
			<a href="<?= base_url('help') ?>">Help</a>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>