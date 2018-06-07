window.onload=function(){
}

var timer=this.setInterval(ajax,5000)

function ajax(){
    var req=new XMLHttpRequest()
    var id=document.getElementById("idpartida").innerText;
    REQ.OPEN("GET",`ajax.php?id=${id}`,true);
    req.addEventListener("load",function(){
document.getElementById("jugador2").innerHTML=req.responseText
if(req.responseText!="Esperando..."){
timer.clearInterval();
    }  
})
    req.send(null)
}