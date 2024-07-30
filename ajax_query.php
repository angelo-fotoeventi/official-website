<?php
include_once 'common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

extract($_GET);
extract($_POST);

if(empty($richiesta)){
    echo 'x';//non significa niente ma c'è per debug
    exit();
}

switch ($richiesta){
    case "salva_ordine_categorie": salva_ordine_categorie(); break;
    case "salva_ordine_album": salva_ordine_album(); break;
    case "salva_ordine_foto": salva_ordine_foto(); break;
    case "carica_foto": carica_foto();break;
}


function salva_ordine_categorie(){
    global $managerSql, $inizio, $categorie;
    if(empty($managerSql)){
        $managerSql = new dbManager();
    }
    foreach ($categorie as $id_categoria) {
        $categoria = $managerSql->get_categoria($id_categoria);
        $categoria['indice_ordinamento'] = $inizio;
        $managerSql->modifica_categoria($categoria);
        $inizio++;
    }
    return;
}

function salva_ordine_album(){
    global $managerSql, $inizio, $lista_album;
    if(empty($managerSql)){
        $managerSql = new dbManager();
    }
    foreach ($lista_album as $id_album) {
        $album = $managerSql->get_album($id_album);
        $album['indice_ordinamento'] = $inizio;
        $managerSql->modifica_album($album);
        $inizio++;
    }
    return;
}

function salva_ordine_foto(){
    global $managerSql, $inizio, $lista_foto;
    if(empty($managerSql)){
        $managerSql = new dbManager();
    }
    foreach ($lista_foto as $id_foto) {
        $foto = $managerSql->get_foto($id_foto);
        $foto['indice_ordinamento'] = $inizio;
        $managerSql->modifica_foto($foto);
        $inizio++;
    }
    return;
}

function carica_foto(){
    global $managerSql, $id_album;
    if(empty($managerSql)){
        $managerSql = new dbManager();
    }
    $path = 'tmp_foto/';
    $dir_content = scandir($path);
    foreach ($dir_content as $element) {
        if( !is_dir($path.$element) ){
            $foto = array();
            $foto['nome'] = $element;
            $foto['tag'] = 'TAG IMMAGINE';
            $foto['id_album'] = $id_album;
            $id_foto = $managerSql->aggiungi_foto($foto);
            //convert jpg with resize and save
            
            save_image($path.$element, "gallery/foto/$id_foto.jpg", 750);
            unlink($path.$element);
        }
    }
    return;
}



function save_image($src, $dst, $width ){

    if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

    $type = strtolower(substr(strrchr($src,"."),1));
    if($type == 'jpeg') $type = 'jpg';
    switch($type){
        case 'bmp': $img = imagecreatefromwbmp($src); break;
        case 'gif': $img = imagecreatefromgif($src); break;
        case 'jpg': $img = imagecreatefromjpeg($src); break;
        case 'png': $img = imagecreatefrompng($src); break;
        default : return "Unsupported picture type!";
    }

    //resize
    $ratio = ($w>$width) ? $width/$w : 1;//resize solo se l'immagine è troppo larga
    $n_width = $w * $ratio;
    $n_height = $h * $ratio;
    
    /*
     * Senza bande nere
     */
    $new = imagecreatetruecolor($n_width, $n_height);
    imagecopyresized($new, $img, 0, 0, 0, 0, $n_width, $n_height, $w, $h);
    imagejpeg($new, $dst);

    return true;
}
?>
