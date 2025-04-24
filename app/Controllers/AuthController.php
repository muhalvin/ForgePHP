<?php

namespace App\Controllers;

class AuthController extends Controller
{
	// Show the login page
	public function formlogin()
	{
		return view('auth.login');
	}

	// Process user authentication
	public function auth()
	{
		$email = $this->sanitizeInput($_POST['email']);
		$password = $this->sanitizeInput($_POST['password']);

		$query = "SELECT * FROM users WHERE email = :email";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch();

		if ($user && password_verify($password, $user['password'])) {
			session_regenerate_id(true);

			$_SESSION['loggedin'] = true;
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];

			$this->redirect(base_url('/'));
		} else {
			$error_message = "Incorrect email or password.";
		}

		return $this->formlogin();
	}

	// Show the register form
	public function formregister()
	{
		return view('auth.register');
	}

	// Process user register
	public function register()
	{
		// 
	}

	// Show the forget password page
	public function formforget()
	{
		return view('auth.forget');
	}

	// Reset password
	public function forget()
	{
		// 
	}

	// Log out and destroy session
	public function destroy()
	{
		$stmt = $this->pdo->prepare("DELETE FROM sessions WHERE id = :id");
		$stmt->execute(['id' => session_id()]);

		session_unset();
		session_destroy();

		$this->redirect(base_url('/'));
	}
}
