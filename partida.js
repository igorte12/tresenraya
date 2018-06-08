
window.onload = function () {
    var id = document.getElementById("idpartida").innerHTML;
    alert(id);
    var timer = this.setInterval(ajax, 1000);
  
    var timer2 = this.setInterval(actualizarTablero, 1000);


    function ajax() {
        var req = new XMLHttpRequest()
        req.open("GET", `ajax.php?id=${id}`, true);
        req.addEventListener("load", function () {
            document.getElementsByid("jugador2").innerHTML = req.responseText  //no pilla el id no sé por qué
            if (req.responseText != "Esperando...") {
                clearInterval(timer);
            }
        })
        req.send(null)
    }


    var celdas = document.getElementsByClassName("celda");
    for (const celda of celdas) {                            //Recorre el array de celdas
        celda.onclick = function () {

            //ahora hago una petición GET ajax para actualizar las celdas
            actualizarCelda(this.id);
        }

    }


    function actualizarCelda(idcelda) {
        var req = new XMLHttpRequest()
        req.open("GET", `ajax.php?idcelda=${idcelda}&idpartida=${id}`, true);   
        req.addEventListener("load", function () {
            console.log(req.response);
        })
        req.send(null)
    }

    function actualizarTablero() {
        var req = new XMLHttpRequest()
        req.open("GET", `ajax.php?idpart=${id}`, true);
        req.addEventListener("load", function () {
            console.log(req.response);
            pintarTablero(JSON.parse(req.response));
        })
        req.send(null)

    }


    function pintarTablero(array) {
        var celdas = document.getElementsByClassName("celda");
        for (const celda in celdas) {
            celdas[celda].innerHTML = array[celda];
        }

    }





}
