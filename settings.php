<?php	
	$options = array(
		'EVENT_TYPES' => serialize( array(
			'TumblrText' => 1,
			'TumblrQuote' => 2,
			'TumblrLink' => 3,
			'TumblrAnswer' => 4,
			'TumblrVideo' => 5,
			'TumblrAudio' => 6,
			'TumblrPhoto' => 7,
			'TumblrChat' => 8,
			'JobsStage' => 9,
			'JobsFulltime' => 10,
			'MagazineWeekvan' => 11,
			'MagazineNieuwwerk' => 12,
			'MagazineGoedbezig' => 13,
			'MagazineFontanel' => 14
		) )
	);
	
	foreach( $options as $key => $value ) {
		define( 'FONTANEL_UNIVERSAL_CRAWLER_' . $key, $value );
	}
?>
