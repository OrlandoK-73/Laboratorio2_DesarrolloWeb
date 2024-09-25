window.addEventListener('load',function(){
    ocultarformulario();

    //console.log("si carga");
});

var div=document.getElementById("form");

function mostrarformulario(){
    div.style.display="block";
}

function ocultarformulario(){
    div.style.display="none";
}


