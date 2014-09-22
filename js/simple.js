
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
            case 'video':
                var idname = '#canvas';
                var filename = buttonid+'.php'
                break;
            default:
                var idname = '#info';
                var filename = 'info/'+buttonid+'.html'
        }

        if ($(idname).text()) {
            $(idname).fadeOut(500, function () {
                $(idname).text('');
            });

        }

        if (getCookie('previous-page') != buttonid) {
            $(idname).fadeOut(500, function () {
                $(idname).load(filename, {limit: 25}, function(){
                    $(idname).fadeIn();
                });
                setCookie('previous-page', buttonid);
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
