<?php

include_once '../common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'verifica_admin.php';

if( empty($_GET['id']) ){
    header('Location: ../error.php?code=1');
    exit();
}

$album = $managerSql->get_album($_GET['id']);

$lista_foto = $managerSql->lista_foto_by_album($album['id_album']);
foreach ($lista_foto as $foto) {
    $managerSql->elimina_foto($foto['id_foto']);
    unlink("../gallery/foto/{$foto['id_foto']}.jpg");
}


if ( $album && $managerSql->elimina_album($_GET['id']) ) {
    if(file_exists("../gallery/copertine_album/{$album['id_album']}.png")){
        unlink("../gallery/copertine_album/{$album['id_album']}.png");
    }
    header('Location: ../galleryadmin_categorie.php?id='.$album['id_categoria']);
    exit();
}else{
    header('Location: ../error.php?code=10');
    exit();
}

?>
