<?php

class Usuario {

    private $idusuario;
    private $login;
    private $senha;
    private $dtcadastro;

    public function __construct($login = "", $senha = "") {
        $this->setLogin($login);
        $this->setSenha($senha);
    }

    public function getIdUsuario() {
        return $this->idusuario;
    }

    public function setIdUsuario($param) {
        $this->idusuario = $param;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($param) {
        $this->login = $param;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($param) {
        $this->senha = $param;
    }

    public function getDtCadastro() {
        return $this->dtcadastro;
    }

    public function setDtCadastro($param) {
        $this->dtcadastro = $param;
    }

    public function loadById($id) {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM usuarios WHERE id = :ID", array(
            ":ID" => $id
        ));

        if (isset($results[0])) {               // if (count($results) > 0)
            $this->setData($results[0]);
        }

    }

    public static function getList() {
        
        $sql = new Sql();
        return $sql->select("SELECT * FROM usuarios ORDER BY login");
    }

    public static function search($login) {
        
        $sql = new Sql();
        return $sql->select("SELECT * FROM usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
                    ':SEARCH' => "%" . $login . "%"
        ));
    }

    public function login($login, $senha) {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM usuarios WHERE login = :LOGIN AND senha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $senha
        ));

        if (isset($results[0])) {
            $this->setData($results[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos!");
        }
    }

    public function setData($data) {

        $this->setIdUsuario($data['id']);
        $this->setLogin($data['login']);
        $this->setSenha($data['senha']);
        $this->setDtCadastro(new DateTime($data['dtcadastro']));
    }

    public function insert() {
        $sql = new Sql();

        // chama procedure no mysql
        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN" => $this->getLogin(),
            ":PASSWORD" => $this->getSenha()
        ));

        if (count($result) > 0) {
            $this->setData($result[0]);
        }
    }

    public function update($login, $senha) {
        $this->setLogin($login);
        $this->setSenha($senha);

        $sql = new Sql();

        $sql->query("UPDATE usuarios SET login = :LOGIN AND senha = :PASSWORD WHERE id = :ID", array(
            ":LOGIN" => $this->getLogin(),
            ":PASSWORD" => $this->getSenha(),
            ":ID" => $this->getIdUsuario()
        ));
    }

    public function delete() {
        $sql = new Sql();

        $sql->query("DELETE FROM usuarios WHERE id = :ID", array(
            ":ID" => $this->getIdUsuario()
        ));

        $this->setIdUsuario(0);
        $this->setLogin("");
        $this->setSenha("");
        $this->setDtCadastro(new DateTime());
    }

    public function __toString() {
        return json_encode(array(
            "id" => $this->getIdUsuario(),
            "login" => $this->getLogin(),
            "senha" => $this->getSenha(),
            "dtcadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }

}

?>