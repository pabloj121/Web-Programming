function validarValoracion(){
    var titulo, autor, anio, descripcion,   opinion, valoracion, expresion;
    titulo = document.getElementById("titulo").value;
    autor = document.getElementById("autor").value;
    anio = document.getElementById("anio").value;
    descripcion = document.getElementById("descripcion").value;
    opinion = document.getElementById("opinion").value;
    valoracion = document.getElementById("valoracion").value;

    if(titulo === ""){
        alert("El campo título está vacío. Por favor, rellénelo");
        return false;
    }
    else if(autor === ""){
        alert("El campo autor está vacío. Por favor, rellénelo");
        return false;
    }
    else if(anio === ""){
        alert("El campo año está vacío. Por favor, rellénelo");
        return false;
    }
    else if(descripcion === ""){
        alert("El campo descripción está vacío. Por favor, rellénelo");
        return false;
    }
    else if(opinion === ""){
        alert("El campo opinión está vacío. Por favor, rellénelo");
        return false;
    }
    else if(valoracion === ""){
        alert("El campo valoración está vacío. Por favor, rellénelo");
        return false;
    }

    else if(titulo.length > 30){
        alert("El campo título no puede tener más de 30 caracteres");
        return false;
    }
    else if(autor.length > 30){
        alert("El campo autor no puede tener más de 30 caracteres");
        return false;
    }
    else if(descripcion.length > 100000){
        alert("El campo descripción no puede tener más de 100000 caracteres");
        return false;
    }
    else if(opinion.length > 100000){
        alert("El campo opinion no puede tener más de 100000 caracteres");
        return false;
    }

    else if(anio < 1000 || anio > 2019 || isNaN(anio)){
        alert("El campo año debe ser un número y estar comprendido entre el año 1000 y el 2019.");
        return false;
    }

    else if(valoracion < 0 || valoracion > 10 || isNaN(valoracion)){
        alert("El campo valoración debe estar comprendido entre 0 y 10.");
        return false;
    }
}

    function validarUsuario(){
        var nombre_usu, mail, password, expresion;
        nombre_usu = document.getElementById("nombre_usu").value;
        mail = document.getElementById("mail").value;
        password = document.getElementById("password").value;
        
        expresion = /\w+@\w+\.+[a-z]/;

        if(nombre_usu === ""){
            alert("El campo Nombre de Usuario está vacío. Por favor, rellénelo.");
            return false;
        }
        else if(mail === ""){
            alert("El campo EMail está vacío. Por favor, rellénelo.");
            return false;
        }
        else if(!expresion.test(mail)){
            alert("El formato de correo introducido no es correcto. Ejemplo válido -> correo1@dominio.es");
            return false;
        }
        else if(password === ""){
            alert("El campo Contraseña está vacío. Por favor, rellénelo.");
            return false;
        }
        else if(nombre_usu.length > 15){
            alert("El campo Nombre de Usuario no puede tener más de 15 caracteres. Por favor, elija otro.");
            return false;
        }
        else if(mail.length > 30){
            alert("El campo Email no puede tener más de 30 caracteres.");
            return false;
        }
        else if(password.length > 30){
            alert("El campo contraseña no puede tener más de 30 caracteres. Por favor, elija otra.");
            return false;
        }
    }

function validarFechaMenorActual(date){
    var x=new Date();
    var fecha = date.split("/");
    x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
    var today = new Date();

    if (x >= today)
        return false;
    else
        return true;
}

function validacion(evt){
    var nombre, apellido, user, password, seccion, fecha, correo, descripcion, expresion_regular;
    
    nombre = document.getElementById("nom").value;
    apellido = document.getElementById("ape").value;
    user = document.getElementById("user").value;
    password = document.getElementById("password").value;
    seccion = document.getElementById("sect").value;
    fecha = document.getElementById("date").value;
    correo = document.getElementById("correo").value;
    descripcion = document.getElementById("descrip").value;
    
    expresion_regular = /\w+@\w+\.+[a-z]/;
   
    if (nombre === ""){
        alert("El campo nombre está vacío. Introduzca sus datos.");
        return false; evt.preventDefault();
    }
    else if (apellido === ""){
        alert("El campo apellido está vacío. Introduzca sus datos.");
        return false; evt.preventDefault();
    }
    else if (user === ""){
        alert("El campo usuario está vacío. Introduzca sus datos.");
        return false; evt.preventDefault();
    }
    else if (password === ""){
        alert("El campo password está vacío. Introduzca sus datos.");
        return false; evt.preventDefault();
    }
    else if (seccion === ""){
        alert("El campo seccion está vacío. Introduzca sus datos.");
        return false; evt.preventDefault();
    }
    else if (!validarFechaMenorActual(fecha)){   // === ""){
        alert("El campo fecha es incorrecto. Introduzca de nuevo sus datos.");
        return false; evt.preventDefault();
    }
    else if(!expresion_regular.test(correo)){ //correo === ""){
        alert("El campo email no sigue el formato requerido. Ejemplo: usuario@ugr.es");
        return false; evt.preventDefault();
    }
    else if (descripcion === ""){
        alert("El campo descricion está vacío. Introduzca sus datos.");
        return false; evt.preventDefault();
    }
    
    //preventDefault();
}


function validaLogin(){
    var usuario, contraseña;

    user = document.getElementById("user").value;
    password = document.getElementById("password").value;

    if (user ==="") {
        alert("El campo usuario está vacío.");
        return false;
    }
    else if (user.length > 20) {
        alert("El campo usuario excede el número máximo de caracteres (20).");
        return false;
    }
    else if (password ==="") {
        alert("El campo password está vacío.");
        return false;
    }
    else if (password.length > 20) {
        alert("El campo usuario excede el número máximo de caracteres (20).");
        return false;
    }
}


function validarBiblioteca(){
    var nombre, autor, seccion, descripcion;

    nombre = document.getElementById("nombre").value;
    autor = document.getElementById("autor").value;
    //seccion = document.getElementById("seccion").value;
    descripcion = document.getElementById("descripcion").value;


    //alert(descripcion);

    if (nombre === "") {
        alert("El campo nombre se encuentra vacío.");
        return false;
    }
    else if (nombre.length > 30) {
        alert("El campo autor excede el número máximo de caracteres (30).");
        return false;
    }
    else if (autor === "") {
        alert("El campo autor se encuentra vacío.");
        return false;
    }
    else if (autor.length > 80) {
        alert("El campo autor excede el número máximo de caracteres (80).");
        return false;
    }
    else if (descripcion === "") {//descripcion == "Descripción de la biblioteca" or descripcion.length == 0){
        alert("El campo descripción se encuentra vacío.");
        return false;
    }
    else if (descripcion.length > 140) {
        alert("El campo descripción excede el número máximo de caracteres (140).");
        return false;
    }
    /*else if (seccion==="") {
        alert("El campo sección se encuentra vacío.");
        return false;
    }*/
}