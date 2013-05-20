if $( '.fitting-video' ).length > 0
  $( '.fitting-video' ).fitVids()
  
if $( '.all-images' ).length > 0
  $( '.all-images' ).each ( i, e ) ->
    collection_class = $( e ).data 'ref'
    box = $( collection_class ).colorbox
      rel: collection_class
    console.log box
