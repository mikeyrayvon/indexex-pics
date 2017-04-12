/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr, currentLang */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      if ($('body').hasClass('single-post')) {
        _this.Post.init();
      }
      if ($('body').hasClass('page-info')) {
        _this.Info.init();
      }
    });

  },

  onResize: function() {
    var _this = this;

    if ($('.post iframe').length) {
      Site.Post.sizeIframes();
    }
  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Post = {
  init: function() {
    var _this = this;

    if ($('.post iframe').length) {
      _this.sizeIframes();
    }
  },

  sizeIframes: function() {
    $('#documentation iframe').each(function() {
      $(this).height(($(this).width() / 16) * 9);
    });
  }
};

Site.Info = {
  init: function() {
    var _this = this;

    if ($('#donation-form').length && $('#donate').length) {
      _this.bindDonate();
    }

    _this.getWeather();
  },

  getWeather: function() {
    var _this = this;
    var key = '3c886412f00a85f921c56833793af3b9';
    var weatherUrl = 'http://api.openweathermap.org/data/2.5/weather?q=MexicoCity&lang=' + currentLang + '&appid=' + key;

    $.getJSON(weatherUrl)
    .done(function(data) {
      _this.handleWeather(data);
    })
    .fail(function() {
      console.error('No tengo tiempo...');
    });
  },

  handleWeather: function(data) {
    var description = data.weather[0].description;

    if (currentLang == 'en') {
      var weather = '<p>I see ' + description + '.</p>';
    } else {
      var weather = '<p>Veo ' + description + '.</p>';
    }

    $('#weather').html(weather);
  },

  bindDonate: function() {
    $('#donate').click(function(event) {
      event.preventDefault();

      $('#donation-form').submit()
    });
  },
};

Site.init();
