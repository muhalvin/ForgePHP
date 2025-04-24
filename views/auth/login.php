<?= extend('components.layouts.guest') ?>

<?= section('content') ?>
<div class="login-container">
	<?= embed('components.logo') ?>

	<h2>Login to Your Account</h2>
	<p class="mt-3">Please log in to continue</p>

	<form action="<?= base_url('login') ?>" method="post">
		<div class="mb-3">
			<input type="email" id="email" name="email" class="form-control" value="admin@forgephp.com" placeholder="Email Address" required>
		</div>

		<div class="mb-3">
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" value="admin@forgephp.com" required>
		</div>

		<button type="submit" class="btn btn-login">
			<i class="fas fa-sign-in-alt"></i> Log In
		</button>

		<a href="<?= base_url('forget-password') ?>" class="forgot-password">
			Forgot password?
		</a>
	</form>

	<div class="register-link">
		Don't have an account? <a href="<?= base_url('register') ?>">Register now</a>
	</div>
</div>
<?= endsection() ?>

<?= display(); ?>