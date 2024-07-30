<?php

class dbManager{
        private $user = 'angelfotoeventi';
	private $pass = 'angelfotoeventi';
	private $db_name = 'angelfotoeventi';
	private $host = 'localhost';
	private $connection = NULL;

        

	function __construct() {
            $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
	}

	function __destruct() { 
            $this->connection->close();
	}


        /*
        *   Transazioni
         */
        function start_transaction(){
            $sql = "START TRANSACTION;";
            $this->connection->query($sql);
        }

        function transaction_rollback(){
            $sql = "ROLLBACK;";
            $this->connection->query($sql);
        }

        function transaction_commit(){
            $sql = "COMMIT;";
            $this->connection->query($sql);
        }

        
        
        /*
         * 
         * Amministratore
         * 
         */
        
        function verifica_pwd_admin($pwd){
            $pwd = md5($pwd);
            $sql = "SELECT * FROM `admin_pwd` WHERE `pwd`= '$pwd' " ;
            if ( ($result = $this->connection->query($sql)) && ( $this->connection->affected_rows>0 ) ){
                return true;
            }
            return false;
        }
        
        function modifica_pwd_admin($pwd){
            $pwd = md5($pwd);
            $sql = "UPDATE `admin_pwd` SET `pwd` = '$pwd' WHERE 1 ";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            else{
                return false;
            }
        }
        
        
        
        
        /*
        *
        *   Categorie
        *
        */
        function aggiungi_categoria( $categoria ){
            foreach ($categoria as $key => $value) {
                $categoria[$key] = addslashes($categoria[$key]);
            }
            $sql = "INSERT INTO `categorie` (`id_categoria`, `nome`, `indice_ordinamento`) VALUES (NULL, '{$categoria['nome']}', (SELECT IFNULL(MAX(`indice_ordinamento`), 0) +1 FROM categorie AS CAT WHERE 1 ) );";
            if( $this->connection->query($sql)=== TRUE ){ 
                return $this->connection->insert_id;
            } else {
                return false;
            }
        }
        
        function lista_categorie(){
            $toReturn=array();
            $indice=0;
            $sql = "SELECT * FROM categorie WHERE 1 ORDER BY indice_ordinamento";
            if( ($risultato = $this->connection->query($sql)) && ($this->connection->affected_rows>0) ){
                while ( $riga = mysqli_fetch_assoc($risultato) ){
                    $toReturn[$indice]=$riga;
                    $indice++;
                }
            }
            return $toReturn;
        }
        
        function get_categoria( $id ){
            $toReturn = false;
            if( empty($id) ){
                return $toReturn;
            } 
            $sql = "SELECT * FROM categorie WHERE id_categoria = $id ";
            if( ($result = $this->connection->query($sql)) && ( $this->connection->affected_rows>0 ) ){
                $riga = mysqli_fetch_array($result);
                $toReturn=$riga;
            }
            return $toReturn;
        }
        
        function modifica_categoria($categoria){
            foreach ($categoria as $key => $value) {
                $categoria[$key] = addslashes($categoria[$key]);
            }
            $sql = "UPDATE `categorie` SET `nome` = '{$categoria['nome']}', `indice_ordinamento` = '{$categoria['indice_ordinamento']}' WHERE `id_categoria` = {$categoria['id_categoria']} LIMIT 1;";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            else{
                return false;
            }
        }
        
        function elimina_categoria( $id ){
            $sql = "DELETE FROM categorie WHERE id_categoria = $id LIMIT 1";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            return false;
        }
        
        
        /*
        *
        *   Album
        *
        */
        function aggiungi_album( $album ){
            foreach ($album as $key => $value) {
                $album[$key] = addslashes($album[$key]);
            }
            $sql = "INSERT INTO `album` (`id_album`, `nome`, `id_categoria`, `indice_ordinamento`) VALUES (NULL, '{$album['nome']}', '{$album['id_categoria']}', (SELECT IFNULL(MAX(`indice_ordinamento`), 0) +1 FROM album AS Alb WHERE id_categoria='{$album['id_categoria']}' ));";
            if( $this->connection->query($sql)=== TRUE ){ 
                return $this->connection->insert_id;
            } else {
                return false;
            }
        }
        
        function lista_album(){
            $toReturn=array();
            $indice=0;
            $sql = "SELECT * FROM album WHERE 1 ";
            if( ($risultato = $this->connection->query($sql)) && ($this->connection->affected_rows>0) ){
                while ( $riga = mysqli_fetch_assoc($risultato) ){
                    $toReturn[$indice]=$riga;
                    $indice++;
                }
            }
            return $toReturn;
        }
        
        function lista_album_by_categoria( $id_categoria ){
            $toReturn=array();
            $indice=0;
            $sql = "SELECT * FROM album WHERE id_categoria = $id_categoria ORDER BY indice_ordinamento";
            if( ($risultato = $this->connection->query($sql)) && ($this->connection->affected_rows>0) ){
                while ( $riga = mysqli_fetch_assoc($risultato) ){
                    $toReturn[$indice]=$riga;
                    $indice++;
                }
            }
            return $toReturn;
        }
        
        function get_album( $id ){
            $toReturn = false;
            if( empty($id) ){
                return $toReturn;
            } 
            $sql = "SELECT * FROM album WHERE id_album = $id ";
            if( ($result = $this->connection->query($sql)) && ( $this->connection->affected_rows>0 ) ){
                $riga = mysqli_fetch_array($result);
                $toReturn=$riga;
            }
            return $toReturn;
        }
        
        function modifica_album( $album ){
            foreach ($album as $key => $value) {
                $album[$key] = addslashes($album[$key]);
            }
            $sql = "UPDATE `album` SET `nome` = '{$album['nome']}', id_categoria = '{$album['id_categoria']}', `indice_ordinamento` = '{$album['indice_ordinamento']}' WHERE `id_album` = {$album['id_album']} LIMIT 1;";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            else{
                return false;
            }
        }
        
        function elimina_album( $id ){
            $sql = "DELETE FROM album WHERE id_album = $id LIMIT 1";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            return false;
        }
        
        
        
        /*
        *
        *   Foto
        *
        */
        function aggiungi_foto( $foto ){
            foreach ($foto as $key => $value) {
                $foto[$key] = addslashes($foto[$key]);
            }
            $sql = "INSERT INTO `foto` (`id_foto`, `nome`, `tag`, `id_album`, `indice_ordinamento`) VALUES (NULL, '{$foto['nome']}', '{$foto['tag']}', '{$foto['id_album']}', (SELECT IFNULL(MAX(`indice_ordinamento`), 0) +1 FROM foto AS F WHERE id_album ='{$foto['id_album']}') );";
            if( $this->connection->query($sql)=== TRUE ){ 
                return $this->connection->insert_id;
            } else {
                return false;
            }
        }
         
        
        function lista_foto_by_album( $id_album, $start=0, $limit=0 ){
            $toReturn=array();
            $indice=0;
            $sql = "SELECT * FROM foto WHERE id_album = $id_album ORDER BY indice_ordinamento";
            if( !empty($limit) ){
                $sql .= " LIMIT $start,$limit ";
            }
            if( ($risultato = $this->connection->query($sql)) && ($this->connection->affected_rows>0) ){
                while ( $riga = mysqli_fetch_assoc($risultato) ){
                    $toReturn[$indice]=$riga;
                    $indice++;
                }
            }
            return $toReturn;
        }
        
        function get_foto( $id ){
            $toReturn = false;
            if( empty($id) ){
                return $toReturn;
            } 
            $sql = "SELECT * FROM foto WHERE id_foto = $id ";
            if( ($result = $this->connection->query($sql)) && ( $this->connection->affected_rows>0 ) ){
                $riga = mysqli_fetch_array($result);
                $toReturn=$riga;
            }
            return $toReturn;
        }
        
        function modifica_foto( $foto ){
            foreach ($foto as $key => $value) {
                $foto[$key] = addslashes($foto[$key]);
            }
            $sql = "UPDATE `foto` SET `nome` = '{$foto['nome']}', 
                                        `tag` = '{$foto['tag']}', 
                                        `id_album` = '{$foto['id_album']}', 
                                        `indice_ordinamento` = '{$foto['indice_ordinamento']}' 
                            WHERE `id_foto` = '{$foto['id_foto']}' LIMIT 1;";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            else{
                return false;
            }
        }
        
        function elimina_foto( $id ){
            $sql = "DELETE FROM foto WHERE id_foto = $id LIMIT 1";
            if( $this->connection->query($sql) === TRUE ){
                return true;
            }
            return false;
        }
        
        function lista_foto_by_tag( $tag, $start=0, $limit=0 ){
            $toReturn=array();
            $indice=0;
            $sql = "SELECT * FROM foto WHERE tag LIKE '%$tag%' ";
            if( !empty($limit) ){
                $sql .= " LIMIT $start,$limit ";
            }
            if( ($risultato = $this->connection->query($sql)) && ($this->connection->affected_rows>0) ){
                while ( $riga = mysqli_fetch_assoc($risultato) ){
                    $toReturn[$indice]=$riga;
                    $indice++;
                }
            }
            return $toReturn;
        }
        
        
}


?>
