<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Server Error | ForgePHP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= assets() ?>error/main.css">
</head>

<body>
	<div class="error-container">
		<div class="error-icon">
			<i class="fas fa-server"></i>
		</div>
		<div class="error-code">500</div>
		<h1 class="error-title">Server Error</h1>
		<p class="error-message">
			Sorry, something went wrong on our server. Our team has been notified and is working to fix the issue.
			Please try again in a few moments.
		</p>
		<a href="<?= base_url() ?>" class="btn-home">
			<i class="fas fa-home"></i> Back to Home
		</a>
		<div class="additional-links">
			<a href="mailto:support@forgephp.com">Email Support</a> •
			<a href="<?= base_url('status') ?>">Server Status</a>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>