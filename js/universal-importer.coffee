if $( '#banners' ).length > 0
  $( '#articles' ).waypoint ( dir ) ->
    if dir is 'up'
      $( '#banners' ).removeClass 'sticky'
    else
      $( '#banners' ).addClass 'sticky'
  ,
    offset: 30

if $( '.fitting-video' ).length > 0
  $( '.fitting-video' ).fitVids()
  
if $( '.all-images' ).length > 0
  $( '.all-images' ).each ( i, e ) ->
    collection_class = $( e ).data 'ref'
    parent = $( e ).parent( '.article-body' )
    prime_image = parent.find( 'figure' )
    box = $( ".#{ collection_class }" ).colorbox
      rel: collection_class
      maxWidth: '90%'
      maxHeight: '90%'
      next: ''
      previous: ''
      close: ''
      onOpen: ->
        $( '#cboxNext' ).addClass 'icon-arrow-right'
        $( '#cboxPrevious' ).addClass 'icon-arrow-left'
        $( '#cboxClose' ).addClass 'icon-exit'
        $( 'body' ).css
          overflow: 'hidden'
      onClosed: ->
        $( 'body' ).css
          overflow: 'auto'
        
      
    prime_image.on 'click', ( e ) ->
      e.preventDefault()
      box.first().click()
