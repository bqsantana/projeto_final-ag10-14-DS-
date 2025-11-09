<?php
class Usuario {
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha;

    // Getters e Setters
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    public function setCPF($cpf) { $this->cpf = $cpf; }
    public function getCPF() { return $this->cpf; }
    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }
    public function setDataNascimento($dataNascimento) { $this->dataNascimento = $dataNascimento; }
    public function getDataNascimento() { return $this->dataNascimento; }
    public function setSenha($senha) { $this->senha = $senha; }
    public function getSenha() { return $this->senha; }

    // Métodos específicos
    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        $sql = "INSERT INTO usuario (nome, cpf, email, senha) 
                VALUES ('".$this->nome."', '".$this->cpf."', '".$this->email."', '".$this->senha."')";

        if ($conn->query($sql) === TRUE) {
            $this->id = $conn->insert_id;
            $conn->close();
            return TRUE;
        } else {
            $conn->close();
            return FALSE;
        }
    }

    public function carregarUsuario($cpf) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        $sql = "SELECT * FROM usuario WHERE cpf = '".$cpf."'";
        $re = $conn->query($sql);
        $r = $re->fetch_object();
        
        if($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function atualizarBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        $sql = "UPDATE usuario 
                SET nome = '".$this->nome."', 
                    cpf = '".$this->cpf."', 
                    dataNascimento = '".$this->dataNascimento."', 
                    email = '".$this->email."' 
                WHERE idusuario = '".$this->id."'";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            return TRUE;
        } else {
            $conn->close();
            return FALSE;
        }
    }

    // Método para listar usuários (do admin)
    public function listaCadastrados() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        $sql = "SELECT idusuario, nome FROM usuario";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
	
	public function carregarUsuarioPorId($id) {
		require_once 'ConexaoBD.php';
		$con = new ConexaoBD();
		$conn = $con->conectar();
	
		$sql = "SELECT * FROM usuario WHERE idusuario = '".$id."'";
		$re = $conn->query($sql);
		$r = $re->fetch_object();
		
		if($r != null) {
			$this->id = $r->idusuario;
			$this->nome = $r->nome;
			$this->email = $r->email;
			$this->cpf = $r->cpf;
			$this->dataNascimento = $r->dataNascimento;
			$this->senha = $r->senha;
			$conn->close();
			return true;
		} else {
			$conn->close();
			return false;
		}
	}
}
?>