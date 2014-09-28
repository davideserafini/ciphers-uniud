{email_already_exists_error}
{user_update_message}
   
<?php echo form_open('admin', array('id' => 'adminUpdate')); ?>
        	
    <div class="spacerB20">
		<div class="float_left width25">
			<label for="email">new email</label>
		</div>
		<div class="float_left width75">
			<input type="email" name="email" value="{form_email}" maxlength="255" id="email" />
			{form_email_error}
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="spacerB20">
		<div class="float_left width25">
			<label for="confirm_email">confirm new email</label>
		</div>
		<div class="float_left width75">
			<input type="email" name="confirm_email" value="{form_confirm_email}" maxlength="255" id="confirm_email" />
			{form_confirm_email_error}
		</div>
		<div class="clear"></div>
	</div>
	
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
			<label for="confirm_password">confirm password</label>
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
			<label for="last_name">last name</label>
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
			<input type="submit" name="update" value="UPDATE"/>
		</div>
		<div class="clear"></div>
	</div>
                
    <input type="hidden" name="id" value="{form_id}" />
</form>
        