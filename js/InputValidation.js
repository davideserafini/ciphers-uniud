function ErrorMessage(field, message){
	var _errorElement = "<span>";
	var _errorElementClass = "validation_error";
	var _$element;
	var _message = message != null ? message : '';
	var _$field = _fieldTojQueryObj(field);
	
	function _fieldTojQueryObj(field){
		if (field instanceof jQuery)
			return field;
		else
			return $(field);
	}
	
	function _createElement(){
		_$element = $(_errorElement);
		_$element.addClass(_errorElementClass);
		_$element.hide();
	}
	
	function _appendElement(){
		_$field.after(_$element);
	}
	
	function _setMessage(message){
		_message = message;
		_$element.html(_message);
	}
	
	function _show(){
		_$element.fadeIn(250);
	}
	function _hide(){
		_$element.fadeOut(250);
	}
	
	function _init(){
		if(_$field.next().hasClass(_errorElementClass)){
			_$element = _$field.next();
		} else {
			_createElement();
			_appendElement();
			if (_message)
				_setMessage(_message);
		}
	}
	
	this.setMessage = function(message){
		_setMessage(message);
		return this;
	}
	
	this.show = function(){
		_show();
	}
	this.hide = function(){
		_hide();
	}
	
	_init();
}

function InputValidation(){
	
	var validationMessages = {
		'required'			: "field is required",
		'valid_email'		: "field must be a valid email ",
		'valid_characters'	: "field contains characters not allowed",
		'matches'			: "field must match field2",
	};
		
	function _getErrorMessage(field){
		if (!field.errorMessage)
			field.errorMessage = new ErrorMessage(field);

		return field.errorMessage;
	}
	
	function _showErrorMessage(field, message, fieldReplacement, fieldReplacement2){
		var messageToSet = message;
		var fieldReplacement2 = fieldReplacement2 != null ? fieldReplacement2 : null;
		
		if (fieldReplacement2)
			messageToSet = messageToSet.replace("field2", fieldReplacement2);
		messageToSet = messageToSet.replace("field", fieldReplacement);
		
		_getErrorMessage(field).setMessage(messageToSet).show();
	}
	
	function _hideErrorMessage(field){
		_getErrorMessage(field).hide();
	}
	
	function _isField(field){
		return $.type(field) == 'object';
	}
	
	function _returnValue(fieldOrValue){
		if (fieldOrValue instanceof jQuery){
			return fieldOrValue.val().trim();
		} else {
			return fieldOrValue.value.trim();
		}
	}
	
	function _isEmpty(value){
		return value == '';
	}
	

	
	this.isEmpty = function(field){
		return _isEmpty(_returnValue(field));
	}
	
	this.validateEmail = function(email, fieldName){		
		var validEmailPattern = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;
		var value = _returnValue(email);
		
		if (_isEmpty(value)){
			_showErrorMessage(email, validationMessages['required'], fieldName);
			return false;
		}
		
		var isValid = validEmailPattern.test(value);
		if(!isValid){
			_showErrorMessage(email, validationMessages['valid_email'], fieldName);
			return false;
		}
		
		_hideErrorMessage(email);
		
		return true;
	}
	
	this.validateConfirmEmail = function(confirmEmail, email, confirmEmailFieldName, emailFieldName){
		var confirmEmailValue = _returnValue(confirmEmail);
		var emailValue = _returnValue(email);
		
		if (_isEmpty(confirmEmailValue)){
			_showErrorMessage(confirmEmail, validationMessages['required'], confirmEmailFieldName);
			return false;
		}
		
		if (confirmEmailValue != emailValue){
			_showErrorMessage(confirmEmail, validationMessages['matches'], confirmEmailFieldName, emailFieldName);
			return false;
		}
		
		_hideErrorMessage(confirmEmail);
		_hideErrorMessage(email);
		
		return true;
		
	}
	
	this.validatePassword = function(password, fieldName){
		var validPasswordChars = /^[a-zA-Z0-9@#!?\-_\[\]\£\$\%\&;,:.=\^()]*$/;
		var value = _returnValue(password);
		
		if (_isEmpty(value)){
			_showErrorMessage(password, validationMessages['required'], fieldName);
			return false;
		}
		
		var isValid = validPasswordChars.test(value);
		if (!isValid){
			_showErrorMessage(password, validationMessages['valid_characters'], fieldName);
			return true;
		}
		
		_hideErrorMessage(password);
		
		return true;
	}
	
	this.validateConfirmPassword = function(confirmPassword, password, confirmPasswordFieldName, passwordFieldName){
		var confirmPasswordValue = _returnValue(confirmPassword);
		var passwordValue = _returnValue(password);
		
		if (_isEmpty(confirmPasswordValue)){
			_showErrorMessage(confirmPassword, validationMessages['required'], confirmPasswordFieldName);
			return false;
		}
		
		if (confirmPasswordValue != passwordValue){
			_showErrorMessage(confirmPassword, validationMessages['matches'], confirmPasswordFieldName, passwordFieldName);
			return false;
		}
		
		_hideErrorMessage(confirmPassword);
		_hideErrorMessage(password);
		
		return true;
		
	}
	
	this.validateName = function(name, fieldName){
		var validNameChars = /^[a-zA-Z\s\-\.]*$/;
		var value = _returnValue(name);
		
		var isValid = validNameChars.test(value);
		if (!isValid){
			_showErrorMessage(name, validationMessages['valid_characters'], fieldName);
			return true;
		}
		
		_hideErrorMessage(name);
		
		return true;
	}
	
}

var inputValidation = new InputValidation();