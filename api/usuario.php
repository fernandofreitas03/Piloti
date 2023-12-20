<?php

include_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['create_user'])) {

        $createStmt = $pdo->prepare('INSERT INTO usuario (USUARIO, EMAIL, CPF, SENHA) VALUES (?, ?, ?, ?)');
        $createStmt->execute([$_POST['usuario'], $_POST['email'], $_POST['cpf'], $_POST['senha']]);

        echo json_encode(['message' => 'Usuário criado com sucesso']);
    } elseif (isset($_POST['update_user'])) {

        $updateStmt = $pdo->prepare('UPDATE usuario SET USUARIO = ?, EMAIL = ?, CPF = ?, SENHA = ? WHERE ID = ?');
        $updateStmt->execute([$_POST['usuario'], $_POST['email'], $_POST['cpf'], $_POST['senha'], $_POST['id']]);

        echo json_encode(['message' => 'Usuário atualizado com sucesso']);
    } elseif (isset($_POST['delete_user'])) {
        $deleteStmt = $pdo->prepare('DELETE FROM usuario WHERE ID = ?');
        $deleteStmt->execute([$_POST['id']]);

        echo json_encode(['message' => 'Usuário excluído com sucesso']);
    } elseif (isset($_POST['email']) && isset($_POST['senha'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $stmd = $pdo->prepare('SELECT * FROM usuario WHERE email =? AND senha =?');
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
            echo json_encode(['error' => 'Email inválido']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Email ou senha incorretos']);
    }
}
