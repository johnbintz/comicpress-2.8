var button_images = {
  'clear-tag': {
    'off': '3a.gif', 'on': '3.gif'
  },
  'goto-tag': {
    'off': '2a.gif', 'on': '2.gif'
  }
};

var BookmarkInfo = Class.create({
  'default': {
    'permalink': false
  },
  'initialize': function() {
    this.jar = new CookieJar({
      'expires': 60 * 60 * 24 * 31,
      'path': '/'
    });
  },
  'read': function() {
    var bookmark_info = this.jar.get('bookmark-info');            

    if ((typeof(bookmark_info) != 'object') || (bookmark_info == null)) {
      bookmark_info = this.default; 
    }
    
    return bookmark_info;
  },
  'write': function(bookmark_info) {
    this.jar.put('bookmark-info', bookmark_info); 
    if (this.onWrite) { this.onWrite(bookmark_info); }
  }
});

Event.observe(window, 'load', function() {          
  var bookmark_info = new BookmarkInfo();
  var info = bookmark_info.read();
  
  var hrefs = {};
  $$('#comic-bookmark-holder a').each(function(a) {
    var name = $w(a.className).shift();
    hrefs[name] = a;
  });
  
  var set_goto_tag = function(i) {
    hrefs['goto-tag'].href = (i.permalink ? i.permalink : "#");
    [ 'goto-tag','clear-tag' ].each(function(which) {
      hrefs[which].select('img')[0].src = image_root + button_images[which][i.permalink ? "on" : "off"];
    });              
  };
  
  bookmark_info.onWrite = function(i) { set_goto_tag(i); }
  set_goto_tag(info);

  Event.observe(hrefs['tag-page'], 'click', function(e) {
    Event.stop(e);
    info.permalink = permalink;
    bookmark_info.write(info);
  });
  
  Event.observe(hrefs['clear-tag'], 'click', function(e) {
    Event.stop(e);
    info.permalink = false;
    bookmark_info.write(info);
  });
  
  Event.observe(hrefs['goto-tag'], 'click', function(e) {
    if (hrefs['goto-tag'].href == "#") { Event.stop(e); }
  });
});
