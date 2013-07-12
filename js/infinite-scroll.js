// Generated by CoffeeScript 1.6.2
var InfiniteScroll, infiniteScroll;

InfiniteScroll = (function() {
  InfiniteScroll.prototype.next_page = 1;

  InfiniteScroll.prototype.ajax_url = $('.waypoint').attr('data-ajax-url');

  InfiniteScroll.prototype.spinner_opts = {
    lines: 9,
    length: 4,
    width: 2,
    radius: 4,
    corners: 1,
    rotate: 0,
    color: '#000',
    speed: 1.3,
    trail: 25,
    shadow: false,
    hwaccel: false,
    className: 'spinner',
    zIndex: 2e9,
    top: '10',
    left: 'auto'
  };

  InfiniteScroll.prototype.waypoint_args = {
    offset: '110%',
    triggerOnce: true,
    onlyOnScroll: true
  };

  function InfiniteScroll() {
    this.el = $('#tumblr-posts-wrapper');
    this.listView = new infinity.ListView(this.el);
    this.registerNewWaypointListener();
  }

  InfiniteScroll.prototype.fetchAndProcessNewPosts = function() {
    var spinner, target,
      _this = this;

    target = $('<div></div>').addClass('spinner-holder');
    $('#tumblr-posts-wrapper').append(target);
    spinner = new Spinner(this.spinner_opts).spin();
    target.append(spinner.el);
    return $.get(this.ajax_url, {
      page: this.next_page
    }, function(data, txt, jqXHR) {
      $('#tumblr-posts-wrapper').append(data);
      _this.registerNewWaypointListener();
      _this.next_page++;
      $('#blog').fitVids();
      spinner.stop();
      return target.remove();
    });
  };

  InfiniteScroll.prototype.registerNewWaypointListener = function(element) {
    var _this = this;

    if (element == null) {
      element = $('.waypoint');
    }
    return element.waypoint(function(el, dir) {
      return _this.fetchAndProcessNewPosts();
    }, this.waypoint_args);
  };

  InfiniteScroll.prototype.createNewWaypoint = function() {
    var new_waypoint;

    new_waypoint = $('<div></div>').addClass('waypoint');
    $('#tumblr-posts-wrapper').after(new_waypoint);
    return this.registerNewWaypointListener(new_waypoint);
  };

  return InfiniteScroll;

})();

if ($('.waypoint').length > 0) {
  infiniteScroll = new InfiniteScroll;
}