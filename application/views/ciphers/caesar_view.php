<article>
	<h2>caesar</h2>
	<div id="content">
		<div id="inner_content">
			A Caesar cipher is a famous substitution cipher, named after Julius Caesar, who used it in his correspondence.
		
			<h4>crypt and decrypt</h4>
			<p>
				Each letter of the plaintext is "shifted" by a fixed number of places in the alphabet.
				For example with a shift of 3, A is replaced by D, B is replaced by E and so on.
				<br/>
				In the same way, but shifting backwards, the text is decrypted.
				<br/><br/>
				So the shift is the key.
			</p>
		
			<p>
				<b>Plaintext</b>: please crypt and send this message
				<br/>
				<b>Key</b>: 3
			</p>
		
			<pre> 
abcdefghijklmnopqrstuvwxyz
defghijklmnopqrstuvwxyzabc
			</pre>
			
			<p>
				<b>Encrypted text</b>: sohdvhfubswdqgvhqgwklvphvvdjh
			</p>
			
			<p class="spacerT40">
				Caesar ciphers are used as steps in more complex ciphers like the <a href="<?php echo site_url('ciphers/vigenere'); ?>">Vigen&egrave;re cipher</a>.
				Another modern application is called ROT13: the key is 13 and this allows the use of the same algorithm both to encode and decode 
				(26 letters in the english alphabet, 13 x 2 = 26, so the ROT13 function is also its inverse), and it is used to encode to hide spoilers, 
				solutions, offensive expression in online forums.
			</p>
			
			<h3>try it out!</h3>
			<p>
				You can try now the Caesar cipher using any key.
			</p>
			
			<?php echo form_open($this->uri->uri_string() . '#caesar', array('id' => 'caesar', 'class' => 'cipher_form')); ?>
				{form_error}
				<div class="float_left width35">
					<label class="left" for="plaintext">plaintext</label>
					<textarea name="plaintext" id="plaintext">{form_plaintext}</textarea>
				</div>
				<div class="float_left width30 center">
					<div>
						<label class="center" for="key">key</label>
						<select name="key" id="key" class="width50">
							<option value="1" {form_key_1_selected}>1</option>
							<option value="2" {form_key_2_selected}>2</option>
							<option value="3" {form_key_3_selected}>3</option>
							<option value="4" {form_key_4_selected}>4</option>
							<option value="5" {form_key_5_selected}>5</option>
							<option value="6" {form_key_6_selected}>6</option>
							<option value="7" {form_key_7_selected}>7</option>
							<option value="8" {form_key_8_selected}>8</option>
							<option value="9" {form_key_9_selected}>9</option>
							<option value="10" {form_key_10_selected}>10</option>
							<option value="11" {form_key_11_selected}>11</option>
							<option value="12" {form_key_12_selected}>12</option>
							<option value="13" {form_key_13_selected}>13</option>
							<option value="14" {form_key_14_selected}>14</option>
							<option value="15" {form_key_15_selected}>15</option>
							<option value="16" {form_key_16_selected}>16</option>
							<option value="17" {form_key_17_selected}>17</option>
							<option value="18" {form_key_18_selected}>18</option>
							<option value="19" {form_key_19_selected}>19</option>
							<option value="20" {form_key_20_selected}>20</option>
							<option value="21" {form_key_21_selected}>21</option>
							<option value="22" {form_key_22_selected}>22</option>
							<option value="23" {form_key_23_selected}>23</option>
							<option value="24" {form_key_24_selected}>24</option>
							<option value="25" {form_key_25_selected}>25</option>
							<option value="26" {form_key_26_selected}>26</option>
						</select>
					</div>					
				</div>
				<div class="float_left width35 left">
					<label class="left" for="encrypted_text">encrypted text</label>
					<textarea name="encrypted_text" id="encrypted_text">{form_encrypted_text}</textarea>
				</div>
				<div class="clear"></div>
				
				<div class="spacerT20">
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