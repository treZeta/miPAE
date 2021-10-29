function validarCamposEstudiante() {

    var camposErroneos = [];
    var nombreGrupo = document.getElementById('nombreGrupo');
    var grados = document.getElementsByName("gradosCursados[]");
    var error = false;

    var labels = document.getElementsByClassName("error");
    while(labels.length > 0){
        labels[0].parentNode.removeChild(labels[0]);
    }
    var shakeDivs = document.getElementsByClassName("shake");
    while(shakeDivs.length > 0){
        shakeDivs[0].classList.toggle("shake");
        shakeDivs = document.getElementsByClassName("shake");
    }


    if(nombres.value.trim().length == ""){
        crearLabelDeError(nombreGrupo, "El grupo debe tener un nombre");
        error = true;
    } else if(nombres.value.length < 4 || nombres.value.length > 30){
        crearLabelDeError(nombres, "Los nombres deben contener entre 4 y 30 caracteres");
        error = true;
    }
    
    if(apellidos.value.length == ""){
        crearLabelDeError(apellidos, "El estudiante debe tener un apellido");
        error = true;
    } else if(apellidos.value.length < 5 || apellidos.value.length > 30){
        crearLabelDeError(apellidos, "Los apellidos deben contener entre 5 y 30 caracteres");
        error = true;
    }
    
    if(idEstudiante.value.length == ""){
        crearLabelDeError(idEstudiante, "El estudiante debe tener un ID");
        error = true;
        camposErroneos.push("");
    } else if(idEstudiante.value.length < 5 || idEstudiante.value.length > 30){
        crearLabelDeError(idEstudiante, "El id debe contener entre 5 y 30 caracteres");
        error = true;
    }
    
    if(!programaAlimentario[0].checked && !programaAlimentario[1].checked){
        crearLabelDeError(programaAlimentario[0].parentNode, "El estudiante debe tener un programa alimentario");
        error = true;
    }
    
    if(!genero[0].checked && !genero[1].checked){
        crearLabelDeError(genero[0].parentNode, "El estudiante debe tener un genero");
        error = true;
    }
    
    if(grupo.value == ""){
        crearLabelDeError(grupo, "El estudiante debe tener un grupo");
        error = true;
    }
    
    if(huella1.value.length == ""){
        crearLabelDeError(document.getElementById("DPFPEnrollmentUserRegn"), "No se ingresó la primera huella");
        error = true;
    }
    
    if(huella2.value.length == ""){
        crearLabelDeError(document.getElementById("DPFPEnrollmentUserRegn"), "No se ingresó la segunda huella");
        error = true;
    }
    
    if(error = false){
        document.querySelector("form").submit();
    }

    

}

function crearLabelDeError(input, texto){
    label = document.createElement("LABEL");
    label.classList.add("error");
    label.setAttribute("for", input.getAttribute("id"));
    input.parentNode.classList.toggle("shake");
    label.innerHTML = "<strong>" + texto + "</strong";
    input.parentNode.appendChild(label);
    setTimeout(function(){input.parentNode.classList.toggle("shake");}, 500);
}