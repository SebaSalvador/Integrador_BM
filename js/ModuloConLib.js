$(document).ready(function () {

    $(document).on('change', '.selectEstCard', function() {
        let jsonString = $(this).val();
        console.log('selected card: '+jsonString);
        let obj = JSON.parse(jsonString);
        actualizarEstado(obj.idObs, obj.idLib, obj.estado);
    });

    //Cargar datos datos de usuario
    userId = sessionStorage.getItem("id_user");
    //tipoId = sessionStorage.getItem("id_tipo");
    console.log(userId);
    
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'getUserData', userId},
        type: 'GET',
        success: function (response) {
            if(!response.error) {
                console.log(response);
                let obj = JSON.parse(response);
                let userData = obj.nomApe + " - " + obj.rango;
                $('#user-data').html(userData);
            }
        }
    });
    
    getObservacion();
    sessionStorage.setItem('boton-block', true); //problemita
    
    //Detectar cambios en el input number
    $('#id-libro').change(function() {
        existeLibro();
        
        
    });

    let date= new Date();
    let año = date.getFullYear();
    let mes = ('0' + (date.getMonth() + 1)).slice(-2);
    let dia = ('0' + date.getDate()).slice(-2);
    let fechaActual = ''+año+'-'+mes+'-'+dia;
    $('#fecha-obs').val(fechaActual);

    //boton agregar obs
    $('#boton-agregar').click(function() {
        
        let strbool = sessionStorage.getItem('boton-block');
        //console.log(typeof bool);
        let bool;
        if (strbool === 'true')
            bool = true;
        else
            bool = false;

        if (!bool) {
            let fecAct = fechaActual;
            let idLibro = $('#id-libro').val();
            let razon = $('#select-razon').val();
            $.ajax({
                url: "controlador/Control_ConLib.php",
                data: {action: 'agregarObs', fecAct, idLibro, razon},
                method: 'POST',
                success: function (response) {
                    if (!response.error) {
                        console.log('agregar obs: '+response);
                        $('#form-modal').modal('hide');
                        getObservacion();
                    }
                }
            });
        }
    });

    //cargar datos a select-libro
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'listarlib'},
        method: 'GET',
        success: function(response) {
            if(!response.error) {
                //console.log('cargar libros :'+response);
                let object = JSON.parse(response);
                let option="";
                option += `<option value='0'>Todos los libros</option>`;
                object.forEach(function (libro) {
                    option += `<option value=${libro.id_lib}>${libro.titulo}</option>`;

                });
                $('#select-libro').html(option);
            }
        }
    });

    //recuperar datos de select-libro
    $('#select-libro').change(function () {
        let idLib = $(this).val();
        consultarObsLibro(idLib);
    });

    //recuperar datos de select-estado
    $('#select-estado').change(function () {
        let estado = $(this).val();
        consultarObsEstado(estado);
    });

});



function actualizarEstado(idObs, idLib, estado) {
    
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'actualizarEst', idObs, idLib, estado},
        method: 'POST',
        success: function (response) {
            if(!response.error) {
                console.log(response);
                getObservacion();
                //let obj = JSON.parse(response);
            }
        }
    });
}

function consultarObsEstado(estado) {
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'consultarEst', estado},
        method: 'GET',
        success: function (response) {
            if(!response.error) {
                console.log(response);
                array = JSON.parse(response);
                
                let template = "";
                array.forEach(obs => {
                    let idObs = obs.id_obs;
                    let idLib = obs.id_lib;
                    let fecObs = obs.fec_obs;
                    let titulo = obs.titulo;
                    let razon = obs.razon;
                    let estado = obs.estado;
                    let op = ['', '', ''];
                    let est = ['', ''];
                    let divFecSol="";
                    switch (estado) {
                        case 'Inutilizable':
                            op[0] = 'selected';
                            break;
                        case 'En solucion':
                            op[0] = 'disabled'; est[0] = 'bg-gray-400';
                            op[1] = 'selected';
                            break;
                        case 'Recuperado':
                            op[0] = 'disabled'; est[0] = 'bg-gray-400';
                            op[1] = 'disabled'; est[1] = 'bg-gray-400';
                            op[2] = 'selected';
                            break;
                    }
                    if(estado == 'Recuperado') {
                        fecObs = 'Obs: '+fecObs;
                        divFecSol = `<div class="col text-gray-600 small">Sol: ${obs.fec_sol}</div>`;
                    }
                    template += ` <div class="col-xl-4 mb-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row align-items-baseline">
                                        <div class="col text-gray-500">
                                            <i class="fa-solid fa-eye h3"></i>
                                        </div>
                                        <div class="col">
                                            <select class="selectEstCard form-control bg-light border-1 small">
                                                <option value=${JSON.stringify({idObs, idLib, estado: 'Inutilizable'})} ${op[0]} class="${est[0]}">Inutilizable</option>
                                                <option value=${JSON.stringify({idObs, idLib, estado: 'Ensolucion'})} ${op[1]} class="${est[1]}">En solucion</option>
                                                <option value=${JSON.stringify({idObs, idLib, estado: 'Recuperado'})} ${op[2]}>Recuperado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row ml-1">
                                        <div class="h7 font-weight-bold mt-1">OBSERVACION</div>
                                    </div>

                                    <div class="row ml-1 mb-1">
                                        <div class="col text-gray-600 small">ID: ${idObs}</div>
                                        <div class="col text-gray-600 small">${fecObs}</div>${divFecSol}
                                    </div>

                                    <div class="row">
                                        <div class="col-3 text-gray-600 font-weight-bold">Libro:</div>
                                        <div class="col">${titulo}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-gray-600 font-weight-bold">Razón:</div>
                                        <div class="col">${razon}</div>
                                    </div>
                                </div>
                            </div>
                         </div>`;
                });

                $('#cards').html(template);
            }
        }
    });
}

function consultarObsLibro(idLib) {
    if (idLib == '0') {
        getObservacion();
    } else {
        $.ajax({
            url: "controlador/Control_ConLib.php",
            data: {action: 'consultarLib', idLib},
            method: 'GET',
            success: function (response) {
                if(!response.error) {
                    console.log(response);
                    array = JSON.parse(response);
                    
                    let template = "";
                    array.forEach(obs => {
                        let idObs = obs.id_obs;
                        let idLib = obs.id_lib;
                        let fecObs = obs.fec_obs;
                        let titulo = obs.titulo;
                        let razon = obs.razon;
                        let estado = obs.estado;
                        let op = ['', '', ''];
                        let est = ['', ''];
                        let divFecSol="";
                        switch (estado) {
                            case 'Inutilizable':
                                op[0] = 'selected';
                                break;
                            case 'En solucion':
                                op[0] = 'disabled'; est[0] = 'bg-gray-400';
                                op[1] = 'selected';
                                break;
                            case 'Recuperado':
                                op[0] = 'disabled'; est[0] = 'bg-gray-400';
                                op[1] = 'disabled'; est[1] = 'bg-gray-400';
                                op[2] = 'selected';
                                break;
                        }
                        if(estado == 'Recuperado') {
                            fecObs = 'Obs: '+fecObs;
                            divFecSol = `<div class="col text-gray-600 small">Sol: ${obs.fec_sol}</div>`;
                        }
                        template += ` <div class="col-xl-4 mb-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-baseline">
                                            <div class="col text-gray-500">
                                                <i class="fa-solid fa-eye h3"></i>
                                            </div>
                                            <div class="col">
                                                <select class="selectEstCard form-control bg-light border-1 small">
                                                    <option value=${JSON.stringify({idObs, idLib, estado: 'Inutilizable'})} ${op[0]} class="${est[0]}">Inutilizable</option>
                                                    <option value=${JSON.stringify({idObs, idLib, estado: 'Ensolucion'})} ${op[1]} class="${est[1]}">En solucion</option>
                                                    <option value=${JSON.stringify({idObs, idLib, estado: 'Recuperado'})} ${op[2]}>Recuperado</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="row ml-1">
                                            <div class="h7 font-weight-bold mt-1">OBSERVACION</div>
                                        </div>
    
                                        <div class="row ml-1 mb-1">
                                            <div class="col text-gray-600 small">ID: ${idObs}</div>
                                            <div class="col text-gray-600 small">${fecObs}</div>${divFecSol}
                                        </div>
    
                                        <div class="row">
                                            <div class="col-3 text-gray-600 font-weight-bold">Libro:</div>
                                            <div class="col">${titulo}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 text-gray-600 font-weight-bold">Razón:</div>
                                            <div class="col">${razon}</div>
                                        </div>
                                    </div>
                                </div>
                             </div>`;
                    });
    
                    $('#cards').html(template);
                }
            }
        });
    }
    
}

function existeLibro() {
    idLib = $('#id-libro').val();
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'existeLib', idLib},
        method: 'GET',
        success: function (response) {
            if(!response.error) {
                console.log(response);
                let obj = JSON.parse(response);
                if (obj.resp) {
                    $('#span-id-libro').html('');
                    puedeInsterObs();
                }
                else {
                    $('#span-id-libro').html('(ID de libro desconocido)');
                    sessionStorage.setItem('boton-block', true);
                    $('#boton-agregar').removeClass('btn-primary');
                    $('#boton-agregar').addClass('btn-secondary');
                }
            }
        }
    });
}

function puedeInsterObs() {
    idLib = $('#id-libro').val();
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'puedeInsObs', idLib},
        method: 'GET',
        success: function (response) {
            if(!response.error) {
                console.log(response);
                let obj = JSON.parse(response);
                if (obj.resp) {
                    $('#span-id-libro').html('');
                    sessionStorage.setItem('boton-block', false);
                    $('#boton-agregar').removeClass('btn-secondary');
                    $('#boton-agregar').addClass('btn-primary');
                }
                else {
                    $('#span-id-libro').html('(Presenta una observacion no recuperada)');
                    sessionStorage.setItem('boton-block', true);
                    $('#boton-agregar').removeClass('btn-primary');
                    $('#boton-agregar').addClass('btn-secondary');
                }
            }
        }
    });
}


function getObservacion() {
    $.ajax({
        url: "controlador/Control_ConLib.php",
        data: {action: 'getObs'},
        type: 'GET',
        success: function (response) {
            if(!response.error) {
                console.log(response);
                array = JSON.parse(response);
                
                let template = "";
                array.forEach(obs => {
                    let idObs = obs.id_obs;
                    let idLib = obs.id_lib;
                    //console.log("idLib: "+idLib);
                    let fecObs = obs.fec_obs;
                    let titulo = obs.titulo;
                    let razon = obs.razon;
                    let estado = obs.estado;
                    let op = ['', '', ''];
                    let est = ['', ''];
                    switch (estado) {
                        case 'Inutilizable':
                            op[0] = 'selected';
                            break;
                        case 'En solucion':
                            op[0] = 'disabled'; est[0] = 'bg-gray-400';
                            op[1] = 'selected';
                            break;
                        case 'Recuperado':
                            op[0] = 'disabled'; est[0] = 'bg-gray-400';
                            op[1] = 'disabled'; est[1] = 'bg-gray-400';
                            op[2] = 'selected';
                            break;
                    }
                    template += ` <div class="col-xl-4 mb-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row align-items-baseline">
                                        <div class="col text-gray-500">
                                            <i class="fa-solid fa-eye h3"></i>
                                        </div>
                                        <div class="col">
                                            <select class="selectEstCard form-control bg-light border-1 small">
                                                <option value=${JSON.stringify({idObs, idLib, estado: 'Inutilizable'})} ${op[0]} class="${est[0]}">Inutilizable</option>
                                                <option value=${JSON.stringify({idObs, idLib, estado: 'Ensolucion'})} ${op[1]} class="${est[1]}">En solucion</option>
                                                <option value=${JSON.stringify({idObs, idLib, estado: 'Recuperado'})} ${op[2]}>Recuperado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row ml-1">
                                        <div class="h7 font-weight-bold mt-1">OBSERVACION</div>
                                    </div>

                                    <div class="row ml-1 mb-1">
                                        <div class="col text-gray-600 small">ID: ${idObs}</div>
                                        <div class="col text-gray-600 small">${fecObs}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3 text-gray-600 font-weight-bold">Libro:</div>
                                        <div class="col">${titulo}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-gray-600 font-weight-bold">Razón:</div>
                                        <div class="col">${razon}</div>
                                    </div>
                                </div>
                            </div>
                         </div>`;
                });

                $('#cards').html(template);
            }
        }
    });
    

    
}