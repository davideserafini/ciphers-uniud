<h2>hello!</h2>
<div id="content">
	{registration_success}
	
	<p>
		This website is the project for Security in Multimedia Applications, Uniud 2014, and I'm <a href="mailto:serafini.davide.1@spes.uniud.it">Davide Serafini</a> (90035)<br/><br/>
		
		You can try 5 different ciphers here, both encrypt and decrypt
		<ul>
			<li><a href="<?php echo site_url('ciphers/railfence'); ?>">rail fence</a></li>
			<li><a href="<?php echo site_url('ciphers/caesar'); ?>">caesar</a></li>
			<li><a href="<?php echo site_url('ciphers/vigenere'); ?>">vigen&egrave;re</a></li>
			<li><a href="<?php echo site_url('ciphers/aes'); ?>">AES</a></li>
			<li><a href="<?php echo site_url('ciphers/rsa'); ?>">RSA</a></li>
		</ul>
	</p>
	<p>
		The site has been built using <a href="https://ellislab.com/codeigniter">CodeIgniter</a>, <a href="http://jquery.com/">jQuery</a> and 
		<a href="http://phpseclib.sourceforge.net/">phpseclib</a> for the PHP implementation of AES and RSA.
		
	</p>
</div>