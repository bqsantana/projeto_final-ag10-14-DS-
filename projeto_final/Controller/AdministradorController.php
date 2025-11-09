<?php
if(!isset($_SESSION)) {
    session_start();
}

class AdministradorController {
    
    public function login($cpf, $senha) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Administrador.php';
        $administrador = new Administrador();
        
        if($administrador->carregarAdministrador($cpf)) {
            if($administrador->getSenha() == $senha) {
                $_SESSION['Administrador'] = serialize($administrador);
                return true;
            }
        }
        return false;
    }
    
    public function gerarLista() {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Administrador.php';
        $adm = new Administrador();
        return $adm->listaCadastrados();
    }
}
?>