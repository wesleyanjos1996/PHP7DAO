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
        {
            $row = $resultado[0];

            $this->setIdusuario($row["idusuario"]);
            $this->setDeslogin($row["deslogin"]);
            $this->setDessenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));
        }
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