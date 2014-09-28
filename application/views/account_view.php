<h2>
	account <span class="account_user_email">{user_email}</span>
</h2>
	
<div id="content">

	{user_update_message}

	<?php echo form_open('account', array('id' => 'account')); ?>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="password">new password</label>
			</div>
			<div class="float_left width75">
				<input type="password" name="password" value="{form_password}" maxlength="50" id="password" />
				{form_password_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="confirm_password">confirm new password</label>
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
				<input type="submit" name="update_account" value="UPDATE"/>
			</div>
			<div class="clear"></div>
		</div>
			
		<input type="hidden" name="saved_first_name" value="{form_saved_first_name}"/>
		<input type="hidden" name="saved_last_name" value="{form_saved_last_name}"/>
	
	</form>
</div>