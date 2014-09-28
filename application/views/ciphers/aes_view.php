<article>
	<h2>AES</h2>
	<div id="content">
		<div id="inner_content">
			AES (<b>A</b>dvanced <b>E</b>ncryption <b>S</b>tandard) is a block cipher based on the Rijndael cipher adopted by the 
			U.S. government in 2001 and now widely used, replacing DES.
			<br/><br/>
			It uses a block size of 128bits, and keys of 128, 192 or 256 bits. The same key is used for encrypting and decrypting (symmetric key 
			algorithm).
				
			<h4>crypt and decrypt</h4>
			<p>
				<ul>
					<li>Input is organized in a 4x4 bytes grid, that undergoes transformations for each phase</li>
					<li>Key is expanded to an array of 44 32-bits-words <i>w[i]</i></li>
					<li>For each phase 4 distinct words <i>w[i] = w[0,3],..., w[40,43]</i> are used as keys, each of 128 bits</li>
					<li>4 different steps for each phase, 1 permutation and 3 substitutions:</li>
					<ul>
						<li>each byte is transformed by a S-Box (16x16)</li>
						<li>rows of the grid are shifted</li>
						<li>each column of the grid is transformed by a procedure similar to a S-Box</li>
						<li>a XOR is performed with for each byte with the sub-key</li>
					</ul>
				</ul>
			</p>
		
			<p>
				<b>Plaintext</b>: please crypt and send this message
				<br/>
				<b>Key</b>: uniud2014
				<br/>
				<b>Encryption mode</b>: CBC
				<br/>
				<b>Encrypted text (base64 encoded)</b>: Gg2WW1ZvXk+OSzvp/xzUBhjKkniAfwRR1vQJStSSiRa5c1WSRohdTjOgQwxclmRJ
			</p>
			
			<h3>try it out!</h3>
			<p>
				Here you can try the AES cipher.
			</p>
			
			<?php echo form_open($this->uri->uri_string() . '#aes', array('id' => 'aes', 'class' => 'cipher_form')); ?>
				{form_error}
				<div class="float_left width35">
					<label for="plaintext" class="left">plaintext</label>
					<textarea name="plaintext" id="plaintext">{form_plaintext}</textarea>
				</div>
				<div class="float_left width30 center">
					<div class="spacerB15">
						<label for="key" class="center">key</label>
						<input name="key" id="key" type="text" class="width75" value="{form_key}"/>
					</div>
					
					<div>
						<label for="enc_mode" class="center">encryption mode</label>
						<select name="enc_mode" id="enc_mode" class="width75">
							<option value="ecb" {form_enc_mode_ecb_selected}>ECB</option>
							<option value="cbc" {form_enc_mode_cbc_selected}>CBC</option>
							<option value="ctr" {form_enc_mode_ctr_selected}>CTR</option>
						</select>
					</div>						
				</div>
				<div class="float_left width35 left">
					<label for="encrypted_text" class="left">encrypted text</label>
					<textarea name="encrypted_text" id="encrypted_text">{form_encrypted_text}</textarea>
				</div>
				<div class="clear"></div>
				
				<div class="spacerT40">
					<div class="float_left width50 right">
						<input type="submit" name="crypt" value="CRYPT -&gt;" class="width50" id="crypt" />
					</div>
					<div class="float_left width50">
						<input type="submit" name="decrypt" value="&lt- DECRYPT" class="width50" id="decrypt" />
					</div>
					<div class="clear"></div>
				</div>
			</form>
		</div>
	</div>
</article>