function validacioninsertService(f)  {
	if (isNaN(f.km.value)) {
		alert("Error:\nEste campo debe tener sólo números.");
        f.km.focus();
        return (false);
    }

     if (f.km.value =="") {
		alert("Error:\nEste campo se debe completar");
        f.km.focus();
        return (false);
    }


    if (f.descripcion.value.length>200) {
        alert("Error:\nEste campo debe tener como maximo 200 caracteres.");
        f.descripcion.focus();
        return (false);
    }

       if (f.descripcion.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.descripcion.focus();
        return (false);
    }
}

function validacionBorrarServicio(f){

    if (f.id_servicio.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.id_servicio.focus();
        return (false);
    }

}
