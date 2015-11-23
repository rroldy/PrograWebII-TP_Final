
function validacionBorrarVehiculo(f)  {
	if (isNaN(f.idtransporte.value)) {
		alert("Error:\nEste campo debe tener sólo números.");
        f.idtransporte.focus();
        return (false);
    }

     if (f.idtransporte.value =="") {
		alert("Error:\nEste campo se debe completar");
        f.idtransporte.focus();
        return (false);
    }
}


function validacionEditarVehiculo(f)  {
	
    if (f.idtransporte.value =="") {
		alert("Error:\nEste campo se debe completar");
        f.idtransporte.focus();
        return (false);
    }


	if (isNaN(f.idtransporte.value)) {
		alert("Error:\nEste campo debe tener sólo números.");
        f.idtransporte.focus();
        return (false);
    }

    if (f.patente.value.length!=6) {
		alert("Error:\nEste campo debe tener 6 caracteres.");
        f.patente.focus();
        return (false);
    }


     if (f.nrochasis.value.length > 50) {
		alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
        f.modelo.focus();
        return (false);
    }

     if (f.nrochasis.value == "") {
		alert("Error:\nEste campo se debe completar");
        f.modelo.focus();
        return (false);
    }

    if(f.tipovehiculo.value == "2"){
       if (f.nro_motor.value != "") {
			alert("Error:\nLos acoplados no poseen Nro. de Motor");
        	f.nro_motor.focus();
        	return (false);
        }
    }else{
    	if (f.nro_motor.value == "") {
			alert("Error:\nEste campo se debe completar");
        	f.nro_motor.focus();
        	return (false);
        }
    }


    if (f.marca.value.length > 50) {
		alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
        f.marca.focus();
        return (false);
    }

    if (f.marca.value =="" ) {
		alert("Error:\n Este campo se debe completar");
        f.marca.focus();
        return (false);
    }

    if (f.modelo.value.length > 50) {
		alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
        f.modelo.focus();
        return (false);
    }

     if (f.modelo.value == "") {
		alert("Error:\nEste campo se debe completar");
        f.modelo.focus();
        return (false);
    }



}




	
