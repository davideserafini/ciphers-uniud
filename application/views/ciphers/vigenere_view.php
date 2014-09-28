<article>
	<h2>vigenère</h2>
	<div id="content">
		<div id="inner_content">
			The Vigenère cipher is a polyalphabetic substitution cipher, that for centuries was considered "the unbreakable cipher", until 
			it was broken in the XIX century by Babbage e Kasiski
			
			<h4>crypt and decrypt</h4>
			<p>
				The key is repeated until it equals the length of the plaintext.
				<br/>
				The text is now encoded using this table.
				<br/>
				<pre>
    A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
    ---------------------------------------------------
A | A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
B | B C D E F G H I J K L M N O P Q R S T U V W X Y Z A
C | C D E F G H I J K L M N O P Q R S T U V W X Y Z A B
D | D E F G H I J K L M N O P Q R S T U V W X Y Z A B C
E | E F G H I J K L M N O P Q R S T U V W X Y Z A B C D
F | F G H I J K L M N O P Q R S T U V W X Y Z A B C D E
G | G H I J K L M N O P Q R S T U V W X Y Z A B C D E F
H | H I J K L M N O P Q R S T U V W X Y Z A B C D E F G
I | I J K L M N O P Q R S T U V W X Y Z A B C D E F G H
J | J K L M N O P Q R S T U V W X Y Z A B C D E F G H I
K | K L M N O P Q R S T U V W X Y Z A B C D E F G H I J
L | L M N O P Q R S T U V W X Y Z A B C D E F G H I J K
M | M N O P Q R S T U V W X Y Z A B C D E F G H I J K L
N | N O P Q R S T U V W X Y Z A B C D E F G H I J K L M
O | O P Q R S T U V W X Y Z A B C D E F G H I J K L M N
P | P Q R S T U V W X Y Z A B C D E F G H I J K L M N O
Q | Q R S T U V W X Y Z A B C D E F G H I J K L M N O P
R | R S T U V W X Y Z A B C D E F G H I J K L M N O P Q
S | S T U V W X Y Z A B C D E F G H I J K L M N O P Q R
T | T U V W X Y Z A B C D E F G H I J K L M N O P Q R S
U | U V W X Y Z A B C D E F G H I J K L M N O P Q R S T
V | V W X Y Z A B C D E F G H I J K L M N O P Q R S T U
W | W X Y Z A B C D E F G H I J K L M N O P Q R S T U V
X | X Y Z A B C D E F G H I J K L M N O P Q R S T U V W
Y | Y Z A B C D E F G H I J K L M N O P Q R S T U V W X
Z | Z A B C D E F G H I J K L M N O P Q R S T U V W X Y
				</pre>
				Each letter of the plaintext is substituted by the letter located at (current letter; corresponding key letter)
			</p>
			
			<p class="spacerT20">Let's see an example!</p>
		
			<p>
				<b>Plaintext</b>: please crypt and send this message
				<br/>
				<b>Key</b>: vigenere
			</p>
		
			<pre>
vigenerevigenerevigenerevigen
pleasecryptandsendthismessage
			</pre>
			
			<p>
				<b>Encrypted text</b>: ktkefitvtxzeahjiilzlvwdinagkr
			</p>

			
			<h3>try it out!</h3>
			
			<p>
				Here you can try the Vigen&egrave;re cipher.
			</p>
			
			<?php echo form_open($this->uri->uri_string() . '#vigenere', array('id' => 'vigenere', 'class' => 'cipher_form')); ?>
				{form_error}
				<div class="float_left width35">
					<label for="plaintext" class="left">plaintext</label>
					<textarea name="plaintext" id="plaintext">{form_plaintext}</textarea>
				</div>
				<div class="float_left width30 center">
					<div>
						<label for="key" class="center">key</label>
						<input name="key" id="key" type="text" value="{form_key}" class="width75"/>
					</div>					
				</div>
				<div class="float_left width35 left">
					<label for="encrypted_text" class="left">encoded text</label>
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