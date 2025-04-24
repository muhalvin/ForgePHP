<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ForgePHP</title>
	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<style>
		:root {
			--primary-color: #6366f1;
			--primary-hover: #4f46e5;
			--success-color: #10b981;
			--warning-color: #f59e0b;
			--danger-color: #ef4444;
			--dark-bg: #0f172a;
			--card-bg: #1e293b;
			--text-primary: #f8fafc;
			--text-secondary: #94a3b8;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background-color: var(--dark-bg);
			color: var(--text-primary);
			min-height: 100vh;
			display: flex;
			align-items: center;
			background-image: radial-gradient(circle at 10% 20%, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 1) 90%);
		}

		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			animation: fadeIn 0.6s ease-out;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.card {
			border: none;
			border-radius: 16px;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
			padding: 40px;
			background-color: var(--card-bg);
			background-image: linear-gradient(to bottom right, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.9));
			backdrop-filter: blur(5px);
			overflow: hidden;
			position: relative;
		}

		.card::before {
			content: '';
			position: absolute;
			top: -50%;
			right: -50%;
			width: 200%;
			height: 200%;
			background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
			z-index: -1;
		}

		.card h2 {
			font-weight: 700;
			color: var(--text-primary);
			margin-bottom: 15px;
			position: relative;
			display: inline-block;
		}

		.card h2::after {
			content: '';
			position: absolute;
			bottom: -8px;
			left: 0;
			width: 50px;
			height: 4px;
			background: var(--primary-color);
			border-radius: 2px;
		}

		.card .lead {
			color: var(--text-secondary);
			margin-bottom: 30px;
			font-size: 1.1rem;
		}

		.alert {
			border: none;
			border-radius: 10px;
			padding: 15px 20px;
			margin-bottom: 25px;
			display: flex;
			align-items: center;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		.alert i {
			margin-right: 12px;
			font-size: 1.2rem;
		}

		.alert-success {
			background-color: rgba(16, 185, 129, 0.15);
			color: var(--success-color);
		}

		.alert-warning {
			background-color: rgba(245, 158, 11, 0.15);
			color: var(--warning-color);
		}

		.alert strong {
			color: var(--text-primary);
		}

		.btn-login {
			background-color: var(--primary-color);
			border: none;
			border-radius: 10px;
			padding: 12px;
			font-weight: 500;
			width: 100%;
			margin-top: 10px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
		}

		.btn-login:hover {
			background-color: var(--primary-hover);
			transform: translateY(-2px);
			box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
		}

		.btn-logout {
			background-color: var(--danger-color);
			color: white;
			border: none;
			border-radius: 10px;
			padding: 12px 24px;
			font-weight: 500;
			transition: all 0.3s ease;
			box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			min-width: 150px;
		}

		.btn-logout:hover {
			background-color: #dc2626;
			transform: translateY(-2px);
			box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
		}

		.btn-logout i {
			margin-right: 8px;
		}

		.features {
			margin-top: 30px;
		}

		.feature-item {
			display: flex;
			align-items: center;
			margin-bottom: 15px;
			color: var(--text-secondary);
		}

		.feature-item i {
			color: var(--primary-color);
			margin-right: 10px;
			font-size: 1.1rem;
		}

		.logo {
			font-weight: 700;
			color: var(--primary-color);
			font-size: 1.8rem;
			margin-bottom: 5px;
			display: flex;
			align-items: center;
		}

		.logo i {
			margin-right: 10px;
		}

		@media (max-width: 576px) {
			.card {
				padding: 30px 20px;
			}

			.container {
				padding: 15px;
			}
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="card">
			<?= embed('components.logo') ?>

			<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
				<!-- Logged-in message -->
				<div class="alert alert-success">
					<i class="fas fa-check-circle me-3"></i>
					<div>
						<strong>Authentication Successful</strong>
						<div class="small">You're now logged into your account</div>
					</div>
				</div>

				<!-- Features list -->
				<div class="features mb-3">
					<div class="feature-item">
						<i class="fas fa-bolt me-2"></i> Lightning fast performance
					</div>
					<div class="feature-item">
						<i class="fas fa-shield-alt me-2"></i> Secure by default
					</div>
					<div class="feature-item">
						<i class="fas fa-cogs me-2"></i> Easy to customize
					</div>
				</div>

				<!-- Logout button -->
				<form action="<?= base_url('logout') ?>" method="POST">
					<button type="submit" class="btn-logout">
						<i class="fas fa-sign-out-alt me-1"></i> Logout
					</button>
				</form>
			<?php else: ?>
				<!-- Not logged-in message -->
				<div class="alert alert-warning">
					<i class="fas fa-exclamation-triangle me-3"></i>
					<div>
						<strong>Authentication Required</strong>
						<div class="small">Please login to access your dashboard</div>
					</div>
				</div>

				<div class="d-grid gap-2">
					<a href="<?= base_url('login') ?>" class="btn btn-login mb-2" style="padding: 12px; border-radius: 10px;">
						<i class="fas fa-sign-in-alt me-1"></i> Login
					</a>
					<a href="<?= base_url('register') ?>" class="btn btn-outline-secondary" style="padding: 12px; border-radius: 10px;">
						<i class="fas fa-user-plus me-1"></i> Register
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Bootstrap 5 JS Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Font Awesome JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>