(function(){
    var load_float_fb = function($){
        var defaults = {
                container_width:280,
                height:224,
                show_facepile:'true',
                tabs:'',
                href:''
            },
            cfg = $("#float_fb").data(),
            iframe = 'https://www.facebook.com/v3.0/plugins/page.php?',
            params = [],
            png = $("#float_fb").attr('src').replace(/\?.*/, '').replace(/[\w\.]+$/, "widget.png")
        ;
        var val;
        for(var k in defaults)
        {
            if(typeof cfg[k] === 'undefined')
                cfg[k] = defaults[k];
            val = cfg[k];
            params.push(k + '=' + val);
        }
        iframe += params.join('&');

        var status_ = 'hide'; // showing, hiding, show, hide
        $("body").append(
            ['<div id="float_fb_plugin" style="visibility:hidden">',
                '<img src="' + png + '" style="cursor:pointer;position:absolute;margin-left:-47px;" border=0 />',
                '<iframe scrolling="no" frameborder="0" allowTransparency="true"></iframe>',
            '</div>'].join(''));
        var w = $("#float_fb_plugin");

        var top_ = ($(window).height() - cfg.height)/2;
        if(top_ < 50)
            top_ = 50;
        var right_ = cfg.container_width * -1;

        var css = {width:cfg.container_width, height:cfg.height,
            position:'fixed',
            top:top_,
            right:right_,
            visibility:'visible',
            backgroundColor:'white',
            zIndex:2147483647
        };

        w.find('iframe').attr({width:cfg.width, height:cfg.height}).attr('src', iframe);

        w.css(css);

        w.find('img').hover(function(){
            if(status_ != 'hide')
                return;
            status_ = 'showing';
            w.animate({right: 0}, function(){ status_ = 'show'; });
        });

        w.mousemove(function(e){
            e.stopPropagation();
        });

        $("body").mousemove(function(){
            if(status_ != 'show')
                return;
            status_ = 'hiding';
            w.animate({right:right_}, function(){ status_ = 'hide';});
        });
    };

    // load jquery if needed
    if(typeof jQuery === 'undefined')
    {
        var run = false;
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = '//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js';
        script.onload = function(){
            $.noConflict();
            run = true;
            load_float_fb(jQuery);
        };
        var head = document.getElementsByTagName('head')[0];
        if(head) head.appendChild(script);

        setTimeout(function(){
            if(!run)
                load_float_fb(jQuery);
        }, 3000);
    }
    else
        load_float_fb(jQuery);

})();

