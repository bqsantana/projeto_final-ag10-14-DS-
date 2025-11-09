<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Visualizar Cadastro</title>
    <style>
        .info-section {
            margin-bottom: 30px;
        }
        .info-item {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/Usuario.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/FormacaoAcad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/OutrasFormacoes.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Model/ExperienciaProfissional.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Controller/UsuarioController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Controller/FormacaoAcadController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Controller/OutrasFormacoesController.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/projeto_final/Controller/ExperienciaProfissionalController.php';
    
    if(!isset($_SESSION)) {
        session_start();
    }

    $idUsuario = $_POST['idUsuario'] ?? null;
    if ($idUsuario) {
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->carregarUsuarioPorId($idUsuario);
    }
    ?>
    
    <header class="w3-container w3-padding-32 w3-center">
        <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">
            <?php echo $usuario ? $usuario->getNome() . ' - Currículo' : 'Currículo Não Encontrado'; ?>
        </h1>
    </header>

    <div class="w3-padding-128 w3-content w3-text-grey">
        <?php if($usuario): ?>
        
        <!-- Dados Pessoais -->
        <div class="info-section">
            <h2 class="w3-text-cyan w3-panel w3-light-grey w3-padding">Dados Pessoais</h2>
            <div class="w3-container w3-white w3-text-grey w3-margin" style="width:70%">
                <div class="info-item">
                    <strong>Nome:</strong> <?php echo $usuario->getNome(); ?>
                </div>
                <div class="info-item">
                    <strong>CPF:</strong> <?php echo $usuario->getCPF(); ?>
                </div>
                <div class="info-item">
                    <strong>Email:</strong> <?php echo $usuario->getEmail(); ?>
                </div>
                <div class="info-item">
                    <strong>Data de Nascimento:</strong> <?php echo $usuario->getDataNascimento(); ?>
                </div>
            </div>
        </div>

        <!-- Formação Acadêmica -->
        <div class="info-section">
            <h2 class="w3-text-cyan w3-panel w3-light-grey w3-padding">Formação Acadêmica</h2>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <?php
                    $formacaoController = new FormacaoAcadController();
                    $formacoes = $formacaoController->gerarLista($idUsuario);
                    if($formacoes != null && $formacoes->num_rows > 0) {
                        while($row = $formacoes->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 15%;">'.date('d/m/Y', strtotime($row->inicio)).'</td>';
                            echo '<td style="width: 15%;">'.($row->fim ? date('d/m/Y', strtotime($row->fim)) : 'Atual').'</td>';
                            echo '<td style="width: 70%; text-align: left; padding-left: 20px;">'.$row->descricao.'</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3" class="w3-center">Nenhuma formação acadêmica cadastrada</td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- Outras Formações -->
        <div class="info-section">
            <h2 class="w3-text-cyan w3-panel w3-light-grey w3-padding">Outras Formações</h2>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <?php
                    $outrasFormacoesController = new OutrasFormacoesController();
                    $outrasFormacoes = $outrasFormacoesController->gerarLista($idUsuario);
                    if($outrasFormacoes != null && $outrasFormacoes->num_rows > 0) {
                        while($row = $outrasFormacoes->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 15%;">'.date('d/m/Y', strtotime($row->inicio)).'</td>';
                            echo '<td style="width: 15%;">'.($row->fim ? date('d/m/Y', strtotime($row->fim)) : 'Atual').'</td>';
                            echo '<td style="width: 70%; text-align: left; padding-left: 20px;">'.$row->descricao.'</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3" class="w3-center">Nenhuma outra formação cadastrada</td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- Experiência Profissional -->
        <div class="info-section">
            <h2 class="w3-text-cyan w3-panel w3-light-grey w3-padding">Experiência Profissional</h2>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Empresa</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <?php
                    $experienciaController = new ExperienciaProfissionalController();
                    $experiencias = $experienciaController->gerarLista($idUsuario);
                    if($experiencias != null && $experiencias->num_rows > 0) {
                        while($row = $experiencias->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 15%;">'.date('d/m/Y', strtotime($row->inicio)).'</td>';
                            echo '<td style="width: 15%;">'.($row->fim ? date('d/m/Y', strtotime($row->fim)) : 'Atual').'</td>';
                            echo '<td style="width: 20%;">'.$row->empresa.'</td>';
                            echo '<td style="width: 50%; text-align: left; padding-left: 20px;">'.$row->descricao.'</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4" class="w3-center">Nenhuma experiência profissional cadastrada</td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <?php else: ?>
        <div class="w3-panel w3-red">
            <h3>Erro</h3>
            <p>Usuário não encontrado.</p>
        </div>
        <?php endif; ?>
    </div>

    <div class="w3-padding-128 w3-content w3-text-grey">
        <form action="/projeto_final/Controller/Navegacao.php" method="post" class="w3-container w3-light-grey w3-text-blue w3-margin w3-center" style="width: 30%;">
            <div class="w3-row w3-section">
                <div>
                    <button name="btnVoltarLista" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%;">
                        Voltar para a Lista
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>