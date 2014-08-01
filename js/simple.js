
function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

$(document).ready(function(){

    $('.dynamic').click(function(event){

        var id = $(this).attr('id');
        id += '-page';
        $('body').attr('id', id);

        var buttonid = $(this).attr('id');
        var bodyid = $('body').attr('id');

        if (buttonid == 'video') {
            $('#info').fadeOut(500, function () {
                $('#info').text('');
                $('#info').fadeIn();
            });
        }

        if (getCookie('previous-page') == bodyid) {
            if ($('#info').text()) {
                $('#info').fadeOut(500, function () {
                    $( '#info' ).text('');
                    $('#info').fadeIn();
                });
            } else {
                if (!(bodyid == 'video-page' && $('#canvas').text())) {
                    var $classname = (this.className == 'dynamic media') ? '#canvas' : '#info';
                    $($classname).fadeOut(500, function () {
                        $($classname).load(event.target.id+'.php', {limit: 25}, function(){
                                $($classname).fadeIn();
                        });
                        setCookie('previous-page', bodyid);
                    });
                }
                if (bodyid == 'video-page' && $('#canvas').text()) {
                    var $classname = (this.className == 'dynamic media') ? '#canvas' : '#info';
                    $($classname).fadeOut(500, function () {
                        var myVideo=document.getElementById("vid");
                        myVideo.pause();
                        $('#canvas').text('');
                    });
                }
            }
        } else {
            var $classname = (this.className == 'dynamic media') ? '#canvas' : '#info';
            $($classname).fadeOut(500, function () {
                $($classname).load('info/'+event.target.id+'.html', {limit: 25}, function(){
                    $($classname).fadeIn();
                });
                setCookie('previous-page', bodyid);
            });
        }
    });


    // Scroller Testing Code /////////////////////////////

    //this is the useful function to scroll a text inside an element...
    function startScrolling(scroller_obj, velocity, start_from) {
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
        }).trigger('marquee');
        //pause scrolling animation on mouse over
        scroller_obj.mouseover(function () {
            $(this).stop();
        });
        //resume scrolling animation on mouse out
        scroller_obj.mouseout(function () {
            $(this).trigger('marquee', ['resume']);
        });
    };

    //the main app starts here...

    //settings to pass to function
    var scroller = $('.scrollingtext'); // element(s) to scroll
    var scrolling_velocity = 80; // 1-99
    var scrolling_from = 'right'; // 'right' or 'left'

    //call the function and start to scroll..
    startScrolling(scroller, scrolling_velocity, scrolling_from);

});
