<article>
	<h2>rail fence</h2>
	<div id="content">
		<div id="inner_content">
			Rail Fence is a simple transposition cipher, it offers no security and can be easily broken.
		
			<p>
				The plaintext is written in a table of <b>"key"</b> number of rows, going downwards diagonally to the last row, then 
				upwards diagonally to the first row, repeating the steps until the message is completely written out.
				<br/>
				The message is then sent by rows.
			</p>
		
			<p>
				<b>Plaintext</b>: please crypt and send this message
				<br/>
				<b>Key</b>: 5
			</p>
		
			<pre> 
p . . . . . . . y . . . . . . . n . . . . . . . s . . . .
. l . . . . . r . p . . . . . e . d . . . . . e . s . . .
. . e . . . c . . . t . . . s . . . t . . . m . . . a . .
. . . a . e . . . . . a . d . . . . . h . s . . . . . g .
. . . . s . . . . . . . n . . . . . . . i . . . . . . . e
			</pre>
			
			<p>
				<b>Encrypted text</b>: pynslrpedesectstmaaeadhsgsnie
			</p>
			
			<p class="spacerT40">
				Rail Fence cipher also exists in a different version in which the text is "<i>written along the rows and read down the columns</i>" 
				without the diagonal shift.
			</p>
			
			<pre>
please
crypta
ndsend
thisme
ssage
			</pre>
		
			<p><b>Encrypted text</b>: pcntslrdhseysiaapesgstnmeeade</p>
			
			<h3>try it out!</h3>
			<p>
				Now you can easily try the first version of the cipher here, simply write the plaintext, choose a key and hit "crypt". Decrypt is 
				available as well.
			</p>
			
			<?php echo form_open($this->uri->uri_string() . '#rail_fence', array('id' => 'rail_fence', 'class' => 'cipher_form')); ?>
				{form_error}
				<div class="float_left width35">
					<label class="left" for="plaintext">plaintext</label>
					<textarea name="plaintext" id="plaintext">{form_plaintext}</textarea>
				</div>
				<div class="float_left width30 center">
					<div>
						<label class="center" for="key">key</label>
						<input type="number" min="2" name="key" id="key" value="{form_key}"/>
					</div>					
				</div>
				<div class="float_left width35 left">
					<label class="left" for="encrypted_text">encrypted text</label>
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