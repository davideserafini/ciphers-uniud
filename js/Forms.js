$(document).ready(function(){
	// Disable HTML5 validation
	$("form").attr('novalidate', 'novalidate');
	
	// LOGIN form
	if (document.forms.login){
		$loginForm = $("form#login");
		
		$loginForm.find("#email").on('blur', function(){
			inputValidation.validateEmail(this, "email");
		});
		$loginForm.find("#password").on('blur', function(){
			inputValidation.validatePassword(this, "password");
		});
		$loginForm.on('submit', function(e){
			var $this = $(this);
			var isFormValid = true;
			
			if (!inputValidation.validateEmail($this.find("#email"), "email")) isFormValid = false;
			if (!inputValidation.validatePassword($this.find("#password"), "password")) isFormValid = false;
			
			if (!isFormValid){
				e.preventDefault();
			}
		});
	}
	
	// REGISTER form
	if (document.forms.register){
		$registerForm = $("form#register");
		
		$registerForm.find("#email").on('blur', function(){
			inputValidation.validateEmail(this, "email");
		});
		$registerForm.find("#confirm_email").on('blur', function(){
			inputValidation.validateConfirmEmail(this, $registerForm.find("#email"), "confirm email", "email");
		});
		$registerForm.find("#password").on('blur', function(){
			inputValidation.validatePassword(this, "password");
		});
		$registerForm.find("#confirm_password").on('blur', function(){
			inputValidation.validatePassword(this, "confirm password");
		});
		$registerForm.find("#first_name").on('blur', function(){
			inputValidation.validateName(this, "first name");
		});
		$registerForm.find("#last_name").on('blur', function(){
			inputValidation.validateName(this, "last name");
		});
		$registerForm.on('submit', function(e){
			var $this = $(this);
			var isFormValid = true;
			
			if (!inputValidation.validateEmail($this.find("#email"), "email")) isFormValid = false;
			if (!inputValidation.validateConfirmEmail($this.find("#confirm_email"), $registerForm.find("#email"), "confirm email", "email")) isFormValid = false;
			if (!inputValidation.validatePassword($this.find("#password"), "password")) isFormValid = false;
			
			if (!isFormValid){
				e.preventDefault();
			}
		});
	}

	// ACCOUNT form
	if (document.forms.account){
		$accountForm = $("form#account");
		
		$accountForm.find("#password").on('blur', function(){
			inputValidation.validatePassword(this, "password");
		});
		$accountForm.find("#confirm_password").on('blur', function(){
			if (inputValidation.validatePassword(this, "confirm password")) {
				inputValidation.validateConfirmPassword(this, $accountForm.find("#password"), "confirm password", "password");
			}
		});
		$accountForm.find("#first_name").on('blur', function(){
			inputValidation.validateName(this, "first name");
		});
		$accountForm.find("#last_name").on('blur', function(){
			inputValidation.validateName(this, "last name");
		});
		$accountForm.on('submit', function(e){
			var $this = $(this);
			var isFormValid = true;
			
			$passwordField = $this.find("#password");
			$confirmPasswordField = $this.find("#confirm_password");
			
			if ($passwordField.val().trim() != '' || $confirmPasswordField.val().trim() != ''){
				if (inputValidation.validatePassword($passwordField, "password") && inputValidation.validatePassword($confirmPasswordField, "confirm password")){
					isFormValid = inputValidation.validateConfirmPassword($confirmPasswordField, $passwordField, "confirm password", "password");
				} else {
					isFormValid = false;
				}
			}
			
			if (!isFormValid){
				e.preventDefault();
			}
		});
	}
	
	// ADMIN forms
	if (document.forms.adminUpdate){
		$adminForm = $("form#adminUpdate");
		
		$adminForm.find("#email").on('blur', function(){
			inputValidation.validateEmail(this, "email");
		});
		$adminForm.find("#confirm_email").on('blur', function(){
			if (inputValidation.validateEmail(this, "confirm email")){
				inputValidation.validateConfirmEmail(this, $adminForm.find("#email"), "confirm email", "email");
			}
		});
		$adminForm.find("#password").on('blur', function(){
			inputValidation.validatePassword(this, "password");
		});
		$adminForm.find("#confirm_password").on('blur', function(){
			if (inputValidation.validatePassword(this, "confirm password")) {
				inputValidation.validateConfirmPassword(this, $adminForm.find("#password"), "confirm password", "password");
			}
		});
		$adminForm.find("#first_name").on('blur', function(){
			inputValidation.validateName(this, "first name");
		});
		$adminForm.find("#last_name").on('blur', function(){
			inputValidation.validateName(this, "last name");
		});
		$adminForm.on('submit', function(e){
			var $this = $(this);
			var isFormValid = true;
			
			$emailField = $this.find("#email");
			$confirmEmailField = $this.find("#confirm_email");
			if ($emailField.val().trim() != '' || $confirmEmailField.val().trim() != ''){
				if (inputValidation.validateEmail($emailField, "email") && inputValidation.validateEmail($confirmEmailField, "confirm email")) {
					isFormValid = inputValidation.validateConfirmEmail($confirmEmailField, $emailField, "confirm email", "email");
				} else {
					isFormValid = false;
				}
			}
			
			$passwordField = $this.find("#password");
			$confirmPasswordField = $this.find("#confirm_password");
			if ($passwordField.val().trim() != '' || $confirmPasswordField.val().trim() != ''){
				if (inputValidation.validatePassword($passwordField, "password") && inputValidation.validatePassword($confirmPasswordField, "confirm password")) {
					isFormValid = inputValidation.validateConfirmPassword($confirmPasswordField, $passwordField, "confirm password", "password");
				} else {
					isFormValid = false;
				}
			}
						
			if (!isFormValid){
				e.preventDefault();
			}
		});
	}

	// CIPHERS forms
	
	// Rail Fence
	if (document.forms.rail_fence){
		$("#crypt").on('click', function(e){
			e.preventDefault();
			var plaintext = document.forms.rail_fence.plaintext.value;
			var key = document.forms.rail_fence.key.value;
			var encryptedText = ciphers.railFence.crypt(plaintext, key);
			
			if(encryptedText){
				document.forms.rail_fence.encrypted_text.value = encryptedText;
			}
		});
		
		$("#decrypt").on('click', function(e){
			e.preventDefault();
			var encryptedText = document.forms.rail_fence.encrypted_text.value;
			var key = document.forms.rail_fence.key.value;
			var decryptedText = ciphers.railFence.decrypt(encryptedText, key);

			if(decryptedText){
				document.forms.rail_fence.plaintext.value = decryptedText;
			}
		})
	}
	
	// Caesar
	if (document.forms.caesar){
		$("#crypt").on('click', function(e){
			e.preventDefault();
			var plaintext = document.forms.caesar.plaintext.value;
			var key = document.forms.caesar.key.value;
			var encryptedText = ciphers.caesar.crypt(plaintext, key);
			
			if(encryptedText){
				document.forms.caesar.encrypted_text.value = encryptedText;
			}
		});
		
		$("#decrypt").on('click', function(e){
			e.preventDefault();
			var encryptedText = document.forms.caesar.encrypted_text.value;
			var key = document.forms.caesar.key.value;
			var decryptedText = ciphers.caesar.decrypt(encryptedText, key);

			if(decryptedText){
				document.forms.caesar.plaintext.value = decryptedText;
			}
		})
	}
	
	// Vigenère
	if (document.forms.vigenere){
		$("#crypt").on('click', function(e){
			e.preventDefault();
			var plaintext = document.forms.vigenere.plaintext.value;
			var key = document.forms.vigenere.key.value;
			var encryptedText = ciphers.vigenere.crypt(plaintext, key);
			
			if(encryptedText){
				document.forms.vigenere.encrypted_text.value = encryptedText;
			}
		});
		
		$("#decrypt").on('click', function(e){
			e.preventDefault();
			var encryptedText = document.forms.vigenere.encrypted_text.value;
			var key = document.forms.vigenere.key.value;
			var decryptedText = ciphers.vigenere.decrypt(encryptedText, key);

			if(decryptedText){
				document.forms.vigenere.plaintext.value = decryptedText;
			}
		})
	}
});