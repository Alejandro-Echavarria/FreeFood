const modalNombreControlador = "#"+controlador;
const tablaNombreControlador = "#tabla_"+controlador;
var DataTableAc;

$(document).ready(function(){
    
    /* The above code is creating a DataTable with the following characteristics:
    - It is responsive
    - It has a pagination
    - It has a search box
    - It has a column with the options to edit or delete the record */
    DataTableAc = $(tablaNombreControlador).dataTable({
        "language": {
            "infoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
            "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros", 
            "infoFiltered": "",
            "processing": "Cargando",
            "loadingRecords": "Cargando datos ...",
            "emptyTable": "No hay datos registrados para mostrar en la tabla.",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        "responsive": true,
        "paging": true,
        "ajax":{
            "url": " "+base_url+"/"+controlador+"/get",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_residente"},
            {"data":"nombres_residente"},
            {"data":"apellidos_residente"},
            {"data":"telefono_residente"},
            {"data":"correo_residente"},
            {"data":"edad_residente"},
            {"data":"comida_entregada_residente"},
            {"data":"options"}
        ]
    });
    let oTable = $(tablaNombreControlador).DataTable();
    
    /* Using the jQuery library to search the table for the value of the text box. */
    $("#txtBuscar").keyup(function() {
        $(tablaNombreControlador).dataTable().fnFilter(this.value);
    }); 
    
    /* The above code is a JavaScript snippet that is executed when the user changes the number of
    entries per page. */
    $('#selectEntries').val(oTable.page.len());
    $('#selectEntries').change( function() { 
        oTable.page.len($(this).val() ).draw();
    });

    /* The above code is adding the information and pagination elements to the appropriate divs. */
    jQuery(".dataTables_info").appendTo(jQuery("#numbers_numbers"));
    jQuery(".dataTables_paginate").appendTo(jQuery("#pagination_pagination"));

    
    /* This is a JavaScript statement that is creating a variable named `form` and assigning it the
    value of the HTML element with the id `form` and the value of the controlador. */
    let form = document.querySelector('#form'+controlador+'');

    form.onsubmit = function(e){

        e.preventDefault();
        let intID = document.querySelector('#idResidente').value;
        let strNombres = document.querySelector('#txtNombres').value;
        let strApellidos = document.querySelector('#txtApellidos').value;
        let intEdad = document.querySelector('#intEdad').value;
        let intTelefono = document.querySelector('#intTelefono').value;
        let strCorreo = document.querySelector('#txtCorreo').value;
        let strDireccion = document.querySelector('#txtDireccion').value;
        let strObservacion = document.querySelector('#txtObservacion').value;

        if (strNombres == '' || strApellidos == '' ||
            strCorreo == '' || strDireccion == '' || strObservacion == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                confirmButtonText: 'Entendido',
                confirmButtonColor: 'rgb(1, 73, 141)'
            });
            
            return false;
        }

        if (parseInt(intEdad) <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                confirmButtonText: 'Entendido',
                confirmButtonColor: 'rgb(1, 73, 141)'
            });
            
            return false;
        }

        if (parseInt(intTelefono) <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                confirmButtonText: 'Entendido',
                confirmButtonColor: 'rgb(1, 73, 141)'
            });

            return false;
        }

        //Nos dirigimos a todos los elementos cone esta clase
        let elementsValid = document.getElementsByClassName("valid");
        //Iteramos con cada elemento
        for (let i = 0; i < elementsValid.length; i++) {
            /*Indicamos que si elementsValid en la posicion que se encuentre contiene la clase is-invalid 
            entonces muestra la alerta*/
            if (elementsValid[i].classList.contains('is-invalid')) {

                Swal.fire({
                    icon: 'error',
                    title: 'Atención',
                    text: 'Por favor verifique los campos en rojo',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: 'rgb(1, 73, 141)'
                  });

                return false;
            }
        }

        if (intID == '') {
            var url = base_url+'/' + controlador + '/post';
        }else{
            var url = base_url+'/' + controlador + '/put';
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = url;
        let formData = new FormData(form);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    
                    $(modalNombreControlador).modal("hide");
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Residentes',
                        text: objData.msg,
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: 'rgb(1, 73, 141)'
                    });
                    DataTableAc.api().ajax.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: objData.msg,
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: 'rgb(1, 73, 141)'
                    });
                }
            }
        }
    }
});

/**
 * It shows the information of a resident in a modal.
 * @param id_residente - The id of the resident to be viewed.
 * @returns the data of the resident.
 */
function fntView(id_residente){

    let idResidente = id_residente;
    document.querySelector('#titleModalView').innerHTML = "Residente - <span class='badge color-primario-claro'>"+idResidente+"</span>";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/'+controlador+'/get/'+idResidente;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);//Convertimos a un objeto el JSON
            if (objData.status) {

                document.querySelector("#txtNombresView").value = objData.data.nombres_residente;
                document.querySelector("#txtApellidosView").value = objData.data.apellidos_residente;
                document.querySelector("#intEdadView").value = objData.data.edad_residente;
                document.querySelector("#intTelefonoView").value = objData.data.telefono_residente;
                document.querySelector("#txtCorreoView").value = objData.data.correo_residente;
                document.querySelector("#txtDireccionView").value = objData.data.direccion_residente;
                document.querySelector("#txtObservacionView").value = objData.data.observacion_residente;

            }else{
                Swal.fire({
                    icon: 'error',
					title: 'Error',
					text: objData.msg,
					confirmButtonText: 'Entendido',
					confirmButtonColor: 'rgb(1, 73, 141)'
				});
                return false;
            }
            $(modalNombreControlador+'View').modal('show');//Mostramos el modal
        }
    }
}

/**
 * This function is used to edit a resident
 * @param id_residente - The id of the resident that you want to update.
 */
function fntEdit(id_residente){
    
    //Apariencia del modal
    document.querySelector('#titleModal').innerHTML = "Actualizar residente";
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let id = id_residente;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/'+controlador+'/get/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
    
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                //Si el status es verdadero entonces se van a colocar los datos en el fomrulario
                document.querySelector("#idResidente").value = objData.data.id_residente;
                document.querySelector("#txtNombres").value = objData.data.nombres_residente;
                document.querySelector("#txtApellidos").value = objData.data.apellidos_residente;
                document.querySelector("#intEdad").value = objData.data.edad_residente;
                document.querySelector("#intTelefono").value = objData.data.telefono_residente;
                document.querySelector("#txtCorreo").value = objData.data.correo_residente;
                document.querySelector("#txtDireccion").value = objData.data.direccion_residente;
                document.querySelector("#txtObservacion").value = objData.data.observacion_residente;
                document.getElementById('status').style.display="block";// Escondemos el list de status
                
                /* This is a conditional statement that is used to set the value of the selectpicker. */
                if (objData.data.comida_entregada_residente == 1) {
    
                    document.querySelector("#listStatus").value = 1;
                }else{
                    if (objData.data.comida_entregada_residente == 0) {
                        
                        document.querySelector("#listStatus").value = 0;
                    }
                }
                $('#listStatus').selectpicker('render');
            }
        }
        $(modalNombreControlador).modal('show');
    }
}

/**
 * It deletes a resident from the database.
 * @param id_almacen - The id of the resident to delete.
 */
function fntDelete(id_almacen){
   
    var id = id_almacen;

    //Configuracion de la alerta
    Swal.fire({
        icon: 'warning',
        title: "Eliminar Residente",
        text: "¿Realmente quieres eliminar este residente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        confirmButtonColor: 'rgb(1, 73, 141)',
        cancelButtonColor: 'rgb(100, 100, 40)',
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true

    }).then((result) => {
        //Script para eliminar
        if (result.isConfirmed) {
            
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/'+controlador+'/delete';
            var strData = "idRegistro="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//Forma en la que se enviaran los datos
            request.send(strData);
            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200) 
                {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Residente',
                            text: objData.msg,
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: 'rgb(1, 73, 141)'
                        });
                        DataTableAc.api().ajax.reload();
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: objData.msg,
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: 'rgb(1, 73, 141)'
                        });
                    }
                }
            }
        }
    });
}

function openModal(){
    
    document.querySelector('#idResidente').value ="";//Limpiamos el input id **Muy importante
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo residente";
    document.querySelector("#form"+controlador+"").reset();// Limpiamos Todos los campos
    document.getElementById('status').style.display="none";// Escondemos el list de status

    $('#listStatus').selectpicker('render');

    $(modalNombreControlador).modal('show');
}