if $( '.fitting-video' ).length > 0
  $( '.fitting-video' ).fitVids()
  
if $( '.all-images' ).length > 0
  $( '.all-images' ).each ( i, e ) ->
#     $( e ).hide()
    collection_class = $( e ).data 'ref'
    parent = $( e ).parent( '.article-body' )
    prime_image = parent.find( 'figure' )
    box = $( ".#{ collection_class }" ).colorbox
      rel: collection_class
      maxWidth: '90%'
      maxHeight: '90%'
      
    prime_image.on 'click', ( e ) ->
      e.preventDefault()
      box.first().click()
