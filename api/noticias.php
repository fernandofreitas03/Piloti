<?php

include_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['logado']) && $_POST['logado'] == 'true') {

        $stmd = $pdo->query('select * from noticias');
        echo json_encode($stmd->fetch());
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Usuario nao logado']);
    }
}
