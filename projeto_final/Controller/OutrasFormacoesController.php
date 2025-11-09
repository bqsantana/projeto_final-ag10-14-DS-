<?php
if(!isset($_SESSION)) {
    session_start();
}

class OutrasFormacoesController {
    
    public function inserir($inicio, $fim, $descricao, $idusuario) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/OutrasFormacoes.php';
        $of = new OutrasFormacoes();
        $of->setInicio($inicio);
        $of->setFim($fim);
        $of->setDescricao($descricao);
        $of->setIdUsuario($idusuario);
        
        return $of->inserirBD();
    }
    
    public function remover($id) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/OutrasFormacoes.php';
        $of = new OutrasFormacoes();
        return $of->excluirBD($id);
    }
    
    public function gerarLista($idusuario) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/OutrasFormacoes.php';
        $of = new OutrasFormacoes();
        return $of->listarFormacoes($idusuario);
    }
}
?>