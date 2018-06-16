<?php

class IndexController extends Zend_Controller_Action{

	private $_session;
	private $_log;
    private $_season;
    public function init(){
        $this->_log = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_season = new Application_Model_SeasonPanelModel;
    }

    public function indexAction(){
        if(empty($this->_session->id)){
            $url = "/home";
            $this->_redirect($url);
        }
    }

    public function loginAction(){
    	$table="usuario";
        $this->view->admin = $this->_log->GetAll($table);
    } // LOGIN

    public function validarAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ($this->getRequest()->getPost()){

            $post = $this->getRequest()->getPost();
            //var_dump($post); exit; 
            //var_dump($post);//exit;
            //$p = openssl_digest($post["password"],"sha512");
            //var_dump($p);exit;
            $result = $this->_season->Validar($post);
            //echo count($result);exit;

            if(count($result)){
                Zend_Session::start();
                foreach ($result as $key) {
                    $fk=$key['fkroles'];

                    //var_dump($fk);
                    
                    if ($fk==1) {
                        
                    //$session = new Zend_Session_Namespace("current_session");
                    $this->_session->id = $result [0]["id"];
                    $this->_session->nombre = $result [0]["nombre"];
                    $url = "/panel/index";
                    $this->redirect($url);
                    } else {
                      
                        $this->_session->id = $result [0]["id"];
                        $this->_session->nombre = $result [0]["nombre"];
                        $url = "/home";
                        $this->redirect($url); 
                    }
                    
                }
            }else{
                
                echo "No existe el usuario regresa e ingresa un usuario registrado";
                print "<br><a href=\"/home/login\">Regresar</a>";
            }
            
        }else{
            echo json_encode(array("id"=>"0","name"=>"No hay informacion que mostrar"));
        } 
    }//Validar

    public function logoutAction(){

        $session= new Zend_Session_Namespace('current_session');
        $session->unsetAll();

        Zend_Session::namespaceUnset('current_session');

        Zend_Session::destroy();
        
        $url = "/home";
        $this->redirect($url);
        //$this->_redirect('/');
    }//logout

    
}

