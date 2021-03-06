
window.onload = function () {
    var id = document.getElementById("idpartida").innerHTML;
    var timer = this.setInterval(ajax, 1000);
    var timer2;
    var turno = null;
    var jugador = null;
    var resultado = 0;

    var celdas = document.getElementsByClassName("celda");
    for (const celda of celdas) {                            //Recorre el array de celdas
        celda.onclick = function () {

            //ahora hago una petición GET ajax para actualizar las celdas
            actualizarCelda(this.id);
        }
    }

    //Asociamos funci'on actualizar celda al evento onclick de las celdas
    function actualizarCelda(idcelda) {
        console.log(turno, jugador,resultado);
        if (turno == jugador && resultado == 0) {
            var req = new XMLHttpRequest()
            req.open("GET", `ajax.php?idcelda=${idcelda}&idpartida=${id}`, true);
            req.addEventListener("load", function () {
                console.log(req.response);
            });
            req.send(null);
        } else {
            if (resultado != 0) {
                alert("La partida ha finalizado, el resultado es " + resultado)
            } else {
                alert("No es tu turno");
            }
            // console.log(turno,resultado);
        }
    }

    function actualizarTablero() {
        var req = new XMLHttpRequest()
        req.open("GET", `ajax.php?idpart=${id}`, true);
        req.addEventListener("load", function () {
            // console.log(req.response);
            // pintarTablero(JSON.parse(req.response));
            var datos = JSON.parse(req.response);
            pintarTablero(datos);
            turno = datos.turno;
            if (datos.usr == datos.jugador1) {
                jugador = 1
            } else {
                jugador = 2
            }
            if (turno == 1) {
                document.getElementById("jugador1").setAttribute("class", "turno");
                document.getElementById("jugador2").setAttribute("class", "");

            } else if (turno == 2) {
                document.getElementById("jugador2").setAttribute("class", "turno");
                document.getElementById("jugador1").setAttribute("class", "");
            }

            resultado = comprobarGanador(JSON.parse(datos.celdas))
            if (resultado == -1) {
                alert("Empate")
                clearInterval(timer2);
                actualizarResultado(resultado, id);
            } else if (resultado != 0) {
                alert("Ha ganado " + resultado)
                clearInterval(timer2);
                // actualizarResultado(resultado,id);

                if (resultado != 0) actualizarResultado(resultado, id);
            }
            // console.log("jugador:" + datos.usr)
        })
        req.send(null)
    }
    function pintarTablero(obj) {
        var array = JSON.parse(obj.celdas);
        var celdas = document.getElementsByClassName("celda");
        for (const celda in celdas) {
            if (parseInt(celda) < celdas.length) {
                if (obj.jugador1 == array[celda]) {
                    celdas[celda].innerHTML = "x";
                    celdas[celda].setAttribute("class", "celda x")
                } else if (obj.jugador2 == array[celda]) {
                    celdas[celda].innerHTML = "o";
                    celdas[celda].setAttribute("class", "celda o")
                } else {
                    celdas[celda].innerHTML = "";
                }
            }
        }
    }
    function comprobarGanador(a) {

        //  clearInterval(timer2);
        if (a[0] == a[1] && a[1] == a[2]) return a[0];
        if (a[3] == a[4] && a[4] == a[5]) return a[3];
        if (a[6] == a[7] && a[7] == a[8]) return a[6];
        if (a[0] == a[3] && a[3] == a[6]) return a[0];
        if (a[1] == a[4] && a[4] == a[7]) return a[1];
        if (a[2] == a[5] && a[5] == a[8]) return a[2];
        if (a[0] == a[4] && a[4] == a[8]) return a[0];
        if (a[2] == a[4] && a[4] == a[6]) return a[2];

        for (const c of a) {
            if (c == 0) return 0;
            // timer2 =setInterval(actualizarTablero, 1000);
        }
        return -1
    }
    function ajax() {
        // console.log("Esperando usuario");
        var req = new XMLHttpRequest()
        req.open("GET", `ajax.php?id=${id}`, true);
        req.addEventListener("load", function () {
            // console.log("a ver si hay usuario:")
            // console.log(req.responseText);
            document.getElementById("jugador2").innerHTML = req.responseText  //no pilla el id no sé por qué
            if (req.responseText != "Esperando...") {
                clearInterval(timer);
                timer2 = setInterval(actualizarTablero, 1000);
            }
        })
        req.send(null)
    }

    function actualizarResultado(resultado, idpartida) {
        // console.log("actualiznado resultado");
        var req = new XMLHttpRequest;
        var peticion = `ajax.php?result=${resultado}&idpartida=${idpartida}`;
        req.open("GET", peticion, true);
        req.addEventListener("load", function () {
            // console.log(req.response);
        });
        req.send(null);
    };

};