function high(obj){
    obj.style.background='pink';
}
function low(obj){
    obj.style.background='none'; 
}     
function donclick(){
<!--
<!--http://done.sarapao.com--> 
if (window.Event) 
document.captureEvents(Event.MOUSEUP); 
function nocontextmenu() 
{
event.cancelBubble = true
event.returnValue = false;
return false;
}
function norightclick(e) // This function is used by all others
{
if (window.Event) // again, IE or NAV?
{
if (e.which == 2 || e.which == 3)
return false;
}
else
if (event.button == 2 || event.button == 3)
{
event.cancelBubble = true
event.returnValue = false;
return false;
}
}
document.oncontextmenu = nocontextmenu; // for IE5+
document.onmousedown = norightclick; // for all others
//-->
}



