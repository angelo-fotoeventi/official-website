<?php
include_once '../common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'verifica_admin.php';

if(empty($_GET['id_categoria'])){
    header('Location: ../error.php?code=1');
    exit();
}

$album = array();
$album['nome'] = '';
$album['id_categoria'] = $_GET['id_categoria'];

$error = array();

if(array_key_exists('aggiungi', $_POST)){
    if( empty($_POST['nome']) ){ $error[]='nome'; }else{ $album['nome'] = $_POST['nome']; }
    
    if( !count($error) ){
        $managerSql->start_transaction();
        $id_album = $managerSql->aggiungi_album($album);
        if( $id_album ){
            $managerSql->transaction_commit();
            header('Location: ../galleryadmin_categorie.php?id='.$_GET['id_categoria']);
            exit();
        }else{
            $managerSql->transaction_rollback();
            header('Location: ../error.php?code=7');
            exit();
        }
    }else{
        header('Location: ../error.php?code=7');
            exit();
    }
     
}

?>