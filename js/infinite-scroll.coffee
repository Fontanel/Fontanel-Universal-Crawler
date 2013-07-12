class InfiniteScroll
	next_page: 1
	
	ajax_url: $( '.waypoint' ).attr( 'data-ajax-url' )
	
	spinner_opts:
		lines: 9 # The number of lines to draw
		length: 4 # The length of each line
		width: 2 # The line thickness
		radius: 4 # The radius of the inner circle
		corners: 1 # Corner roundness (0..1)
		rotate: 0 # The rotation offset
		color: '#000' # #rgb or #rrggbb
		speed: 1.3 # Rounds per second
		trail: 25 # Afterglow percentage
		shadow: false # Whether to render a shadow
		hwaccel: false # Whether to use hardware acceleration
		className: 'spinner' # The CSS class to assign to the spinner
		zIndex: 2e9 # The z-index (defaults to 2000000000)
		top: '10' # Top position relative to parent in px
		left: 'auto' # Left position relative to parent in px
	
	waypoint_args:
		offset: '110%'
		triggerOnce: true
		onlyOnScroll: true
	
	constructor: ->
		@el = $('#tumblr-posts-wrapper')
		@listView = new infinity.ListView @el
		@registerNewWaypointListener()
	
	fetchAndProcessNewPosts: ->
		target = $('<div></div>').addClass('spinner-holder')
		$( '#tumblr-posts-wrapper' ).append( target );
		spinner = new Spinner( @spinner_opts ).spin()
		target.append spinner.el
		$.get @ajax_url
			,{ page: @next_page }
			,( data, txt, jqXHR ) =>
				$( '#tumblr-posts-wrapper' ).append( data )
				@registerNewWaypointListener()
				@next_page++
				$('#blog').fitVids() # Update the video width
				spinner.stop()
				target.remove()

	registerNewWaypointListener: ( element = $('.waypoint') ) ->
		element.waypoint ( el, dir ) =>
			@fetchAndProcessNewPosts()
		, @waypoint_args
	
	createNewWaypoint: ->
		new_waypoint = $('<div></div>').addClass 'waypoint'
		$( '#tumblr-posts-wrapper' ).after new_waypoint
		@registerNewWaypointListener new_waypoint

if $( '.waypoint' ).length > 0
	infiniteScroll = new InfiniteScroll
