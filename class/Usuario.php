<?php

    class Usuario{
        
        private $idusuario, $txtlogin, $txtsenha, $dtcadastro;
        
        
        public function getIdusuario() {
            return $this->idusuario;
        }

        public function getTxtlogin() {
            return $this->txtlogin;
        }

        public function getTxtsenha() {
            return $this->txtsenha;
        }

        public function getDtcadastro() {
            return $this->dtcadastro;
        }

        public function setIdusuario($idusuario) {
            $this->idusuario = $idusuario;
        }

        public function setTxtlogin($txtlogin) {
            $this->txtlogin = $txtlogin;
        }

        public function setTxtsenha($txtsenha) {
            $this->txtsenha = $txtsenha;
        }

        public function setDtcadastro($dtcadastro) {
            $this->dtcadastro = $dtcadastro;
        }
        
        public function loadById($id){
            $sql = new Sql();
            $res = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :id", array(":id"=>$id));
            
            if(isset($res[0])){
                $this->setData($res[0]);
            }
            
        }
        
        public static function getList(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios ORDER BY txtlogin");
        }
        
        public static function search($login){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios WHERE txtlogin LIKE :search ORDER BY txtlogin", array(':search'=>"%".$login."%") );
        }
        
        public function login($login, $pass){
            $sql = new Sql();
            $res = $sql->select("SELECT * FROM tb_usuarios WHERE txtlogin = :login AND txtsenha = :pass", array(":login"=>$login, ":pass"=>$pass));
            
            if(isset($res[0])){
                
                $this->setData($res[0]);
            }else{
                throw new Exception("Login e/ou senha inválidos");
            }
        }
        
        public function setData($data){
            $this->setIdusuario($data['idusuario']);
            $this->setTxtlogin($data['txtlogin']);
            $this->setTxtsenha($data['txtsenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));
        }
        
        public function insert(){
            $sql = new Sql();
            
            $res = $sql->select("CALL sp_usuarios_insert(:login, :senha)", array(':login'=>$this->getTxtlogin(),':senha'=>$this->getTxtsenha()));
            
            if(count($res)>0){
                $this->setData($res[0]);
            }
        }
        
        public function __construct($login="", $pass="") {
            $this->setTxtlogin($login);
            $this->setTxtsenha($pass);
        }
        
        public function __toString() {
            return json_encode(array(
                'idusuario'=> $this->getIdusuario(),
                'txtlogin'=> $this->getTxtlogin(),
                'txtsenha'=> $this->getTxtsenha(),
                'dtcadastro'=> $this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }


        
    }

?>