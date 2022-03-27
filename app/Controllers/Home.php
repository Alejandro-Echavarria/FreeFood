<?php
    namespace App\Controllers;

    class Home extends BaseController{

        protected $titlePage;
        protected $controlador;

        public function __construct(){
            
            $this->titlePage = 'Home';
            $this->titulo  = 'Home';
            $this->controlador  = 'Home';
            $this->javaScript = 'functions_'.$this->controlador.'.js';
        }
        /**
         * This function is the main function that is called when the user goes to the home page
         */
        public function index(){

            $data = ['titulo' => $this->titulo,
                     'titlePage' => $this->titlePage, 
                     'controlador'=> $this->controlador,
                     'page_functions_js' => $this->javaScript
                    ];

            echo view('templates/header',$data);
            echo view('home');
            echo view('templates/footer');
        }
    }
?>