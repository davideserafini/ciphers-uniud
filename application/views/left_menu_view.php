<nav id="left_menu">	
	<div id="ciphers_menu">
		<div data-expandHeader="0" class="menu_item header_collapsed">ciphers</div>
		<div data-expandContent="0" class="menu_content content_collapsed">
		
			<div data-expandHeader="0_1" class="menu_item sub_header_collapsed">transposition</div>
			<div data-expandContent="0_1" class="sub_menu_content sub_content_collapsed">
				<a href="<?php echo site_url('ciphers/railfence'); ?>" class="menu_item">rail fence</a>
			</div>
			
			<div data-expandHeader="0_2" class="menu_item sub_header_collapsed">substitution</div>
			<div data-expandContent="0_2" class="sub_menu_content sub_content_collapsed">
				<a href="<?php echo site_url('ciphers/caesar'); ?>" class="menu_item">Caesar (monoalphabetic)</a>
				<a href="<?php echo site_url('ciphers/vigenere'); ?>" class="menu_item">Vigen&egrave;re (polyalphabetic)</a>
			</div>
			
			<div data-expandHeader="0_3" class="menu_item sub_header_collapsed">block</div>
			<div data-expandContent="0_3" class="sub_menu_content sub_content_collapsed">
				<a href="<?php echo site_url('ciphers/aes'); ?>" class="menu_item">AES</a>
			</div>
			
			<div data-expandHeader="0_4" class="menu_item sub_header_collapsed">asymmetric</div>
			<div data-expandContent="0_4" class="sub_menu_content sub_content_collapsed">
				<a href="<?php echo site_url('ciphers/rsa'); ?>" class="menu_item">RSA</a>
			</div>
		</div>
	</div>
	
	<?php
	if ($is_admin) {
	?>
		<div class="menu_item">
			<a href="<?php echo site_url('admin'); ?>">admin</a>
		</div>
	<?php
	}
	?>
	
	<div class="menu_item">
		<a href="<?php echo site_url('account'); ?>">account</a>
	</div>
	<div class="menu_item">
		<a href="<?php echo site_url('logout'); ?>">logout</a>
	</div>
	
</nav>