<?php
class PanelController extends Zend_Controller_Action{
    
	private $_season;
    private $_session;
    private $_pro;
    private $_reco;
	private $_flowers;
	private $_tarjetas;
	private $_temporadas;
	private $_slider;
    private $_orden;
    private $_pedidoscompras;

	// ----------------------   VISTAS	--------------------------//
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_flowers = new Application_Model_SeasonFlowersModel;
        $this->_pro = new Application_Model_SeasonProductoModel;
        $this->_reco = new Application_Model_SeasonRecomendacionModel;
        $this->_tarjetas = new Application_Model_SeasonTarjetasModel;
        $this->_temporadas = new Application_Model_SeasonTemporadaModel;
        $this->_slider = new Application_Model_SeasonSliderModel;
        $this->_orden = new Application_Model_SeasonOrdenModel;
        $this->_pedidoscompras = new Application_Model_SeasonPedidosModel;
        // Sesiones-------------------
        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $usr = $this->_season->GetSpecific($table,$wh,$id);
        foreach ($usr as $key) {
           $fk=$key['fkroles'];
        }
        if($fk!=1){
            $this->redirect('/home/perfilusuario');
        }
        // Sesiones-------------------
    }//init

     public function indexAction(){
         
     }//init

    public function loginAction(){
        $table="usuario";
        $this->view->admin = $this->_season->GetAll($table);
    }// LOGIN

    public function productosAction(){
        $table="producto";
        $table1="recomendacion";
        $this->view->productos = $this->_pro->GetAll($table);
        $this->view->recomendation = $this->_reco->GetAll($table1);   
    }//productosAction

    public function productoseditAction(){
        $table1="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table1);

        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="producto";
            $wh="id";
            $this->view->productos = $this->_pro->GetSpecific($table,$wh,$id);
            $table="productorecomendacion";
            $wh="fkpro";
            $idrelacionados=array();
            $listaselect=$this->_reco->GetSpecific($table,$wh,$id);
            foreach ($listaselect as $value) {
                $idrelacionados[]=$value['fkrecomendaciones'];
            }
            $this->view->productorecomendacion =$idrelacionados; 
        }else {
                return $this-> _redirect('/');
        }
    }//productosedit

    public function productosdetailAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="producto";
            $wh="id";
            $this->view->productos = $this->_pro->GetSpecific($table,$wh,$id);
            $table="slider";
            $wh="fkpro";
			$this->view->imagenes = $this->_slider->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }   
    }

    public function recomendacionesAction(){
        $table="recomendacion";
        $this->view->recomendation = $this->_reco->GetAll($table);
    }//recomendacionesAction

    public function recomendacioneseditAction(){
       if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="recomendacion";
            $wh="id";
            $this->view->recomendation = $this->_reco->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }  
    }//recomendacionesAction

    public function subrecomendacionesAction(){
        $table="subrecomendaciones";
        $this->view->subrecomendation = $this->_subreco->GetAll($table);
    }//subrecomendacionesAction

    public function subrecomendacioneseditAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="subrecomendaciones";
            $wh="id";
            $this->view->subrecomendation = $this->_subreco->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }
    }//editar subrecomendacion

    public function floresAction(){
    	$table='flores';
    	$this->view->flores = $this->_flowers->GetAll($table);
    }//floresAction

    public function floreseditAction(){
    	if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table='flores';
            $wh='id';
            $this->view->flores = $this->_flowers->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }
    }//floreseditAction

    public function temporadaAction(){
    	$table='flores';
    	$this->view->flores = $this->_flowers->GetAll($table);
    	$table='recomendacion';
		$this->view->recomendation = $this->_reco->GetAll($table);
		$table='temporada';
		$this->view->temporadas = $this->_temporadas->GetAll($table);
    }//temporadaAction

    public function temporadaeditAction(){
    	if($this->_hasParam('id')){
    		$table='flores';
    		$this->view->flores = $this->_flowers->GetAll($table);
    		$table='recomendacion';
			$this->view->recomendation = $this->_reco->GetAll($table);
            $id = $this->_getParam('id');
            $table='temporada';
            $wh='id';
            $this->view->temporada = $this->_temporadas->GetSpecific($table,$wh,$id);
        }else {
            return $this-> _redirect('/');
        }
    }//temporadaeditAction

    public function temporadaflorAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="flores";
            $wh="id";
            $this->view->flores = $this->_flowers->GetSpecific($table,$wh,$id);
            $table="temporada";
            $this->view->temporadas = $this->_temporadas->GetAll($table);
            $table="floresxtemp";
            $wh="fkflor";
            $this->view->floresxtmp = $this->_temporadas->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }
    }//temporadaflorAction

    public function tarjetaAction(){
    	$table="producto";
    	$this->view->productos = $this->_pro->GetAll($table);
    	$table="tarjetas";
    	$this->view->tarjetas = $this->_tarjetas->GetAll($table);
    }//tarejtaAction

    public function tarjetaeditAction(){
    	if($this->_hasParam('id')){
    		$table="producto";
    		$this->view->productos = $this->_pro->GetAll($table);
            $id = $this->_getParam('id');
            $table='tarjetas';
            $wh='id';
            $this->view->tarjeta = $this->_tarjetas->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }
    }//tarejtaAction

    public function tarjetaproductoAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="tarjetas";
            $wh="id";
            $this->view->tarjetas = $this->_tarjetas->GetSpecific($table,$wh,$id);
            $table="producto";
            $this->view->productos = $this->_pro->GetAll($table);
            $table="tarpro";
            $wh="fktarjeta";
            $this->view->tjtxpro = $this->_pro->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }
    }//tarjetaproductoAction

    public function sliderAction(){
    	if($this->_hasParam('id')){
			$id = $this->_getParam('id');
			$wh="id";
            $table="producto";
    		$this->view->productos = $this->_pro->GetSpecific($table,$wh,$id);
		}else {
                return $this-> _redirect('/');
        }
    }//sliderAction

    public function slidereditAction(){
    	if($this->_hasParam('id')){
			$id = $this->_getParam('id');
			$wh="id";
            $table="producto";
    		$this->view->productos = $this->_pro->GetAll($table);
    		$table="slider";
    		$this->view->imagenes = $this->_slider->GetSpecific($table,$wh,$id);
    		$this->view->ids=$id;
		}else {
                return $this-> _redirect('/');
        }
    }//sliderAction

    public function pedidosvendidosAction(){
        $table="orden";
        $this->view->complete = $this->_orden->GetAll($table);
    }//productosvendidosAction

    public function usuariosAction(){
        $table="usuario";
        $this->view->usuarios = $this->_season->GetAll($table);
        $table="roles";
        $this->view->rol = $this->_season->GetAll($table);
    }//usuariosAction

    public function usuarioseditAction(){
    	if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="usuario";
            $wh="id";
            $this->view->usuarios = $this->_season->GetSpecific($table,$wh,$id);
        }else {
                return $this-> _redirect('/');
        }
    }//usuariosAction

    public function pedidosAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $table="orden";
        $this->view->complete = $this->_orden->GetAll($table);
    }//pedidosAction

    public function detallepedidosAction(){
        if(empty($this->_session->id)){
            $this->redirect('/home');
        }
        $table="usuario";
        $this->view->urs = $this->_season->GetAll($table);
        
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $wh="id";
            $table="orden";
            $this->view->orden = $this->_orden->GetSpecific($table,$wh,$id);

            $this->view->usuario = $this->_pedidoscompras->getUsuario($id);

            $this->view->pedidosdire = $this->_pedidoscompras->getPedidos($id);

            $this->view->pedidos = $this->_pedidoscompras->getPedidosByInnerJoin($id);
        }
    }//detalles producto

    // ----------------------   REQUEST	--------------------------//

    	// --------------   REQUEST	ADD--------------------//
	public function requesttarjetasaddAction(){
		$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $table="tarjetas";

        if($this->getRequest()->getPost()){ 	
            $name = $_FILES['cover']['name'];
            if(empty($name)){ 
                print '<script language="JavaScript">'; 
                print 'alert("Agrega una imagen");'; 
                print '</script>'; 
            }else{
                $bytes = $_FILES['cover']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['cover']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/img_tarjetas/';
                    $urldb = $url.$info;
                    move_uploaded_file($_FILES['cover']['tmp_name'],$urldb);
                }
            }
            $result = $this->_tarjetas->insertTarjeta($post,$table,$urldb);
            if ($result) {
                return $this-> _redirect('/panel/tarjeta');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
	}

    public function requestrecomendacionaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        //var_dump($post);
        if($this->getRequest()->getPost()){
            $table="recomendacion";
            $name = $_FILES['url']['name'];
            if(empty($name)){ 
                print '<script language="JavaScript">'; 
                print 'alert("Agrega una imagen");'; 
                print '</script>'; 
            }else{
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info1 = new SplFileInfo($_FILES['url']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_reco/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }
            $result = $this->_reco->insertRecomendacion($post,$table,$urldb);
            //var_dump($result);exit;
            if ($result) {
                return $this-> _redirect('/panel/recomendaciones');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 

            }
            // return $this-> _redirect('/panel/recomendaciones');
        }
    }

    public function requestsubrecomendacionaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="subrecomendaciones";
            $result = $this->_subreco->insertSubrecomendacion($post,$table);
            //var_dump($result);exit;
            if ($result) {
                return $this-> _redirect('/panel/subrecomendaciones');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestcheckaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="orden";
            $result = $this->_pedidoscompras->refreshOrden($post,$table);    
            if ($result) {
                return $this-> _redirect('/panel/pedidosvendidos');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }//requiest

    public function requestproductoaddAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        if($this->getRequest()->getPost()){
            $table="producto";
            $name = $_FILES['url']['name'];
            if(empty($name)){ 
                print '<script language="JavaScript">'; 
                print 'alert("Agrega una imagen");'; 
                print '</script>'; 
            }else{
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info1 = new SplFileInfo($_FILES['url']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_pro/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }
            $idproducto = $this->_pro->insertProduct($post,$table,$urldb);
            $id=$idproducto;
            $wh="id";
            $table="productorecomendacion";
            $result=$this->_pro->insertProductReco($id,$wh,$table,$post);
            
            if ($result) {
                return $this-> _redirect('/panel/productos');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
            //return $this-> _redirect('/panel/productos');
        }
    }

    public function requestadduserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_season->insertUsr($post,$table);
            // var_dump($result);exit;
            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestaddflowersAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        if($this->getRequest()->getPost()){
        	$post = $this->getRequest()->getPost();
            $table="flores";
            $name = $_FILES['cover']['name'];
            if(empty($name)){ 
                print '<script language="JavaScript">'; 
                print 'alert("Agrega una imagen");'; 
                print '</script>'; 
            }else{
                $bytes = $_FILES['cover']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info1 = new SplFileInfo($_FILES['cover']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_flower/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['cover']['tmp_name'],$urldb);
                }
            }
            
            if (!empty($table)&&!empty($urldb)&&!empty($post)) {
            	$result = $this->_flowers->insertFlw($post,$table,$urldb);
            return $this-> _redirect('/panel/flores');
			}else{
            	print '<script language="JavaScript">'; 
                print 'alert("Hay campos incompletos");'; 
                print '</script>'; 
            }            
        }
    }

    public function requestaddtemporadaAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="temporada";
            $result = $this->_temporadas->insertTemporada($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/temporada');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestslideraddAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
    	if($this->getRequest()->getPost()){
    		$post = $this->getRequest()->getPost();
 			$id = $this->_getParam('id');
            $table='slider';
            $name = $_FILES['cover']['name'];
            if(empty($name)){ 
                print '<script language="JavaScript">'; 
                print 'alert("Agrega una imagen");'; 
                print '</script>'; 
            }else{
                $bytes = $_FILES['cover']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info1 = new SplFileInfo($_FILES['cover']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_slider/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['cover']['tmp_name'],$urldb);
                }
            }
            
            if (!empty($table)&&!empty($id)&&!empty($urldb)&&!empty($post)) {
            	$result=$this->_slider->insertSlider($table,$id,$urldb,$post);
            	return $this-> _redirect('/panel/productosdetail/id/'.$id);
            }else{
            	print '<script language="JavaScript">'; 
                print 'alert("Hay campos incompletos");'; 
                print '</script>'; 
            }
        }else {
                return $this-> _redirect('/');
        }
    }

    	// --------------   REQUEST	EDIT-------------------//
	public function requesttarjetaseditAction(){
		$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $table="tarjetas";

        if($this->getRequest()->getPost()){
        	$urldb = $post['urlhidden'];
        	if (!empty($_FILES['cover']['name'])){
                $bytes = $_FILES['cover']['size'];
                $res = $this->formatSizeUnits($bytes);
                if ($res==0) {
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagens supera el maximo de tamaño");'; 
                    print '</script>'; 
                } else {
                    unlink($post['urlhidden']);
                    $info1 = new SplFileInfo($_FILES['cover']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_tarjetas/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['cover']['tmp_name'],$urldb);
                    }
                } 

            
            if (!empty($table)&&!empty($urldb)&&!empty($post)) {
            	$result = $this->_tarjetas->refreshTarjeta($post,$table,$urldb);
                return $this-> _redirect('/panel/tarjeta');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Faltan datos.");'; 
                print '</script>'; 
            }
        }
	}

    public function requestupdateuserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_season->refreshUsr($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdateflowerAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
        	$urldb = $post['urlhidden'];
        	if (!empty($_FILES['cover']['name'])){
                $bytes = $_FILES['cover']['size'];
                $res = $this->formatSizeUnits($bytes);
                if ($res==0) {
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen (PORTADA) supera el maximo de tamaño");'; 
                    print '</script>'; 
                } else {
                    unlink($post['urlhidden']);
                    $info1 = new SplFileInfo($_FILES['cover']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_flower/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['cover']['tmp_name'],$urldb);
                    }
                } 

            $table="flores";
            $result = $this->_flowers->refreshflower($post,$table,$urldb);
            if ($result) {
                return $this-> _redirect('/panel/flores');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdaterecomendacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        if($this->getRequest()->getPost()){
            $post = $this->getRequest()->getPost();
            $table="recomendacion";
            $urldb = $post["imahidden"];
            //var_dump($urldb);exit;
            if(!empty($_FILES["url"]["name"])) {
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if ($res == 0) {
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>';
                } else {
                    
                    $info = new SplFileInfo($_FILES['url']['name']);
                    $url = 'img/img_reco/';
                    $urldb = $url.$info;
                    unlink($post['imahidden']);
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }//end de if
            //var_dump($urldb);exit;
            $result = $this->_reco->refreshRecomen($post,$table,$urldb);
            if ($result) {
                return $this-> _redirect('/panel/recomendaciones');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
            return $this-> _redirect('/panel/recomendaciones');
        }
    }

    public function requestupdateproductoAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        if($this->getRequest()->getPost()){
            $post = $this->getRequest()->getPost();
            //var_dump($post);exit;
            $table="producto";
            $urldb = $post["imahidden"];
            //var_dump($urldb);exit;
            if(!empty($_FILES["url"]["name"])) {
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if ($res == 0) {
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>';
                } else {
                    
                    $info = new SplFileInfo($_FILES['url']['name']);
                    $url = 'img/img_pro/';
                    $urldb = $url.$info;
                    unlink($post['imahidden']);
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }//end de if
            $result = $this->_pro->refreshproduct($post,$table,$urldb);
            if ($result) {
                return $this-> _redirect('/panel/productos');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdatesubrecomendacionesAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="subrecomendaciones";
            $result = $this->_subreco->refreshsubRecomen($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/subrecomendaciones');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdatetemporadaAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="temporada";
            $result = $this->_temporadas->refreshTemporada($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/temporada');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdatesliderAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $table="slider";
        $id = $post['idprod'];

        if($this->getRequest()->getPost()){
        	$urldb = $post['urlhidden'];
        	if (!empty($_FILES['cover']['name'])){
                $bytes = $_FILES['cover']['size'];
                $res = $this->formatSizeUnits($bytes);
                if ($res==0) {
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagens supera el maximo de tamaño");'; 
                    print '</script>'; 
                } else {
                    unlink($post['urlhidden']);
                    $info1 = new SplFileInfo($_FILES['cover']['name']);
                    $ext1 = $info1->getExtension();
                    $url1 = 'img/img_slider/';
                    $urldb = $url1.$info1;
                    move_uploaded_file($_FILES['cover']['tmp_name'],$urldb);
                    }
                } 

            
            if (!empty($table)&&!empty($urldb)&&!empty($post)) {
            	$result = $this->_slider->refreshSlider($post,$table,$urldb);
                return $this-> _redirect('/panel/productosdetail/id/'.$id);
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Faltan datos.");'; 
                print '</script>'; 
            }
        }
    }

    	// --------------   REQUEST	DELETE-----------------//

    public function requestdeleteallAction(){
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

    public function requestdeleteflowersAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="flores";
            $wh="id";
            $flor=$this->_flowers->GetSpecific($id,$table,$wh);
            foreach ($flor as $fw => $val) {
            	$img=$val['imagen'];
            	// var_dump($img);exit;
           		unlink($img);
            }
            
            
            $result = $this->_flowers->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/flores');
            }
        } else {
            return $this-> _redirect('/panel');
        }    
    }

    public function requestdeletetarjetaAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="tarjetas";
            $wh="id";
            $tarjeta=$this->_tarjetas->GetSpecific($id,$table,$wh);
            foreach ($tarjeta as $fw => $val) {
            	$img=$val['imagen'];
            	// var_dump($img);exit;
           		unlink($img);
            }
            
            
            $result = $this->_flowers->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/tarjeta');
            }
        } else {
            return $this-> _redirect('/panel');
        }    
    }

    public function requestdeletetemporadaAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="temporada";
            $wh="id";
            $result = $this->_temporadas->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/temporada');
            }
        } else {
            return $this-> _redirect('/panel');
        }   
    }

    public function requestdeleterecomendacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="recomendacion";
            $wh="id";
            $result = $this->_reco->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/recomendaciones');
            }
            
        } else {
            return $this-> _redirect('/panel/');
        }    
    }

    public function requestdeletesubrecomendacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="subrecomendaciones";
            $wh="id";
            $result = $this->_subreco->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/subrecomendaciones');
            }
        } else {
            return $this-> _redirect('/panel');
        }
    }

    public function requestdeleteproductAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="producto";
            $wh="id";
            $imagen=$this->_pro->GetSpecific($table,$wh,$id);
            foreach ($imagen as $img => $val) {
                $url=$val['imagen'];
                
                if (file_exists($url)) {
                    unlink($url);
                    if (!empty($imagen)&&!empty($id)) {
                        $this->_pro->deleteAll($id,$table,$wh);
                        return $this-> _redirect('/panel/productos');
                    }else {
                        return $this-> _redirect('/panel');
                    }   
                }else{
                    $this->_pro->deleteAll($id,$table,$wh);
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen en el servidor no existe");'; 
                    print '</script>';
                    print '<a href="/panel/productos">Regresar a productos</a>"'; 
                }               
            }
        }   
    }

    public function requestdeletesliderAction(){
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	if($this->_hasParam('id')){
    		$id =  $this->_getParam('id');

    		$table="slider";
    		$wh="id";
    		$imagen=$this->_slider->GetSpecific($table,$wh,$id);
    		foreach ($imagen as $img => $val) {
    			$url=$val['imagen'];
    			
    			if (file_exists($url)) {
    				unlink($url);
    				if (!empty($imagen)&&!empty($id)) {
    					$result = $this->_slider->deleteAll($id,$table,$wh);
    					return $this-> _redirect('/panel/productos');
    				}else {
    					return $this-> _redirect('/panel');
    				}   
    			}else{
    				print '<script language="JavaScript">'; 
    				print 'alert("La imagen no existe");'; 
    				print '</script>'; 
    			}         		
    		}
    	}
    	
    }
    // --------------------   REQUEST END	-----------------------//

    public function requestflortemporadaAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){

            $id = $post["id"];
            $wh='fkflor';
            $table='floresxtemp';
            $result=$this->_temporadas->GetSpecific($table,$wh,$id);

            if ($result) {
                $result1=$this->_temporadas->deleteAll($id,$table,$wh);
                if ($result1) {
                   foreach ($post["option"] as $key) {
                    $tempo = $key;
                    $result2=$this->_temporadas->InsertTemporadaFlor($id,$tempo,$table);
                    }
                    return $this-> _redirect('/panel/flores/');
                } else {
                    print '<script language="JavaScript">'; 
                    print 'alert("Los datos no se han podido actualizar");'; 
                    print '</script>'; 
                    print '<a href="/home/flores">Regresar</a>';
                }
                
                
            } else {
                foreach ($post["option"] as $key) {
                $tempo = $key;
                $result2=$this->_temporadas->InsertTemporadaFlor($id,$tempo,$table);  
                }

                return $this-> _redirect('/panel/flores/');
            }
        } else {
            echo json_encode(array("id"=>"0","name"=>"No disponible"));
        } 
    }

    public function requesttarjetaproductoAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){

            $id = $post["id"];
            $wh='fktarjeta';
            $table='tarpro';
            $result=$this->_tarjetas->GetSpecific($table,$wh,$id);

            if ($result) {
                $result1=$this->_tarjetas->deleteAll($id,$table,$wh);
                if ($result1) {
                   foreach ($post["option"] as $key) {
                    $tempo = $key;
                    $result2=$this->_tarjetas->insertTarjetaProducto($id,$tempo,$table);
                    }
                    return $this-> _redirect('/panel/tarjeta/');
                } else {
                    print '<script language="JavaScript">'; 
                    print 'alert("Los datos no se han podido actualizar");'; 
                    print '</script>'; 
                    print '<a href="/home/tarjeta">Regresar</a>';
                }
                
                
            } else {
                foreach ($post["option"] as $key) {
                $tempo = $key;
                $result2=$this->_tarjetas->insertTarjetaProducto($id,$tempo,$table);  
                }

                return $this-> _redirect('/panel/tarjeta/');
            }
        } else {
            echo json_encode(array("id"=>"0","name"=>"No disponible"));
        } 
    }

        // Funciones
    public function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
    }//formatSizeUnits
    
}