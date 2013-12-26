//Javascript Main file

function offMsg() {
    //document.getElementsById('msg').item('p').style.display = 'none';
    document.getElementById('msg').style.display = 'none';
}
var t = setTimeout("offMsg()", 2000);

$(document).tooltip();