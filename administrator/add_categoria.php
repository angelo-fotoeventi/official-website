<?php
include_once '../common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'verifica_admin.php';

$categoria = array();
$categoria['nome'] = '';

$error = array();

if(array_key_exists('aggiungi', $_POST)){
    if( empty($_POST['nome']) ){ $error[]='nome'; }else{ $categoria['nome'] = $_POST['nome']; }
    
    if( !count($error) ){
        $managerSql->start_transaction();
        $id_categoria = $managerSql->aggiungi_categoria($categoria);
        if( $id_categoria ){
            $managerSql->transaction_commit();
            header('Location: ../galleryadmin_home.php');
            exit();
        }else{
            $managerSql->transaction_rollback();
            header('Location: ../error.php?code=3');
            exit();
        }
    }else{
        header('Location: ../error.php?code=3');
        exit();
    }
     
}

?>