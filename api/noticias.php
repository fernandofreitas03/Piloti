<?php

include_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['logado']) && $_POST['logado'] == 'true') {

        if (isset($_POST['criar_noticia'])) {

            $createStmt = $pdo->prepare('INSERT INTO noticias (titulo, conteudo) VALUES (?, ?)');
            $createStmt->execute([$_POST['titulo'], $_POST['conteudo']]);

            echo json_encode(['message' => 'Notícia criada com sucesso']);
        } elseif (isset($_POST['atualizar_noticia'])) {

            $updateStmt = $pdo->prepare('UPDATE noticias SET titulo = ?, conteudo = ? WHERE id = ?');
            $updateStmt->execute([$_POST['titulo'], $_POST['conteudo'], $_POST['id']]);


            echo json_encode(['message' => 'Notícia atualizada com sucesso']);
        } elseif (isset($_POST['excluir_noticia'])) {
            $deleteStmt = $pdo->prepare('DELETE FROM noticias WHERE id = ?');
            $deleteStmt->execute([$_POST['id']]);

            echo json_encode(['message' => 'Notícia excluída com sucesso']);
        } else {
            $stmd = $pdo->query('SELECT * FROM noticias');
            echo json_encode($stmd->fetch());
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Usuário não logado']);
    }
}
