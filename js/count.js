var count = 0;
      
      jQuery(document).ready(function($) {
        let $btn = $('#show');
        $btn.on('click', function(event) {
          count++;

          if (count >= 9999) {
            let $cc = $("#canchange"),
              $txt = $cc.find('span');
            $txt.text(atob($txt.text().split('').reverse().join('')));
            $cc.attr("hidden", false);
            $(this).hide('fast', function() {
              $(this).remove();
            });
          } else {
            $(this).text('Click me now! [' + count + '] times');
          }
        });
      });