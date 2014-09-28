<article>
	<h2>RSA</h2>
	<div id="content">
		<div id="inner_content">
			RSA (from the initials of its creators <b>R</b>ivest <b>S</b>hamir <b>A</b>dleman) is a widely used public-key 
			cryptosystems created in 1977. It's an asymmetric cipher, meaning that 2 keys are used:
			<ul>
				<li><b>public</b> key used for <b>encryption</b></li>
				<li><b>private</b> key used for <b>decryption</b></li>
			</ul>
		
			<p>
				RSA is built of two main algorithms, one to create the keys and one for the encryption/decryption process.
			</p>
				
			<h4>key generation</h4>
			<p>
				<ul>
					<li>choose 2 prime number <i>p</i> and <i>q</i></li>
					<li>calculate <i>n = pq</i></li>
					<li>choose <i>e</i> coprime and smaller than <i>(p-1)(q-1)</i></li>
					<li>calculate <i>d</i>, so that <i>de = 1 mod (p-1)(q-1)</i></li>
				</ul>
				(n, e) is the public key.
				<br/>
				(n, d) is the private key.
				<br/><br/>
				The factorization of n in p and q is currently a very complex mathematical problem, which intrinsically gives the 
				needed security to the RSA keys.
			</p>
			
			<h4>crypt and decrypt</h4>
			<p>
				Given a message <i>m</i>, a public key <i>(n, e)</i> and a private key <i>(n, d)</i>, the message is crypted 
				doing <i>c = m<sup>e</sup> mod n</i>, and is decrypted with <i>m = c<sup>d</sup> mod n</i>
			</p>
		
			<p>
				<b>Plaintext</b>: please crypt and send this message
				<br/>
				<b>Public Key</b>: 
				<pre>
-----BEGIN PUBLIC KEY-----
MFswDQYJKoZIhvcNAQEBBQADSgAwRwJAbZwcSzcy0umep3cLgQUJchq6kdVQUdqt
or0TYndxwkZ6WAsCNtI9kxdVhvVwGFI5I/CQCOXP3Vf/2bpMhvQy/QIDAQAB
-----END PUBLIC KEY-----
				</pre>
				<br/>
				<b>Encrypted text (base64 encoded)</b>: QTchIAN6tCm4VTLO87mxp/l55oW963GQVUJi+BnrmJ9weh9wqLfomawO9z5L+17bOfvEVc7cCmm4+iPDXsiYZWINzPjtE6adDceA+w221/VyubbpWOPUtsMBb05VzTDPGOEBVZ1DPFjSEnZ+iCMKvLZELzBFziOvudKKG5Ljk8M=
			</p>
			
			<h3>try it out!</h3>
			<p>
				You can try now the RSA cipher.
			</p>
			
			<?php echo form_open($this->uri->uri_string() . '#rsa', array('id' => 'rsa', 'class' => 'cipher_form')); ?>
				{form_error}
				<div class="float_left width30">
					<label for="plaintext" class="left">plaintext</label>
					<textarea name="plaintext" id="plaintext">{form_plaintext}</textarea>
				</div>
				<div class="float_left width40 center">
					<div class="spacerB15">
						<label for="key" class="center">key</label>
						<textarea name="key" id="key" class="width75">{form_key}</textarea>
					</div>				
				</div>
				<div class="float_left width30 left">
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