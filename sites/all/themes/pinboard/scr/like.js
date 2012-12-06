(function ($) {
  Drupal.behaviors.like = {
    attach: function(context) {
      $('.like-widget:not(.like-processed)', context).addClass('like-processed').each(function () {
        var widget = $(this);
        var ids = widget.attr('id').match(/^like\-([a-z]+)\-([0-9]+)\-([0-9]+)\-([0-9])$/);
        var data = {
          content_type: ids[1],
          content_id: ids[2],
          widget_id: ids[3],
          widget_mode: ids[4]
        };

        $('a.like-button', widget).click(function() {
          var token = this.getAttribute('href').match(/like\=([a-zA-Z0-9\-_]{32,64})/)[1];
          return Drupal.likeVote(widget, data, token);
        });
      });
    }
  };

  Drupal.likeVote = function(widget, data, token) {
    // Invoke JavaScript hook.
    $.event.trigger('eventBeforeRate', [data]);
    var content_id = data.content_id;

    $(".likesresult-" + content_id).html('<span class="likesresult-' + content_id + '">' + Drupal.t('请稍候...') + '</span>');

    var random = Math.floor(Math.random() * 99999);

    var q = '?q=like%2Fvote%2Fjs&widget_id=' + data.widget_id + '&content_type=' + data.content_type + '&content_id=' + data.content_id + '&widget_mode=' + data.widget_mode + '&token=' + token + '&destination=' + escape(document.location) + '&r=' + random;
    if (data.value) {
      q = q + '&value=' + data.value;
    }

    $.get(Drupal.settings.basePath + q, function(data) {
      if (data.match(/^https?\:\/\/[^\/]+\/(.*)$/)) {
        // We got a redirect.
        document.location = data;
      }
      else {
        $.event.trigger('eventAfterRate', [data]);
        $(".likesresult-" + content_id).html(data);
      }
    });

    return false;
  }
})(jQuery);