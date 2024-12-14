<?php
// Configura o timezone para o Brasil
date_default_timezone_set('America/Sao_Paulo');

// Data atual formatada para o Brasil
$dataEnvio = date('l d/m/Y'); // Exemplo: segunda-feira 10/10/2024

// Tradução dos dias da semana
$diasSemana = [
    'Sunday' => 'domingo',
    'Monday' => 'segunda-feira',
    'Tuesday' => 'terça-feira',
    'Wednesday' => 'quarta-feira',
    'Thursday' => 'quinta-feira',
    'Friday' => 'sexta-feira',
    'Saturday' => 'sábado'
];

// Substitui o nome do dia pela versão em português
$dataEnvio = str_replace(array_keys($diasSemana), array_values($diasSemana), $dataEnvio);

// Estrutura inicial dos dados
$data = [
    "equipes_ativas" => $_POST['equipes'],
    "atendimentos_possiveis" => $_POST['atendimentos'],
    "data_envio" => $dataEnvio, // Adiciona a data de envio
    "colaboradores_afastados" => []
];

// Adiciona colaboradores ao array
if (isset($_POST['colaboradores']['nome'])) {
    foreach ($_POST['colaboradores']['nome'] as $index => $nome) {
        $data["colaboradores_afastados"][] = [
            "nome" => $nome,
            "motivo" => $_POST['colaboradores']['motivo'][$index],
            "data_retorno" => date('d/m/Y', strtotime($_POST['colaboradores']['data_retorno'][$index]))
        ];
    }
}

// Salva os dados no arquivo JSON
file_put_contents('dados.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Informações salvas com sucesso!";
?>
