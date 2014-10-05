function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function isset() {
    //  discuss at: http://phpjs.org/functions/isset/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: FremyCompany
    // improved by: Onno Marsman
    // improved by: Rafał Kukawski
    //   example 1: isset( undefined, true);
    //   returns 1: false
    //   example 2: isset( 'Kevin van Zonneveld' );
    //   returns 2: true

    var a = arguments,
        l = a.length,
        i = 0,
        undef;

    if (l === 0) {
        throw new Error('Empty isset');
    }

    while (i !== l) {
        if (a[i] === undef || a[i] === null) {
            return false;
        }
        i++;
    }
    return true;
}

$(document).ready(function(){

    $('#close').click(function(event){
        // Show popup, hide main 'stage' image
        $('#popup').fadeOut(500);
        $('#info').text('');
        $('#stage').css('visibility', 'visible');
    });

    //settings to pass to function
    var scroller_obj = $('.scrollingtext'); // element(s) to scroll
    var velocity = 90; // 1-99
    var start_from = 'right'; // 'right' or 'left'

    //bind animation  inside the scroller element
    scroller_obj.bind('marquee', function (event, c) {

        //text to scroll
        var ob = $(this);

        //scroller width
        var sw = parseInt(ob.parent().width());

        //text width
        var tw = parseInt(ob.width());
        tw = tw - 10;

        //text left position relative to the offset parent
        var tl = parseInt(ob.position().left);

        //velocity converted to calculate duration
        var v = velocity > 0 && velocity < 100 ? (100 - velocity) * 1000 : 5000;

        //same velocity for different text's length in relation with duration
        var dr = (v * tw / sw) + v;

        //is it scrolling from right or left?
        switch (start_from) {
            case 'right':
                //is it the first time?
                if (typeof c == 'undefined') {
                    //if yes, start from the absolute right
                    ob.css({
                        left: (sw - 10)
                    });
                    sw = -tw;
                } else {
                    //else calculate destination position
                    sw = tl - (tw + sw);
                };
                break;
            default:
                if (typeof c == 'undefined') {
                    //start from the absolute left
                    ob.css({
                        left: -tw
                    });
                } else {
                    //else calculate destination position
                    sw += tl + tw;
                };
        }

        //attach animation to scroller element and start it by a trigger
        ob.animate({
            left: sw
        }, {
            duration: dr,
            easing: 'linear',
            complete: function () {
                ob.trigger('marquee');
            },
            step: function () {
                // check if scroller limits are reached
                if (start_from == 'right') {
                    if (parseInt(ob.position().left) < -parseInt(ob.width())) {
                        //we need to stop and restart animation
                        ob.stop();
                        ob.trigger('marquee');
                    };
                } else {
                    if (parseInt(ob.position().left) > parseInt(ob.parent().width())) {
                        ob.stop();
                        ob.trigger('marquee');
                    };
                };
            }
        });
    });

    scroller_obj.css('display', 'none');

    // when one of the buttons is clicked
    $('.dynamic').click(function(event){

        // set the body id to the name of the button
        var id = $(this).attr('id');
        id += '-page';
        $('body').attr('id', id);

        // setting variables
        var buttonid = $(this).attr('id');  // the button you clicked
        var bodyid = $('body').attr('id'); // the page you are on

        if (buttonid != 'video' && buttonid != 'audio') {
            // Show popup, hide main 'stage' image
            $('#popup').fadeIn(500);
            $('#stage').css('visibility', 'hidden');
        }

        switch (buttonid) {
            case 'audio':
                var idname = '#canvas';
                var filename = null;
                break;
            case 'video':
                var idname = '#canvas';
                var filename = buttonid+'.php';
                break;
            default:
                var idname = '#info';
                var filename = 'info/'+buttonid+'.html';
        }

        if ($(idname).text()) {
            scroller_obj.stop();
            scroller_obj.fadeOut(500);
            $(idname).fadeOut(500, function () {
                $(idname).text('');
                if (getCookie('previous-page') == buttonid) {
                    $('#popup').fadeOut(500);
                    $('#stage').css('visibility', 'visible');
                }
            });
        } else {
            if (buttonid == 'video') {
                scroller_obj.stop();
                scroller_obj.fadeOut(500);
            }
            if (buttonid == 'audio') {
                $.getJSON('audio.php', function(data) {
                    $(idname).html(data.html);
                    $('.scrollingtext').text(data.scrollertext);
                });
                scroller_obj.css({
                    left: (parseInt(scroller_obj.parent().width()) - 10)
                });
                scroller_obj.fadeIn(500);
                scroller_obj.trigger('marquee', ['resume']);
            } else {
                if (isset(filename)) {
                    $(idname).load(filename, {limit: 25}, function(){
                        $(idname).fadeIn();
                    });
                }
            }
            setCookie('previous-page', buttonid);
        }

        if (getCookie('previous-page') != buttonid) {
            if (buttonid == 'audio') {
                $.getJSON('audio.php', function(data) {
                    $('#canvas').html(data.html);
                    $('.scrollingtext').html(data.scrollertext);
                });
                scroller_obj.css({
                    left: (parseInt(scroller_obj.parent().width()) - 10)
                });
                scroller_obj.fadeIn(500);
                scroller_obj.trigger('marquee', ['resume']);
            } else {
                $(idname).fadeOut(500, function () {
                    $(idname).load(filename, {limit: 25}, function(){
                        $(idname).fadeIn();
                    });
                    setCookie('previous-page', buttonid);
                });
            }
        }
    });
});
