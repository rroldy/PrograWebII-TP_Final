
function validacionbuscarEmpleado(f)  {
    if (f.legajo.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.legajo.focus();
        return (false);
    
    }
}


function validacionInsertEmpleado(f)  {

// Validacion de usuario

    if (f.usuario.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.usuario.focus();
        return (false);
    }else{
           if (isNaN(f.usuario.value)) {
              alert("Error:\nEste campo debe ser númerico.");
              f.usuario.focus();
              return (false);
            }else{
                if (f.usuario.value.length > 11) {
                     alert("Error:\nEste campo debe tener como maximo 11 caracteres.");
                     f.usuario.focus();
                     return (false);
                }
            }
    }

// Validacion Password

    if (f.password.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.password.focus();
        return (false);
    }else{
            if (f.usuario.value.length > 20) {
                alert("Error:\nEste campo debe tener como maximo 11 caracteres.");
                f.usuario.focus();
                return (false);                
            }
    } 

 // Validacion legajo
  
     if (f.legajo.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.legajo.focus();
        return (false);
    }else{
           if (isNaN(f.legajo.value)) {
              alert("Error:\nEste campo debe ser númerico.");
              f.legajo.focus();
              return (false);
            }else{
                if (f.legajo.value.length > 11) {
                     alert("Error:\nEste campo debe tener como maximo 11 caracteres.");
                     f.legajo.focus();
                     return (false);
                }
            }
    }      

 // Validacion DNI
  
     if (f.dni.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.dni.focus();
        return (false);
    }else{
           if (isNaN(f.dni.value)) {
              alert("Error:\nEste campo debe ser númerico.");
              f.dni.focus();
              return (false);
            }else{
                if (f.dni.value.length > 15) {
                     alert("Error:\nEste campo debe tener como maximo 15 caracteres.");
                     f.dni.focus();
                     return (false);
                }
            }
    }  

// Validacion cuil
  
    if (f.cuil.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.cuil.focus();
        return (false);
    }else{
           if (f.cuil.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               f.cuil.focus();
               return (false);
           }
    } 


// Validacion nombre
  
    if (f.nombre.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.nombre.focus();
        return (false);
    }else{
           if (f.nombre.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               f.nnombre.focus();
               return (false);
           }
    }  

// Validacion apellido
  
    if (f.apellido.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.apellido.focus();
        return (false);
    }else{
           if (f.apellido.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               f.apellido.focus();
               return (false);
           }
    }  

// Validacion direccion
  
    if (f.direccion.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.direccion.focus();
        return (false);
    }else{
           if (f.direccion.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               f.direccion.focus();
               return (false);
           }
    } 

// Validacion localidad
  
    if (f.localidad.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.localidad.focus();
        return (false);
    }else{
           if (f.localidad.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               localidad.focus();
               return (false);
           }
    } 

// Validacion provincia
  
    if (f.provincia.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.provincia.focus();
        return (false);
    }else{
           if (f.provincia.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               provincia.focus();
               return (false);
           }
    } 


// Validacion pais
  
    if (f.pais.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.pais.focus();
        return (false);
    }else{
           if (f.pais.value.length > 50) {
               alert("Error:\nEste campo debe tener como maximo 50 caracteres.");
               pais.focus();
               return (false);
           }
    } 

// Validacion cp
  
     if (f.cp.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.cp.focus();
        return (false);
    }else{
           if (isNaN(f.cp.value)) {
              alert("Error:\nEste campo debe ser númerico.");
              f.cp.focus();
              return (false);
            }else{
                if (f.cp.value.length > 11) {
                     alert("Error:\nEste campo debe tener como maximo 11 caracteres.");
                     f.dni.focus();
                     return (false);
                }
            }
    } 


// Validacion cp
  
     if (f.cp.value =="") {
        alert("Error:\nEste campo se debe completar");
        f.cp.focus();
        return (false);
    
}
}



	
