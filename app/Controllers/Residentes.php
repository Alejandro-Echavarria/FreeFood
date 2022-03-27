<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\ResidentesModel; // Llamamos a nuestro modelo

    class Residentes extends BaseController{

        protected $titlePage;
        protected $controlador;

        public function __construct(){
            
            $this->tablaResidentes = new ResidentesModel();
            $this->titlePage = 'Residentes';
            $this->titulo  = 'Residentes';
            $this->controlador  = 'Residentes';
            $this->javaScript = 'functions_'.$this->controlador.'.js';
        }

        /**
         * This function is used to display the main page of the site. 
         * 
         * The function is called when the user enters the site. 
         */
        public function index(){
            
            /* This is a way to pass data to the view. */
            $data = ['titulo' => $this->titulo,
                     'titlePage' => $this->titlePage, 
                     'controlador'=> $this->controlador,
                     'page_functions_js' => $this->javaScript
                    ];

            echo view ('templates/header',$data); // Llamamos nuestro header
            echo view ('residentes/residentes'); // Aquí va pagina principal a mostrar al entrar a la vista
            echo view ('templates/footer'); // Llamamos nuestro footer
        }

        /**
         * It returns the data of the resident in JSON format.
         * 
         * @param id The id of the resident.
         */
        public function get($id = 0){

            // Si id es = 0 traerá todos los residentes
            if ($id == 0) {
                
                $arrData = $this->tablaResidentes->obtener();
    
                for ($i = 0; $i < count($arrData); $i++) {
    
                    // Variables para los permisos, control de botones.
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
    
                    if ($arrData[$i]['comida_entregada_residente'] == 1) {
                         $arrData[$i]['comida_entregada_residente'] = '<span class="badge colorGreen">Entregado</span>';
                    } else {
                        if ($arrData[$i]['comida_entregada_residente'] == 0){
    
                            $arrData[$i]['comida_entregada_residente'] = '<span class="badge colorRed">Sin entregar</span>';
                        }
                    }
            
                    $btnView = '<button type="button" class="btn btn-sm colorYellow" onClick="fntView(' . $arrData[$i]['id_residente'] . ')" title="Ver usuario"><i class="fa-solid fa-eye" data-toggle="tooltip"></i></button>';
                    $btnEdit = '<button type="button" class="btn btn-sm colorBlue" onClick="fntEdit(' . $arrData[$i]['id_residente'] . ')" title="Editar"><i class="fas fa-pencil-alt" data-toggle="tooltip"></i></button>';
                    $btnDelete = '<button type="button" class="btn btn-sm colorRed" title="Eliminar" onClick="fntDelete('. $arrData[$i]['id_residente'] .')" ><i class="fas fa-trash-alt" data-toggle="tooltip"></i></button>';
                        
                    $arrData[$i]['options'] = '<div clas="text-center">' . $btnView .' ' . $btnEdit . ' ' . $btnDelete . '</div>';
                };
            }else{

                $arrData = $this->tablaResidentes->obtener($id);
                if (empty($arrData)) {
                        
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();  
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();  
        }

        /**
         * It saves the data of a resident in the database.
         */
        public function post(){
            
            if ($this->request->getMethod() == "post") {

                $id = intval(strClean($this->request->getPost('idResidente')));
                $strNombres = ucwords(strClean($this->request->getPost('txtNombres')));
                $strApellidos = ucwords(strClean($this->request->getPost('txtApellidos')));
                $intEdad = intval(strClean($this->request->getPost('intEdad')));
                $intTelefono = intval(strClean($this->request->getPost('intTelefono')));
                $strCorreo = strClean($this->request->getPost('txtCorreo'));
                $strDireccion = strClean($this->request->getPost('txtDireccion'));
                $strObservacion = strClean($this->request->getPost('txtObservacion'));
                $intEstado = intval(strClean($this->request->getPost('listStatus')));

                $arrResponse = 'En caso de aparecer este mensaje, consultar con el administrador';
                $requestData = 0;

                if (empty($strNombres || $strApellidos || $intEdad || $intTelefono ||
                          $strCorreo || $strDireccion || $strObservacion)) {
                    
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
                }else{

                    $requestExistencia = $this->tablaResidentes->validarExistencia($id,$strCorreo);
                    
                    if (empty($requestExistencia)) {
                        
                        if ($id == 0) {
                            
                            $option = 1;
                            $requestData = $this->tablaResidentes->save(['nombres_residente'=>$strNombres,
                                                                         'apellidos_residente'=>$strApellidos,
                                                                         'telefono_residente'=>$intTelefono,
                                                                         'correo_residente'=>$strCorreo,
                                                                         'edad_residente'=>$intEdad,
                                                                         'direccion_residente'=>$strDireccion,
                                                                         'comida_entregada_residente'=>$intEstado,
                                                                         'observacion_residente'=>$strObservacion,
                                                                         'comida_entregada_residente'=>0]);
                            
                        }
                        
                        if ($requestData > 0) {
                            
                            if ($option == 1 ) {
                                
                                $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente');
                            }else{
                                $arrResponse = array("status" => true, "msg" => 'Ocurrió un error al momento de crear el residente');                        
                            }
                        }
                        
                    }else{
                        $arrResponse = array("status" => false, "msg" => '¡Atención! este correo ya existe');
                    }
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        /**
         * It updates the data of a resident.
         */
        public function put (){

            if ($this->request->getMethod() == "post") {

                $id = intval(strClean($this->request->getPost('idResidente')));
                $strNombres = ucwords(strClean($this->request->getPost('txtNombres')));
                $strApellidos = ucwords(strClean($this->request->getPost('txtApellidos')));
                $intEdad = intval(strClean($this->request->getPost('intEdad')));
                $intTelefono = intval(strClean($this->request->getPost('intTelefono')));
                $strCorreo = strClean($this->request->getPost('txtCorreo'));
                $strDireccion = strClean($this->request->getPost('txtDireccion'));
                $strObservacion = strClean($this->request->getPost('txtObservacion'));
                $intEstado = intval(strClean($this->request->getPost('listStatus')));

                $arrResponse = 'En caso de aparecer este mensaje, consultar con el administrador';
                $requestData = 0;

                if (empty($strNombres || $strApellidos || $intEdad || $intTelefono ||
                          $strCorreo || $strDireccion || $strObservacion || $intEstado)) {
                    
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
                }else{

                    $requestExistencia = $this->tablaResidentes->validarExistencia($id,$strCorreo);
                    
                    if (empty($requestExistencia)) {
                        
                        if ($id > 0) {
                            
                            $option = 2;
                            $requestData = $this->tablaResidentes->save(['id_residente'=>$id,
                                                                         'nombres_residente'=>$strNombres,
                                                                         'apellidos_residente'=>$strApellidos,
                                                                         'telefono_residente'=>$intTelefono,
                                                                         'correo_residente'=>$strCorreo,
                                                                         'edad_residente'=>$intEdad,
                                                                         'direccion_residente'=>$strDireccion,
                                                                         'comida_entregada_residente'=>$intEstado,
                                                                         'observacion_residente'=>$strObservacion,
                                                                         'comida_entregada_residente'=>$intEstado]);
                            
                        }
                        
                        if ($requestData > 0) {
                            
                            if ($option == 2 ) {
                                
                                $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente');
                            }else{
                                $arrResponse = array("status" => true, "msg" => 'Ocurrió un error al momento de actualizar el residente');                        
                            }
                        }
                        
                    }else{
                        $arrResponse = array("status" => false, "msg" => '¡Atención! este correo ya existe');
                    }
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        /**
         * It deletes a resident from the database.
         */
        public function delete(){

            if ($this->request->getMethod() == "post") {

                $id = intval(strClean($this->request->getPost('idRegistro')));
                    
                if (empty($id)) {
                    
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
                }else{

                    $requestData = $this->tablaResidentes->delete($id);

                    if ($requestData > 0) {
                        
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el residente');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el residente');
                    }     
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>