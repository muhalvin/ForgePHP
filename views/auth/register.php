<?= extend('components.layouts.guest') ?>

<?= section('content') ?>
<div class="register-container">
	<?= embed('components.logo') ?>


	<h2>Create a New Account</h2>
	<p class="mt-3">Fill out the form below to register</p>

	<form action="<?= base_url('register') ?>" method="post">
		<div class="mb-3">
			<input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
		</div>

		<div class="mb-3">
			<input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
		</div>

		<div class="mb-3">
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required oninput="checkPasswordStrength(this.value)">
			<div class="password-strength">
				<div class="password-strength-bar" id="password-strength-bar"></div>
			</div>
			<div class="password-hint">
				Use 8 or more characters with a combination of letters, numbers, and symbols
			</div>
		</div>

		<div class="mb-3">
			<input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
		</div>

		<button type="submit" class="btn btn-register">
			<i class="fas fa-user-plus"></i> Register
		</button>
	</form>

	<div class="terms-text">
		By registering, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
	</div>

	<div class="login-link">
		Already have an account? <a href="<?= base_url('login') ?>">Login here</a>
	</div>
</div>
<?= endsection() ?>

<?= push('scripts') ?>
<script>
	function checkPasswordStrength(password) {
		const strengthBar = document.getElementById('password-strength-bar');
		let strength = 0;

		// Check length
		if (password.length >= 8) strength += 1;
		if (password.length >= 12) strength += 1;

		// Check for mixed case
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;

		// Check for numbers
		if (password.match(/[0-9]/)) strength += 1;

		// Check for special chars
		if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

		// Update strength bar
		switch (strength) {
			case 0:
				strengthBar.style.width = '0%';
				strengthBar.style.background = '#ef4444';
				break;
			case 1:
				strengthBar.style.width = '25%';
				strengthBar.style.background = '#ef4444';
				break;
			case 2:
				strengthBar.style.width = '50%';
				strengthBar.style.background = '#f59e0b';
				break;
			case 3:
				strengthBar.style.width = '75%';
				strengthBar.style.background = '#84cc16';
				break;
			case 4:
			case 5:
				strengthBar.style.width = '100%';
				strengthBar.style.background = '#10b981';
				break;
		}
	}
</script>
<?= endpush() ?>

<?= display(); ?>