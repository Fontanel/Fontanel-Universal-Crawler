<div class="wrap">
	<h2>Fontanel Universal Crawler</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'fontanel_universal_crawler_section' ); ?>
		<?php do_settings_sections( 'fontanel-universal-crawler-options' ); ?>
		<?php submit_button(); ?>
	</form>
</div>
