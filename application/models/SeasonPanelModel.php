<?php

class Application_Model_SeasonPanelModel extends Zend_Db_Table_Abstract{

	// --------------------------------INSERTS

	public function insertUsr($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $encri = openssl_digest($post["pword"],"sha512");
            $datasave = array(
                'fkroles'=>$post['rol'],
            	'nombre'=>$post['name'],
            	'ap'=>$post['apa'],
            	'am'=>$post['ama'],
            	'direccion'=>$post['dir'],
            	'telefono'=>$post['phone'],
            	'correo'=>$post['mail'],
            	'passw'=>$encri); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }//Insert
	
	// --------------------------------UPDATES
	public function refreshUsr($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $encri = openssl_digest($post["pword"],"sha512");
            $qry = $db->query("UPDATE $table SET nombre = ? , ap = ? , am = ? , direccion = ? , telefono = ? , correo = ? , passw = ? WHERE id = ?",array(
               	$post['name'],
            	$post['apa'],
            	$post['ama'],
            	$post['dir'],
            	$post['phone'],
            	$post['mail'],
            	$encri,
                $post["ids"]));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateUsrSession($post,$table,$wh,$id){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET nombre = ? , ap = ? , am = ? , direccion = ? , telefono = ? , correo = ? WHERE $wh = ?",array(
                $post['name'],
                $post['apa'],
                $post['ama'],
                $post['dir'],
                $post['phone'],
                $post['mail'],
                $id));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateUsrPassw($post,$table,$wh){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $cripted = openssl_digest($post['pword'],"sha512");
            $qry = $db->query("UPDATE $table SET passw = ? WHERE $wh = ?",array($cripted,$post['id']));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }
	
	// --------------------------------DELETS

	public function deleteAll($id,$table,$wh){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $var =  $db->query ("DELETE from $table where $wh = ? ",array($id));
            $db->closeConnection();
            return $var;
        } catch (Exception $e) {
            echo $e;
        }
    }//deleteUsr

    // --------------------------------GET

	public function GetAll($table){
		 try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT * FROM $table");
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
	}

    public function GetSpecific($table,$wh,$id){
         try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT * FROM $table WHERE $wh = ?",array($id));
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    }

    // --------------------------------Login

    public function Validar($post){

        try {
            //var_dump($post);exit;
            $db = Zend_Db_Table::getDefaultAdapter();
            $p = openssl_digest($post["passw"],"sha512");
            $valiu = $db->query("SELECT * FROM usuario WHERE correo = ? and passw = ?",
        array(
            $post["mail"],
            $p));       
        $row = $valiu->fetchAll();             
                    $db->closeConnection();               
                    return $row;
                    //var_dump($valiu);exit;
        } catch (Exception $e) {
            echo $e;
        }//end try and catch
        
        

    }//fin de validar

    
}