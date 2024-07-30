<?php
include_once 'common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'administrator/verifica_admin.php';

$categorie = $managerSql->lista_categorie();
$first = array();
$first['indice_ordinamento'] = '1';

if(count($categorie)){
    $first = $categorie[0];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

	<!--SEO BASED-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="it-IT">

	<meta name="owner" 			content="Angelo Soccio"					/>
	<meta name="author" 		content="Pixo Agency"				 	/>
   	<meta name="design" 		content="Alberto Marà"				 	/>

	<meta name="robots" 		content="all"							/>
	<meta name="robots" 		content="index, follow" 				/>
	<meta name="revisit-after" 	content="3 days"						/>

	<title>
    	GALLERY ADMIN | HOME
	</title>

	<meta name="description" lang="it"
     content="
     DESCRIZIONE
     " />

	<!--SITETHUMB--><link rel="image_src" 	href="common/template/thumbsite.png" />

	<!--FAVICON--><link rel="icon" href="favicon.ico" type="image/x-icon"/>

	<!--CSSPAGE-->
   		<!--[if lte IE 7]>
			<script type="text/javascript">
                /* <![CDATA[ */
                window.top.location = '../common/error/no_browser/mod_errorbrowser.html';
                /* ]]> */
			</script>
		<![endif]-->

		<!--[if !IE]>--> 	<link rel="stylesheet" type="text/css" href="common/theme/css/no_ie_stylesheet.css" /> 	<!--<![endif]-->
		<!--[if IE]> 		<link rel="stylesheet" type="text/css" href="common/theme/css/ie_stylesheet.css" />		<![endif]-->

    <!--GALLERY--><link href="gallery/theme/stylesheet_gallery.css" rel="stylesheet" type="text/css" media="screen" />

	<!--WEBFONT-->
    <style type="text/css">
		/*TRAJAN*/
		@font-face {
			font-family: 'TrajanProRegular';
			src: url('common/theme/webfont/trajanpro-regular-webfont.eot');
			src: url('common/theme/webfont/trajanpro-regular-webfont.eot?#iefix') format('embedded-opentype'),
				 url('common/theme/webfont/trajanpro-regular-webfont.woff') format('woff'),
				 url('common/theme/webfont/trajanpro-regular-webfont.ttf') format('truetype'),
				 url('common/theme/webfont/trajanpro-regular-webfont.svg#TrajanProRegular') format('svg');
			font-weight: normal;
			font-style: normal;
		}
		@font-face {
			font-family: 'TrajanProBold';
			src: url('common/theme/webfont/trajanpro-bold-webfont.eot');
			src: url('common/theme/webfont/trajanpro-bold-webfont.eot?#iefix') format('embedded-opentype'),
				 url('common/theme/webfont/trajanpro-bold-webfont.woff') format('woff'),
				 url('common/theme/webfont/trajanpro-bold-webfont.ttf') format('truetype'),
				 url('common/theme/webfont/trajanpro-bold-webfont.svg#TrajanProBold') format('svg');
			font-weight: normal;
			font-style: normal;
		}
                
		#lista_categorie  li {
			list-style-type: none;
			float: left;
		}
	</style>

	<!--SCRIPT-->				
	<!--jQuery library-->
	<script type="text/javascript" src="common/script/jquery.min.1.4.3.js"></script>
    <script type="text/javascript" src="common/js/jquery-ui-1.8.6.custom.min.js"></script>
    <!-- <script type="text/javascript" src="../common/js/jquery-1.6.2.min.js"></script> -->

	<!--slidefade-->
	<link href="common/theme/css/css_slider/Slidecss.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="common/script/script_slide/packed.js"></script>
	<script type="text/javascript" src="common/script/script_slide/tinyfader.js"></script>
	
	<!--Dropdowndiv-->
	<script type="text/javascript" src="common/script/script_Dropdown/dropdown.js"></script>

	<!--fadeover-->
	<script type='text/javascript'>
		$(document).ready(function(){
					$("div.category").hover(
						function() {
							$(this).find("div.thumb_protect").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.thumb_protect").stop().animate({"opacity": "0"}, "slow");
					});
				});

		$(document).ready(function(){
					$("div.category").hover(
						function() {
							$(this).find("div.option_boxcategory").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.option_boxcategory").stop().animate({"opacity": "0"}, "slow");
					});
				});

		$(document).ready(function(){
					$("div.category").hover(
						function() {
							$(this).find("div.optionbox_category").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.optionbox_category").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
            
    <!-- Script per ordinare con drag & drop le categorie -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#lista_categorie').sortable({
                update: function(event, ui) {salva_ordininamento(); }
            });
        });

        function  visualizza_ordinamento(){
            var ordine = $('#lista_categorie').sortable("serialize");
            alert(ordine);
        }

        function salva_ordininamento(){
            var indice_inizio_ordinamento = "<?php echo $first['indice_ordinamento'] ?>";
            var array_ordine = $('#lista_categorie').sortable("serialize");
            dati = "inizio="+indice_inizio_ordinamento + "&" + array_ordine+ "&richiesta=salva_ordine_categorie";
            $.post('ajax_query.php', dati);
        }
        
        //variabile che contiente l'id della categoria da cancellare
        var toDelete = 0;
        
        function elimina_categoria(){
            location.href = 'administrator/del_categoria.php?id='+toDelete;
        }
    </script>

	</head>

    <body>
        
        <!--header-->
		<?php include("common/include/header/header.php");?>

		<!--content-->
        <div id="content">
        	<div id="gallery">
            
            	<!--barra gallery-->
            	<div style="padding:10px 0 10px 0;">
                	
                    <!--opzioni cliccabili-->
					<!--Elenco 			(solo grafica) -->	<img style="margin:0 0 0 15px;" src="gallery/theme/elenco_out.png" />
					<!--Nome pannello 	(solo grafica) -->	<img style="position:absolute; margin-left:5px; margin-top:-1px;" name="preventivo" src="gallery/theme/pannellodicontrollo.png" />
					<!--pulsante info-->					<img style="position:absolute; margin-left:749px;"  id="hideshow_infogallery" name="info" src="gallery/theme/info_off.png" onmouseover="document.info.src='gallery/theme/info_on.png';" onmouseout="document.info.src='gallery/theme/info_off.png';" />
					<!--pulsante LogOut-->					<img style="position:absolute; margin-left:810px;"  id="hideshow_accessogallery" name="accesso" src="gallery/theme/accesso_off.png" onmouseover="document.accesso.src='gallery/theme/accesso_on.png';" onmouseout="document.accesso.src='gallery/theme/accesso_off.png';" />

                    
                    <!--contenuto pulsante info (informazioni sulla gallery)-->
                    <div id="info_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 80px;" />
                        <p>
                        Sei sul pannello di controllo della galleria.<br />
						<br />
                        Puoi postare i box trascinandoli con il mouse. Rilascia il mouse per posizionarli.<br /><br />
						Puoi Creare nuove categorie tramite il box "+1"<br /><br />
						Puoi Gestire le categorie esistenti tramite i pulsanti che appaiono sopra di essere.
                        </p>
                    </div>                    

                    <!---pannello logout-->
                    <div id="accesso_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 0px;" />
                        <!--<form> -->
                        ESCI E TORNA UTENTE
                        <br />
                        <input type="button" value="ESCI ORA" 
                        style="
                        background:	#CCC; 
                        border:		0; 
                        color:		#900;
                        margin-top:	7px; 
                        padding:	3px 3px 3px 3px;
                       	border-radius: 			5px; 
                        -moz-border-radius: 	5px; 
                        -webkit-border-radius: 	5px;" 
                        onclick="location.href='administrator/logout.php' "/>
                        <br />
                        <!-- </form> -->
                    </div>
                </div>
               
               
                <!--INIZIO CATEGORIE-->
                <div style="text-align:left; padding:0 0 0 14px;">
                			
					<!--Pannelli (hide/show)-->
					<!--inserisci titolo categoria-->
					<div class="pannello_nuovacategoria" style="display: none">
						<img src="gallery/theme/head_nuovacategoria.png" />
						<div style=" width:436px; height:162px; background:url(gallery/theme/bkg_elimina.png) no-repeat top; text-align:center; ">
							<form id="form_categoria_attivita" method="post" action="administrator/add_categoria.php" >
								<input type="text" name="nome" id="nome" maxlength="60" value="Inserisci un titolo" style=" background:#333333; width:340px; height:20px; margin-top:-15px; margin-bottom:-5px; padding:5px 5px 5px 5px; border:3px solid #666; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; font-family:Tahoma, Geneva, sans-serif; color:#FFFFFF; " />
								<input type="submit" name="aggiungi" id="aggiungi" value="&nbsp;" style=" background:url(gallery/theme/creatitolocategoria.png) no-repeat; height:75px; width:386px; border:none; " />
								<img class="okclose" src="gallery/theme/Noesci.png" style="margin-top:-25px;" onclick="javascript: $('.pannello_nuovacategoria').fadeOut(500, null); $('#nome').val('Inserisci un titolo');"/>
							</form>
						</div>
					</div>
                            
					<!--elimina categoria-->
					<div class="pannello_elimina" style="display: none">
						<img src="gallery/theme/head_elimina.png" />
						<div style=" width:436px; height:162px; background:url(gallery/theme/bkg_elimina.png) no-repeat top; text-align:center; ">
							<img src="gallery/theme/okelimina.png" style="margin-bottom:-20px;" onclick="javascript: elimina_categoria();"/>
							<img class="okclose" src="gallery/theme/Noesci.png" onclick="javscript: $('.pannello_elimina').fadeOut(0, null);" />
						</div>
					</div>
					<!--/Pannelli (hide/show)-->
                	
                    
					<!--sezione delle categorie-->
                    <ul id="lista_categorie">
                            
                        <!--box crea categorie-->
                        <li>
                            <div class="category" onclick="javascript: $('.pannello_nuovacategoria').fadeIn(500, null);">
                                <div class="copertina" >
                                    <img src="gallery/theme/copia_vietata_e_punibile_in_tribunale.png" style="background:url(gallery/theme/add_categoryealbum.png) no-repeat; height:146px; width:302px; margin:0 0 -2px 0;" class="thumb_category" />
                                    <div class="thumb_protect" ></div>
                                </div>
                                <img src="gallery/theme/line.png" class="line" />
                                <p class="title_categorie">
                                    CREA ADESSO UNA NUOVA CATEGORIA
                                </p>
                            </div>
                        </li>
        
                        <!--box già esistenti-->
                        <?php
                        $categorie = $managerSql->lista_categorie();
                        
                        foreach ($categorie as $categoria) {
                            $img_path = 'gallery/theme/nocopertina.png';
                            if(file_exists("gallery/copertine_categorie/{$categoria['id_categoria']}.png") ){
                                $img_path = "gallery/copertine_categorie/{$categoria['id_categoria']}.png";
                            }
                            /*
                            echo "<li id=\"categorie_{$categoria['id_categoria']}\">
                                    <img src=\"$img_path\" width=\"100\" /><br/>
                                    <!-- {$categoria['id_categoria']} -->
                                    {$categoria['nome']}<br/>
                                    <a href=\"edit_categoria.php?id={$categoria['id_categoria']}\">Modifica</a><br/>
                                    <a href=\"del_categoria.php?id={$categoria['id_categoria']}\" onclick=\"javascript: return confirm('Sei sicuro di voler eliminare la categoria?');\">Elimina</a><br/>
                                  </li>";
                             * 
                             */
                            echo "<li id=\"categorie_{$categoria['id_categoria']}\">
                                        <div class=\"category\">
                                            <div class=\"copertina\" >
                                                <img src=\"gallery/theme/copia_vietata_e_punibile_in_tribunale.png\" style=\"background:url(common/thumb_generator_cat.php?file=../$img_path) no-repeat; height:138px; width:294px;\" height=\"139\"  width=\"295\" class=\"thumb_category\" />
                                                <div class=\"thumb_protect\" ></div>
                                            </div>
                                            
                                            <img src=\"gallery/theme/line.png\" class=\"line\" />
                                            <p class=\"title_categorie\">
                                                {$categoria['nome']}
                                            </p>
											
                                            <div class=\"optionbox_category\">
                                                <a href=\"galleryadmin_categorie.php?id={$categoria['id_categoria']}\">
                                                    <img src=\"gallery/theme/entreemodifica_categoria.png\" />
                                                </a>
                                                <img src=\"gallery/theme/elimina_categoria.png\"  style=\"margin:-8px 0 -10px 0;\" onclick=\"javascript: $('.pannello_elimina').fadeIn(0,null); toDelete={$categoria['id_categoria']}; \"/>
                                            </div>
                                        </div>
                                    </li>";
                        }
                        ?>
        
                        <!-- <li><a href="add_categoria.php">Nuova Categoria</a></li> -->
					</ul>
                                
					<!--
					<input type="button" name="visual" onclick="javascript: visualizza_ordinamento();" value="visualizza" />
					<input type="button" name="salva" onclick="javascript: salva_ordininamento();" value="salva" />            
					-->
                        
				</div>
			</div>
            <p style="clear: both"> &nbsp </p>                     	
			<!--FINE CATEGORIE-->

		</div>
        <img src="common/theme/img/wrap_bot.png" />

		<!--box scritta scorrevole finale-->
		<p id="scrollerp">
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CATEGORIE VELOCI  | 
            <span style="margin:-40px 0 !important; position:relative;">
                <marquee direction="right" style="width:800px;">
                    ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK
                </marquee>
            </span>
        </p>

		<!--Footer-->
		<?php include("common/include/footbar/footbar.php");?>

	</body>

</html>