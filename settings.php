<?php	
	$options = array(
		'EVENT_TYPES' => serialize( array(
			'tumblr_text' => 1,
			'tumblr_quote' => 2,
			'tumblr_link' => 3,
			'tumblr_answer' => 4,
			'tumblr_video' => 5,
			'tumblr_audio' => 6,
			'tumblr_photo' => 7,
			'tumblr_chat' => 8,
			'jobs_stage' => 9,
			'jobs_fulltime' => 10,
			'magazine_weekvan' => 11,
			'magazine_nieuwwerk' => 12,
			'magazine_goedbezig' => 13,
			'magazine_fontanel' => 14
		) )
	);
	
	foreach( $options as $key => $value ) {
		define( 'FONTANEL_UNIVERSAL_CRAWLER_' . $key, $value );
	}
?>
