<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>

<body>
<p>Pagina di errore</p>
<p>

<?php

//se l'accesso alla pagina avviene senza fornire un codice
if( empty($_GET['code']) ){
    $code = 0;
}


$code = $_GET['code'];

switch ($code) {
    case 0:
        echo 'errore nell accesso alla pagina';
        break;

    case 1:
        echo 'i dati non sono stati forniti in modo corretto';
        break;

    case 2:
        echo 'i dati per l\'accesso non sono corretti';
        break;
    
    case 3:
        echo 'non è stato possibile aggiungere la categoria';
        break;
    
    case 4:
        echo 'non è stato possibile accedere alla categoria';
        break;
    
    case 5:
        echo 'non è stato possibile salvare le modifiche alla categoria';
        break;
    
    case 6:
        echo 'non è stato possibile eliminare la categoria';
        break;
    
    case 7:
        echo 'non è stato possibile aggiungere l\'album';
        break;
    
    case 8:
        echo 'non è stato possibile accedere all\'album';
        break;
    
    case 9:
        echo 'non è stato possibile salvare le modifiche all\'album';
        break;
    
    case 10:
        echo 'non è stato possibile eliminare l\'album';
        break;
    
    case 11:
        echo 'non è stato possibile eliminare la foto';
        break;
    
    case 12:
        echo 'non è stato possibile accedere alla foto';
        break;
    
    case 13:
        echo 'non è stato possibile salvare le modifiche alla foto';
        break;
    
}

?>

</p>
</body>
</html>