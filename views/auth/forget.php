<?= extend('components.layouts.guest') ?>

<?= section('content') ?>
<div class="auth-container">
	<?= embed('components.logo') ?>

	<h2>Reset Password</h2>
	<p class="mt-3 instruction-text">Enter your registered email address and we will send you a link to reset your password.</p>

	<!-- Success message (shown after submission) -->
	<!-- <div class="success-message">
			<i class="fas fa-check-circle"></i>
			<div>
				<strong>Email sent!</strong> Please check your inbox for password reset instructions.
			</div>
		</div> -->

	<form action="<?= base_url('forgot-password') ?>" method="post">
		<div class="mb-3">
			<input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
		</div>

		<button type="submit" class="btn btn-auth">
			<i class="fas fa-paper-plane"></i> Send Reset Link
		</button>
	</form>

	<div class="auth-link">
		Remember your password? <a href="<?= base_url('login') ?>">Login here</a>
	</div>
</div>
<?= endsection() ?>

<?= display(); ?>