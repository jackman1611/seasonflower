<?php
require '../functions/zend_functions.php';
class HomeController extends Zend_Controller_Action{

	private $_session;
    private $_season;
    private $_usr;
    private $_reco;
    private $_accounts;
    private $_pedidoscompras;
    private $_orden;
    private $_slider;
    private $_pro;
    private $_tarje;
    private $_shopping;

    public function init(){
        $layout = $this->_helper->layout();
        $layout->setLayout('layout-home');
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_season = new Application_Model_SeasonTokensModel;
        $this->_usr = new Application_Model_SeasonPanelModel;
        $this->_reco = new Application_Model_SeasonRecomendacionModel;
        $this->_accounts = new Application_Model_SeasonAccountsModel;
        $this->_pedidoscompras = new Application_Model_SeasonPedidosModel;
        $this->_orden = new Application_Model_SeasonOrdenModel;
        $this->_slider = new Application_Model_SeasonSliderModel;
        $this->_pro = new Application_Model_SeasonProductoModel;
        $this->_tarje = new Application_Model_SeasonTarjetasModel;
        $this->_shopping = zend_functions::Instance();
        $table="temporada";
        $this->view->temporadas = $this->_reco->GetAll($table);
        $table="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table);
        $table="producto";
        $this->view->productosf = $this->_pro->GetAllBy($table);
    }//init

    public function indexAction(){
        $table="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table);
        $table="producto";
        $this->view->product = $this->_pro->GetSome($table);
    }//indexAction

    public function temporadaAction(){
        $id=$this->_getParam('id');
        $wh="id";
        $table="temporada";
        $this->view->temporadasesp = $this->_reco->GetSpecific($table,$wh,$id);
    }

    public function productsAction(){
    	$table="producto";
        $this->view->product = $this->_reco->GetAll($table);
        $table="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table);
    }//productsAction

    public function detalleproductoAction(){
        $table1="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table1);
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="producto";
            $wh="id";
            $this->view->productos = $this->_reco->GetSpecific($table,$wh,$id);
            $table="slider";
            $wh="fkpro";
            $this->view->sli = $this->_slider->GetSpecific($table,$wh,$id);
            $this->view->tarjeta = $this->_tarje->GetSpecificInner($id);
            $table="producto";
        $this->view->product = $this->_pro->GetDetailPro($table);
        }else {
            return $this-> _redirect('/');
        }
        
    }//detalle producto

    public function recomendationsAction(){
    	$table="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table);
    }//recomendationsAction

    public function productosrecomendacionAction(){
        $table="recomendacion";
        $this->view->reco = $this->_reco->GetAll($table);
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $this->view->produc = $this->_reco->getRelationByInnerJoin($id);
        }else {
                return $this-> _redirect('/');
        }
    }//porductos recomendacion

    public function recuperarcontrasenaAction(){
        
    }

    public function infoAction(){
        
    }

    public function comprarAction(){
        
    }

    public function contactoAction(){
        
    }

    public function cambiocontrasenaAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $this->view->usuario = $this->_usr->GetSpecific($table,$wh,$id);
    }

     public function nuevacontrasenaAction(){
         if($this->_hasParam('tagpr')){
            $tokn =  $this->_getParam('tagpr');
            $table="tokenusr";
            $tokens = $this->_season->Tokenvalidar($tokn);
            $this->view->correo = $tokens;
            if (!$tokens) {
                header("Location: /");
            }
        }else{
            echo "No disponible";
        }
    }

    public function cuentasAction(){
    	if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $this->view->usuario = $this->_usr->GetSpecific($table,$wh,$id);
        $wh="fkusuario";
        $table="cuentas";
        $this->view->cuentas = $this->_usr->GetSpecific($table,$wh,$id);
    }//cuentasAction

    public function cuentanuevaAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
    }

    public function pedidosAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="idusuario";
        $table="orden";
        $this->view->orden = $this->_orden->GetSpecific($table,$wh,$id);
    }//pedidosAction


    public function pedidospendientesAction(){

        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="idusuario";
        $table="orden";
        $this->view->complete = $this->_orden->GetSpecific($table,$wh,$id);
        $table='cuentas';
        $wh="fkusuario";
        $this->view->cuentas=$this->_orden->GetSpecific($table,$wh,$id);
    }

    public function pedidostmpAction(){
        
    }//pedidosAction

    public function detallespedidosAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="orden";
        $this->view->orden = $this->_orden->GetSpecific($table,$wh,$id);
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $this->view->pedidos = $this->_pedidoscompras->getPedidosByInnerJoin($id);
        }
    }//detalles producto

    public function perfilusuarioAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $this->view->usuario = $this->_usr->GetSpecific($table,$wh,$id);
    }//perfilusuarioAction

    public function direccionesAction(){
    	if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $this->view->usuario = $this->_usr->GetSpecific($table,$wh,$id);
        $wh="fkusuario";
        $table="direcciones";
        $this->view->direcciones = $this->_usr->GetSpecific($table,$wh,$id);
    }//direccionesAction

    public function nuevadireccionAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
    }//direccionesAction

    public function editarperfilAction(){
    	if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $this->view->usuario = $this->_usr->GetSpecific($table,$wh,$id);
    }//editarperfilAction

    public function comprasAction(){
    	if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $id=$this->_session->id;
        $wh="idusuario";
        $table="orden";
        $this->view->complete = $this->_orden->GetSpecific($table,$wh,$id);

    }//comprasAction

    public function registroAction(){
    	
    }//registroAction

    public function loginAction(){
    	
    }//loginAction

    // -------------------------------REQUEST ADD

    public function requestadduserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_usr->insertUsr($post,$table);
            // var_dump($result);exit;
            if ($result) {
                return $this-> _redirect('/home/login');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }//request user

    public function requestpedidospendientesaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $id=$this->_session->id; 
        $wh="id";
        $table="usuario";
        $data= $this->_orden->GetSpecific($table,$wh,$id);
        $order= $this->_orden->GetSpecificOrderByInner($id);
        foreach ($data as $udata) {
           $nombre= $udata['nombre'];
           $email=$udata['correo'];
           $phone=$udata['telefono'];

        }
        $post = $this->getRequest()->getPost();
        $toks=$post['conektaTokenId'];

        $arreglo = [];
        foreach ($post as $indice => $value) {
            for ($i=0; $i < count($value) ; $i++) {     
                $arreglo[$i][$indice] = $value[$i];
            }              
        }
       
        require_once("../library/Conekta/lib/Conekta.php");
        \Conekta\Conekta::setApiKey("key_Up4eGgdGxFXzGmqw3Pz2UQ");
        \Conekta\Conekta::setApiVersion("2.0.0");

        if ($this->getRequest()->getPost()) {
            try {
              $customer = \Conekta\Customer::create(
                array(
                  "name" =>$nombre,
                  "email" =>$email,
                  "phone" =>$phone,
                  "payment_sources" => array(
                    array(
                        "type" => "card",
                        "token_id" => $toks
                    )
                  )//payment_sources
                )//customer
              );
            } catch (\Conekta\ProccessingError $error){
              echo $error->getMesage();
            } catch (\Conekta\ParameterValidationError $error){
              echo $error->getMessage();
            } catch (\Conekta\Handler $error){
              echo $error->getMessage();
            }

 // print_r($customer);echo "<br>"; exit;
            if ($customer) {
                // foreach ($customer as $key) {
                    // var_dump($customer['id']);echo "<br>";
                // }exit;
                    $varinner = array();
                    $counter = 0 ;
                    $curr= intval($post['total']);
                    
                    // var_dump($curr);exit;
                    foreach ($order as $key) {
                        $dir=$key['direccion'];
                        $cp=$key['cp'];
                        $name=$key['nombre'];
                    }

                try{
                  $order = \Conekta\Order::create(
                    array(
                     "line_items" => array(
                        array(
                          "name" => $name,
                          "unit_price" =>$curr,
                          "quantity" => 1
                        )//first line_item
                      ), //line_items
                      "shipping_lines" => array(
                        array(
                          "amount" => 1500,
                           "carrier" => "MXN"
                        )
                      ), //shipping_lines - physical goods only
                      "currency" => "MXN",
                      "customer_info" => array(
                        "customer_id" => $customer['id']
                      ), //customer_info
                      "shipping_contact" => array(
                        "address" => array(
                          "street1" => $dir,
                          "postal_code" => $cp,
                          "country" => "MX"
                        )//address
                      ), //shipping_contact - required only for physical goods
                      
                      "charges" => array(
                          array(
                              "payment_method" => array(
                                      "type" => "default"
                              ) //payment_method - use customer's <code>default</code> - a card
                          ) //first charge
                      ) //charges
                    )//order
                  );
                } catch (\Conekta\ProcessingError $error){
                  echo $error->getMessage();
                } catch (\Conekta\ParameterValidationError $error){
                  echo $error->getMessage();
                } catch (\Conekta\Handler $error){
                  echo $error->getMessage();
                }


                if($order){
                    $arreglo = [];
                    foreach ($post as $indice => $value) {
                        for ($i=0; $i < count($value) ; $i++) {     
                            $arreglo[$i][$indice] = $value[$i];
                        }              
                    }
                    $table = "producto_orden";
                    foreach ($arreglo as $key ) {
                        $result1 = $this->_pedidoscompras->insertPedidosOrden($key,$table);
                        
                    }
                    $id=$key['id'];
                    $table="producto";
                    $stock = $this->_pro->GetStock($table,$id);
                    foreach ($stock as $k => $v) {
                        $st=$v['stock'];
                    }
                    $cantidad=$key['cantidad'];
                    $result = $st-$cantidad;
                    $table="producto";
                        $this->_pro->refreshstock($table,$result,$id);
                        $this->_shopping->clearCookies();
                    if ($result) {
                        return $this-> _redirect('/home/pedidos');
                    }else{
                        print '<script language="JavaScript">'; 
                        print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                        print '</script>'; 
                    }
                }
       
            } else {
                
            }
            
        } else {
            
        }
        

    }//request pedidos_orden

    public function requestcountsaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        if($this->getRequest()->getPost()){
            $card= $post['Card1'].$post['Card2'].$post['Card3'].$post['Card4'];  
            $id=$this->_session->id;
            $table="cuentas";
            $result = $this->_accounts->InsertAccounts($table,$id,$card,$post);

            if ($result) {
                return $this-> _redirect('/home/cuentas');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestdireccionaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $delegacion = $post["delegacion"];
        $direccion = $post["dir"];
        $dir= $direccion.",".$delegacion;
        if($this->getRequest()->getPost()){          
            $id=$this->_session->id;
            $table="direcciones";
            $result = $this->_accounts->InsertDireccion($table,$id,$dir,$post);

            if ($result) {
                return $this-> _redirect('/home/direcciones');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    // -------------------------------REQUEST UDATE

    public function requestupdateuserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_usr->refreshUsr($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdateusersessionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $id=$this->_session->id;
            $wh='id';
            $table='usuario';
            $result = $this->_usr->UpdateUsrSession($post,$table,$wh,$id);
            if ($result) {
                return $this-> _redirect('/home/perfilusuario');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestrefreshpassAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $wh='id';
            $table='usuario';
            $result = $this->_usr->UpdateUsrPassw($post,$table,$wh);
            if ($result) {
                return $this-> _redirect('/home/perfilusuario');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Sin acceso.");'; 
                print '</script>'; 
            }
        }
    }//Joel


    public function requestupdateuserpassAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_season->refreshPass($post,$table);
            //var_dump($post);exit;
            if ($result) {
                return $this-> _redirect('/home/login');
            }else{
               print '<script language="JavaScript">'; 
               print 'alert("Ocurrio un error: Comprueba los datos.");'; 
               print '</script>'; 
           }
       }
    }//Jos

    // -------------------------------REQUEST DELETE

    public function requestdeleteuserAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="usuario";
            $wh="id";
            $result = $this->_season->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }
        } else {
            return $this-> _redirect('/panel');
        }
    }

    public function requestdeletecardAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id=$this->_getParam('id');
            $table="cuentas";
            $wh="id";
            $result = $this->_accounts->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/home/cuentas');
            }
        } else {
            return $this-> _redirect('/');
        }
    }

    public function requestdeletedireccionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id=$this->_getParam('id');
            $table="direcciones";
            $wh="id";
            $result = $this->_accounts->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/home/direcciones');
            }
        } else {
            return $this-> _redirect('/');
        }
    }

    public function requestchargeAction(){
                $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $id=$post['id'];
        $table='cuentas';
        $wh="id";
        $result=$this->_orden->GetSpecific($table,$wh,$id);
        //var_dump($result);
        echo json_encode($result);
    }

}

