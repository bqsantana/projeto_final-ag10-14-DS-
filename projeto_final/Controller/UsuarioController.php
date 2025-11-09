<?php
if(!isset($_SESSION)) {
    session_start();
}

class UsuarioController {
    
    public function inserir($nome, $cpf, $email, $senha) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        
        $r = $usuario->inserirBD();
        if($r) {
            $_SESSION['Usuario'] = serialize($usuario);
        }
        return $r;
    }
    
    public function atualizar($id, $nome, $cpf, $email, $dataNascimento) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setID($id);
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setDataNascimento($dataNascimento);
        
        $r = $usuario->atualizarBD();
        if($r) {
            $_SESSION['Usuario'] = serialize($usuario);
        }
        return $r;
    }
    
    public function login($cpf, $senha) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
        $usuario = new Usuario();
        
        if($usuario->carregarUsuario($cpf)) {
            if($usuario->getSenha() == $senha) {
                $_SESSION['Usuario'] = serialize($usuario);
                return true;
            }
        }
        return false;
    }
    
    public function gerarLista() {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
        $u = new Usuario();
        return $u->listaCadastrados();
    }
	
	public function carregarUsuarioPorId($id) {
		require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
		$usuario = new Usuario();
		
		if($usuario->carregarUsuarioPorId($id)) {
			return $usuario;
		} else {
			return null;
		}
	}
}
?>