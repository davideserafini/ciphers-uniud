<h2>login</h2>

<div id="content">
	
	{wrong_login_error}
	
	<?php echo form_open('login', array('id' => 'login')); ?>
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="email">email</label>
			</div>
			<div class="float_left width75">
				<input type="email" name="email" value="{form_email}" maxlength="255" id="email" />
				{form_email_error}
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="spacerB20">
			<div class="float_left width25">
				<label for="password">password</label>
			</div>
			<div class="float_left width75">
				<input type="password" name="password" value="{form_password}" maxlength="50" id="password" />
				{form_password_error}
			</div>
			<div class="clear"></div>
		</div>
					
		<div>
			<div class="float_left width25">&#160;</div>
			<div class="float_left width75">
				<input type="submit" name="login" value="LOGIN"/>
			</div>
			<div class="clear"></div>
		</div>
		
		<input type="hidden" name="back_to" value="{form_back_to}"/>
				  
	</form>
	
	<div class="spacerT40">
		<a href="<?php echo site_url('register') ?>">Don't have an account yet? Create one now.</a>
	</div>
</div>