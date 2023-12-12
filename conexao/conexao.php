<?php

const host = "localhost";
const dbname = "piloti";
const user  = "root";
const senha = "123456";

try {
    $pdo = new PDO('mysql:host=' . host . ';dbname=' . dbname, user, senha, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Erro ao conectar ao banco de dados";
    echo $e;
}
