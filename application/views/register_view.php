<h2>registration</h2>

<div id="content">
	
	{user_already_registered_error}
	
	<?php echo form_open('register', array('id' => 'register')); ?>
	
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="email">email <span class="required">(required)</span></label>
			</div>
			<div class="float_left width75">
				<input type="email" name="email" value="{form_email}" maxlength="255" id="email" />
				{form_email_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="confirm_email">confirm email <span class="required">(required)</span></label>
			</div>
			<div class="float_left width75">
				<input type="email" name="confirm_email" value="{form_confirm_email}" maxlength="255" id="confirm_email" />
				{form_confirm_email_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="password">password <span class="required">(required)</span></label>
			</div>
			<div class="float_left width75">
				<input type="password" name="password" value="{form_password}" maxlength="50" id="password" />
				{form_password_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="confirm_password">confirm password <span class="required">(required)</span></label>
			</div>
			<div class="float_left width75">
				<input type="password" name="confirm_password" value="{form_confirm_password}" maxlength="50" id="confirm_password" />
				{form_confirm_password_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="first_name">first name</label>
			</div>
			<div class="float_left width75">
				<input type="text" name="first_name" value="{form_first_name}" maxlength="50" id="first_name" />
				{form_first_name_error}
			</div>
			<div class="clear"></div>
		</div>
	
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="first_name">last name</label>
			</div>
			<div class="float_left width75">
				<input type="text" name="last_name" value="{form_last_name}" maxlength="50" id="last_name" />
				{form_last_name_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">&#160;</div>
			<div class="float_left width75">
				<input type="submit" name="login" value="REGISTER NOW"/>
			</div>
			<div class="clear"></div>
		</div>
		
	</form>
	
	<div>
		<a href="login">Already have an account? Log in.</a>
	</div>
</div>