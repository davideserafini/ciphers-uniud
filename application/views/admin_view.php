<h2>admin</h2>

<div id="content">
	
	{user_not_found_error}
	
	<?php echo form_open('admin', array('id' => 'admin')); ?>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="user_email">user email</label>
			</div>
			<div class="float_left width75">
				<input type="email" name="user_email" value="{form_user_email}" maxlength="255" id="user_email" /><input type="submit" name="search" value="SEARCH" class="width20" style="position:relative;top:-2px"/>
				{form_user_email_error}
			</div>
			<div class="clear"></div>
		</div>

	</form>
	
	{user_update_form}
	
</div>