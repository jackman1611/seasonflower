<?php

class TokensController extends Zend_Controller_Action{

	private $_season;
	private $_tokns;

	// ----------------------   VISTAS	--------------------------//
    public function init(){
        $this->_season = new Application_Model_SeasonTokensModel;
        $this->_tokns = new Application_Model_SeasonTokensModel;
    }//init

     public function indexAction(){
         
     }//index

     public function contrasenaAction(){

     }//contraseña
     
     public function validarAction(){
     	$table="tokenusr";
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ($this->getRequest()->getPost()){

            $post = $this->getRequest()->getPost();
            $result = $this->_season->Validarcorreo($post);
            //echo count($result);exit;

            if(count($result)){
                foreach ($result as $key) {
                    $mail=$key['correo'];
                    ///var_dump($fk);exit;
                    if (!empty($mail)){
						//echo 'El registro se encuentra en la base de datos'."<br>";
                    	$tok= str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".uniqid());
						//echo $tok;
						$result = $this->_tokns->insertToken($mail,$table,$tok);
						if ($result) {
							
                            $nurl = '/home/nuevacontrasena/tagpr/'.$tok;
                            var_dump('http://seasonflower.local'.$nurl);    
							//return $this-> _redirect('/home/login');
						}
						
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

}