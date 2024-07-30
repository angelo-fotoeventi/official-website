<?php

include_once '../common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'verifica_admin.php';


if( !array_key_exists('lista_id', $_GET) ){
    header('Location: ../error.php?code=1');
    exit();
}

/*
$foto = $managerSql->get_foto($_GET['id']);

$managerSql->start_transaction();

if ( $foto && $managerSql->elimina_foto($_GET['id']) && unlink("../foto/{$foto['id_foto']}.jpg") ) {
    $managerSql->transaction_commit();
    header('Location: edit_album.php?id='.$foto['id_album']);
    exit();
}else{
    $managerSql->transaction_rollback();
    header('Location: error.php?code=11');
    exit();
}
*/
$lista_id = $_GET['lista_id'];

foreach ($lista_id as $id) {
    $foto = $managerSql->get_foto($id);

    if ( !$foto || !$managerSql->elimina_foto($id) || !unlink("../gallery/foto/{$foto['id_foto']}.jpg") ) {
        header('Location: ../error.php?code=11');
        exit();
    }
}
header('Location: ../galleryadmin_album.php?id='.$foto['id_album']);
exit();

?>
