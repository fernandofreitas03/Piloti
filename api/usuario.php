<?php

include_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) && isset($_POST['senha'])) {

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $stmd = $pdo->prepare('select * from usuario where email =?  and senha =?');
            $stmd->execute([$_POST['email'], $_POST['senha']]);

            while ($result = $stmd->fetch()) {
                echo json_encode([
                    'ID' => $result['ID'],
                    'USUARIO' => $result['USUARIO'],
                    'EMAIL' => $result['EMAIL'],
                    'CPF' =>  $result['CPF'],
                    'LOGADO' => true
                ]);
            }
        } else {

            echo json_encode(['error' => 'Email invalido']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Email ou senha incorretos']);
    }
}
