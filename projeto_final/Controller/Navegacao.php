<?php
if(!isset($_SESSION)) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/FormacaoAcad.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/ExperienciaProfissional.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/OutrasFormacoes.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Administrador.php';

if(isset($_POST["btnPrimeiroAcesso"])) {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/primeiroAcesso.php";
} 
elseif(isset($_POST["btnCadastrar"])) {
    require_once "UsuarioController.php";
    $uController = new UsuarioController();
    
    if($uController->inserir($_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"], $_POST["txtSenha"])) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroRealizado.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroNaoRealizado.php";
    }
} 
elseif(isset($_POST["btnLogin"])) {
    require_once "UsuarioController.php";
    $uController = new UsuarioController();
    
    if($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/principal.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroNaoRealizado.php";
    }
} 
elseif(isset($_POST["btnAtualizar"])) {
    require_once "UsuarioController.php";
    $uController = new UsuarioController();
    
    if($uController->atualizar($_POST["txtID"], $_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"], 
                               date("Y-m-d", strtotime($_POST["txtData"])))) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/atualizacaoRealizada.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/operacaoNaoRealizada.php";
    }
} 
elseif(isset($_POST["btnAddFormacao"])) {
    require_once "FormacaoAcadController.php";
    $fController = new FormacaoAcadController();
    
    // CORREÇÃO: Agora a classe Usuario já está carregada
    if($fController->inserir(date("Y-m-d", strtotime($_POST["txtInicioFA"])),
                            date("Y-m-d", strtotime($_POST["txtFimFA"])),
                            $_POST["txtDescFA"],
                            unserialize($_SESSION["Usuario"])->getID())) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroRealizado.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroNaoRealizado.php";
    }
} 
elseif(isset($_POST["btnExcluirFA"])) {
    require_once "FormacaoAcadController.php";
    $fController = new FormacaoAcadController();
    
    if($fController->remover($_POST["id"])) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/informacaoExcluida.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/operacaoNaoRealizada.php";
    }
} 
elseif(isset($_POST["btnAddOF"])) {
    require_once "OutrasFormacoesController.php";
    $ofController = new OutrasFormacoesController();
    
    if($ofController->inserir(date("Y-m-d", strtotime($_POST["txtInicioOF"])),
                             date("Y-m-d", strtotime($_POST["txtFimOF"])),
                             $_POST["txtDescOF"],
                             unserialize($_SESSION["Usuario"])->getID())) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroRealizado.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/cadastroNaoRealizado.php";
    }
} 
elseif(isset($_POST["btnExcluirOF"])) {
    require_once "OutrasFormacoesController.php";
    $ofController = new OutrasFormacoesController();
    
    if($ofController->remover($_POST["idOF"])) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/informacaoExcluida.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/operacaoNaoRealizada.php";
    }
}
elseif(isset($_POST["btnAddEP"])) {
    require_once "ExperienciaProfissionalController.php";
    $epController = new ExperienciaProfissionalController();
    
    // CORREÇÃO: Agora a classe Usuario já está carregada
    if($epController->inserir(date("Y-m-d", strtotime($_POST["txtInicioEP"])),
                             date("Y-m-d", strtotime($_POST["txtFimEP"])),
                             $_POST["txtEmpEP"],
                             $_POST["txtDescEP"],
                             unserialize($_SESSION["Usuario"])->getID())) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/informacaoInserida.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/operacaoNaoRealizada.php";
    }
} 
elseif(isset($_POST["btnExcluirEP"])) {
    require_once "ExperienciaProfissionalController.php";
    $epController = new ExperienciaProfissionalController();
    
    if($epController->remover($_POST["idEP"])) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/informacaoExcluida.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/operacaoNaoRealizada.php";
    }
} 
elseif(isset($_POST["btnLoginADM"])) {
    require_once "AdministradorController.php";
    $aController = new AdministradorController();
    
    if($aController->login($_POST["txtLoginADM"], $_POST["txtSenhaADM"])) {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMPrincipal.php";
    } else {
        include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMLogin.php";
    }
} 
elseif(isset($_POST["btnListarCadastrados"])) {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMListarCadastrados.php";
} 
elseif(isset($_POST["btnVoltar"])) {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMPrincipal.php";
} 
elseif(isset($_POST["btnADM"])) {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMLogin.php";
} 
elseif(isset($_POST["btnVisualizarCadastro"])) {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMVisualizarCadastro.php";
} 
elseif(isset($_POST["btnVoltarLista"])) {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/ADMListarCadastrados.php";
}
else {
    include_once $_SERVER['DOCUMENT_ROOT']."/projeto_final/View/login.php";
}
?>