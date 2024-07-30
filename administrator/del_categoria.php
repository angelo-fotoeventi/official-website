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

$categoria = $managerSql->get_categoria($_GET['id']);

$lista_album = $managerSql->lista_album_by_categoria($categoria['id_categoria']);
foreach ($lista_album as $album) {
    $lista_foto = $managerSql->lista_foto_by_album($album['id_album']);
    foreach ($lista_foto as $foto) {
        $managerSql->elimina_foto($foto['id_foto']);
        unlink("../gallery/foto/{$foto['id_foto']}.jpg");
    }
    
    if(file_exists("../gallery/copertine_album/{$album['id_album']}.png")){
        unlink("../gallery/copertine_album/{$album['id_album']}.png");
    }
    $managerSql->elimina_album($album['id_album']);
}


if ( $categoria && $managerSql->elimina_categoria($categoria['id_categoria']) ) {
    if(file_exists("../gallery/copertine_categorie/{$categoria['id_categoria']}.png")){
        unlink("../gallery/copertine_categorie/{$categoria['id_categoria']}.png");
    }
    header('Location: ../galleryadmin_home.php');
    exit();
}else{
    header('Location: ../error.php?code=6');
    exit();
}

?>