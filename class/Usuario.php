<?php

class Usuario
{
    //Atributos
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    //Métodos
    public function laodById($id)
    {
        $sql = new SQL();
        $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

        if(count($resultado) > 0)
        {$this->setData($resultado[0]);}
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    public static function getList()
    {
        $sql = new SQL();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login)
    {
        $sql = new SQL();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(":SEARCH"=>"%".$login."%"));
    }

    public function login($login, $password)
    {
        $sql = new SQL();
        $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($resultado) > 0)
        {$this->setData($resultado[0]);}
        else
        {throw new Exception("Login e/ou senha inválidos.");}
    }

    public function insert()
    {
        $sql = new SQL();
        $resultado = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha()
        ));

        if(count($resultado) > 0)
        {$this->setData($resultado[0]);}
    }

    public function setData($data)
    {
        $this->setIdusuario($data["idusuario"]);
        $this->setDeslogin($data["deslogin"]);
        $this->setDessenha($data["dessenha"]);
        $this->setDtcadastro(new DateTime($data["dtcadastro"]));
    }

    public function __construct($login = "", $password = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function update($login, $password)
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new SQL();

        /*$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID LIMIT 1", array(
            ":LOGIN" => $this->getDeslogin(),
            ":PASSWORD" => $this->getDessenha(),
            ":ID" => $this->getIdusuario()
        ));*/
        $sql->select("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID LIMIT 1", array(
            ":LOGIN" => $this->getDeslogin(),
            ":PASSWORD" => $this->getDessenha(),
            ":ID" => $this->getIdusuario()
        ));
    }

    public function delete()
    {
        $sql = new SQL();
        /*$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$this->getIdusuario()
        ));*/

        $sql->select("DELETE FROM tb_usuarios WHERE idusuario = :ID LIMIT 1", array(
            ":ID"=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }

    //Getters and Setters
    public function getIdusuario(){return $this->idusuario;}
    public function setIdusuario($idusuario){$this->idusuario=$idusuario;}

    public function getDeslogin(){return $this->deslogin;}
    public function setDeslogin($deslogin){$this->deslogin=$deslogin;}

    public function getDessenha(){return $this->dessenha;}
    public function setDessenha($dessenha){$this->dessenha=$dessenha;}

    public function getDtcadastro(){return $this->dtcadastro;}
    public function setDtcadastro($dtcadastro){$this->dtcadastro=$dtcadastro;}
}

?>