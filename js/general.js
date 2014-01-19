function load(content) {

    if (content == '') {
        document.getElementById('content').innerHTML = '';
        return;
    }

    if (window.XMLHttpRequest)  { // IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById('content').innerHTML = xmlhttp.responseText;
        }
    }

    xmlhttp.open('GET', 'lib/' + content + '.php', true);
    xmlhttp.send();
}

clickmenu = function(menu) {

    var getEls = document.getElementById(menu).getElementsByTagName('li');
    var getAgn = getEls;

    for (var i=0; i<getEls.length; i++) {

        getEls[i].onclick = function() {

            for (var x=0; x<getAgn.length; x++) {
                getAgn[x].className = getAgn[x].className.replace('unclick', '');
                getAgn[x].className = getAgn[x].className.replace('open', 'unclick');
            }

            if ((this.className.indexOf('unclick')) != -1) {
                this.className = this.className.replace('unclick', '');
            } else {
                this.className += 'open';
            }

        }
    }
}
