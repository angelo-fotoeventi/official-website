<?php
include_once '../common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'verifica_admin.php';

if( !array_key_exists('lista_id', $_GET) || (empty ($_GET['nome']) && empty ($_GET['tag'])) ){
    header('Location: ../error.php?code=1');
    exit();
}


$lista_id = $_GET['lista_id'];

foreach ($lista_id as $id) {
    $foto = $managerSql->get_foto($id);
    if(!empty($_GET['nome']) ){
        $foto['nome'] = $_GET['nome'];
    }
    if(!empty($_GET['tag']) ){
        $foto['tag'] = $_GET['tag'];
    }
    if ( !$foto || !$managerSql->modifica_foto($foto) ) {
        header('Location: error.php?code=13');
        exit();
    }
}
header('Location: ../galleryadmin_album.php?id='.$foto['id_album']);
exit();

?>

<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../common/js/jquery-1.6.2.min.js"></script>


<title>Documento senza titolo</title>
</head>

<body>
<p>Modifica Foto</p>

<?php
    if( count($error) ){
        $campi = implode(', ', $error);
        echo "<p>Compilare correttamente i campi: $campi</p>";
    }
    
    if( $salvataggio_completato ){
        echo "<p>Le modifiche sono state salvate correttamente</p>";
    }
    
?>


<form id="form_foto" method="post" action="" >
    <p>
        Nome
        <input type="text" name="nome" id="nome" value="<?php echo $foto['nome']; ?>" maxlength="250"/>
        <br/>
        Tag
        <input type="text" name="tag" id="tag" value="<?php echo $foto['tag']; ?>" maxlength="250"/>
        <br/>
        <input type="submit" name="modifica" id="modifica" value="Salva Modifiche" />
    </p>    
</form>

<a href="del_foto.php?id=<?php echo $foto['id_foto']; ?>" onclick="javascript: return confirm('Sei sicuro di voler eliminare la foto?');">Elimina Foto</a><br/>

<img src="<?php echo "../foto/{$foto['id_foto']}.jpg"; ?>" />


</body>
</html>
-->