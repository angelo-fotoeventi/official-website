<?php
include_once 'common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'administrator/verifica_admin.php';

if( empty ($_GET['id']) ){
    header('Location: error.php?code=1');
    exit();
}

$album = $managerSql->get_album($_GET['id']);
if( !$album ){
    header('Location: error.php?code=8');
    exit();
}

/*
 * paginazione
 */
$pagina_attuale = 0;
$inizio = 0;
$elementi_per_pagina = 50;
if( array_key_exists('pagina', $_GET) ){
    $pagina_attuale = $_GET['pagina'];
    $inizio = $elementi_per_pagina * $pagina_attuale;
}
$lista_foto = $managerSql->lista_foto_by_album($album['id_album']);
$num_foto = count($lista_foto);
if( ($num_foto>0) && ($inizio>=$num_foto) )
    exit("accesso ad area non consentito... numero pagina non valido");
$lista_foto = $managerSql->lista_foto_by_album($album['id_album'], $inizio, $elementi_per_pagina);


$first = array();
$first['indice_ordinamento'] = '1';
if(count($lista_foto)){
    $first = $lista_foto[0];
}


$error=array();
$salvataggio_completato=0;

if(array_key_exists('modifica', $_POST)){
    if( empty($_POST['nome']) ){ $error[] = 'nome'; }else{ $album['nome']=$_POST['nome']; }
    
    if( !count($error) ){
        if ( !$managerSql->modifica_album($album) ){
            header('Location: error.php?code=9');
            exit();
        }  else {
            $salvataggio_completato=1;
        }
    }
}


if(array_key_exists('modifica_copertina', $_POST)){
    if( !array_key_exists('immagine', $_FILES) || ($_FILES['immagine']['size']==0) ){
        header('Location: error.php?code=9');
        exit();
    }
    include 'common/carica_img.php';
    if ( load_image("gallery/copertine_album/", $_FILES['immagine'], $album['id_album'] ) ){
        $salvataggio_completato = 1;
    }
}

if(array_key_exists('crop_copertina', $_POST)){
    $img_r = imagecreatefrompng($_POST['path']);
    $dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h'],$_POST['w'],$_POST['h']);
    imagepng($dst_r, $_POST['path']);
    header('Location: galleryadmin_album.php?id='.$album['id_album']);
    exit();
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
		
		#lista_foto li{
			display:inline-block !important;
			list-style:none;
			margin:	-3px 1px 0 0px;
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

	<!--Lightbox-->
	<link rel="stylesheet" type="text/css" href="gallery/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
	<script type="text/javascript" src="gallery/lightbox/js/jquery.lightbox-0.5.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#lista_foto a').lightBox();
		});
	</script>

	<!--fadeover-->
	<script type='text/javascript'>
		$(document).ready(function(){
					$("div.mod_copertina").hover(
						function() {
							$(this).find("div.change").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.change").stop().animate({"opacity": "0"}, "slow");
					});
				});

				$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.thumb_protect").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.thumb_protect").stop().animate({"opacity": "0"}, "slow");
					});
				});

				$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.option_boxalbum").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.option_boxalbum").stop().animate({"opacity": "0"}, "slow");
					});
				});
				$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.optionbox_album").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.optionbox_album").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
        
	<!--Jcrop-->
	<link rel="stylesheet" href="common/jcrop/css/jquery.Jcrop.css" type="text/css" />
	<script src="common/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		//Jcrop
            $(function($) {
                    $('#copertina').Jcrop({
                            onChange: showCoords,
                            onSelect: showCoords,
                            minSize: [295,139],
                            aspectRatio: 295/139,
                            boxWidth: 900
                    });
                });
                function showCoords(c){
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    $('#x2').val(c.x2);
                    $('#y2').val(c.y2);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                };
	</script>

	<script type="text/javascript">
		$(function(){
                if( <?php echo $salvataggio_completato ?> ){
                    alert('Salvataggio dati completato');
                }
            })
	</script>
        
    <!-- Script per ordinare con drag & drop le categorie -->
	<script type="text/javascript">
		 $(document).ready(function(){
                $('#lista_foto').sortable({
                    update: function(event, ui) {salva_ordininamento(); }
                });
            });

            function visualizza_ordinamento(){
                var ordine = $('#lista_foto').sortable("serialize");
                alert(ordine);
            }

            function salva_ordininamento(){
                var indice_inizio_ordinamento = "<?php echo $first['indice_ordinamento'] ?>";
                var array_ordine = $('#lista_foto').sortable("serialize");
                dati = "inizio="+indice_inizio_ordinamento + "&" +array_ordine+ "&richiesta=salva_ordine_foto";
                $.post('ajax_query.php', dati);
            }
	</script>

        <!-- Seleziona tutti -->
        <script type="text/javascript">
            function seleziona_tutti(){
                //alert( $('.foto_check').length );
                $('.foto_check').each(function(){
                    $(this).attr('checked', true);
                });
            }
        </script>
        
        <!-- elimina selezionati -->
        <script type="text/javascript">
            function elimina_selezionati(){
                //alert( $('.foto_check:checked').length );
                data="";
                $('.foto_check:checked').each(function(){
                    //alert($(this).val());
                    data+="lista_id[]="+$(this).val()+"&";
                });
                if($('.foto_check:checked').length){
                    location.href = 'administrator/del_foto.php?'+data;
                }
            }
        </script>
        
        <!-- modifica nome a selezionati -->
        <script type="text/javascript">
            function modifica_nome_selezionati(){
                data="";
                $('.foto_check:checked').each(function(){
                    data+="lista_id[]="+$(this).val()+"&";
                });
                nome = $('#nuovo_nome').val();
                if( $('.foto_check:checked').length ){
                    location.href = 'administrator/edit_foto.php?'+data+"nome="+nome;
                }
            }
        </script>
        
        <!-- modifica tag a selezionati -->
        <script type="text/javascript">
            function modifica_tag_selezionati(){
                data="";
                $('.foto_check:checked').each(function(){
                    data+="lista_id[]="+$(this).val()+"&";
                });
                tag = $('#nuovo_tag').val();
                if( $('.foto_check:checked').length ){
                    location.href = 'administrator/edit_foto.php?'+data+"tag="+tag;
                }
            }
        </script>

        <!-- CARICAMENTO FOTO -->
        <script type="text/javascript" src="common/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="common/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function() {
          $('#file_upload').uploadify({
            'uploader'  : 'common/uploadify/uploadify.swf',
            'script'    : 'common/uploadify/uploadify.php',
            'cancelImg' : 'common/uploadify/cancel.png',
            'fileExt'     : '*.jpg;*.gif;*.png',
            'folder'    : 'tmp_foto',
            'multi'       : true,
            'auto'      : false,
            'onAllComplete' : function(event,data) {
                                  alert(data.filesUploaded + ' files uploaded successfully!');
                                  data = "richiesta=carica_foto&id_album=<?php echo $album['id_album'] ?>";
                                      $.get('ajax_query.php', data, function(){ alert('Foto caricate'); window.location.reload();});
                              }
          });
        });
        // ]]>
        </script>

        <!-- CAMBIO PAGINA -->
        <script type="text/javascript">
            function cambia_pagina(){
                elemReg = document.getElementById('pagine');
                pagina = elemReg[elemReg.selectedIndex].value;
                window.location.href = "galleryadmin_album.php?id=<?php echo $album['id_album']; ?>&pagina="+pagina;
            }
        </script>

        <!--multicheckbox 2-->
    	<script type="text/javascript">
			  (function()
			{
	
			var currentCheckbox = null;
	
			function NSResolver(prefix) 
			{
			  if (prefix == 'html') {
				return 'http://www.w3.org/1999/xhtml';
			  }
			  else {
				//this shouldn't ever happen
				return null;
			  }
			}
	
			function selectCheckboxRange(start, end)
			{
			  var xpath, i, checkbox, last;
	
			  if (document.documentElement.namespaceURI) // XML
				xpath = "//html:input[@type='checkbox']";
			  else // HTML
				xpath = "//input[@type='checkbox']";
	
			  var checkboxes = document.evaluate(xpath, document, NSResolver, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	
			  for (i = 0; (checkbox = checkboxes.snapshotItem(i)); ++i) {
				if (checkbox == end) {
				  last = start;
				  break;
				}
				if (checkbox == start) {
				  last = end;
				  break;
				}
			  }
	
			  for (; (checkbox = checkboxes.snapshotItem(i)); ++i) {
				if (checkbox != start && checkbox != end && checkbox.checked != start.checked) {
				  // Instead of modifying the checkbox's value directly, fire an onclick event.
				  // This makes scripts that are part of Yahoo! Mail and Google Personalized pick up the change.
				  // Doing it this way also triggers an onchange event, which is nice.
				  var evt2 = document.createEvent("MouseEvents");
				  evt2.initEvent("click", true, false);
				  checkbox.dispatchEvent(evt2);
				}
	
				if (checkbox == last) {
				  break;
				}
			  }
			}
	
			function handleChange(event)
			{
			  var t = event.target;
	
			  if (isCheckbox(t) && (event.button == 0 || event.keyCode == 32)) {
				if (event.shiftKey && currentCheckbox) {
				  selectCheckboxRange(currentCheckbox, t);
				}
	
				currentCheckbox = t;
			  }
			}
	
			function isCheckbox(elt)
			{
			  // tagName requires toUpperCase because of HTML vs XHTML
			  return (elt.tagName.toUpperCase() == "INPUT" && elt.type == "checkbox");
			}
	
			// onchange always has event.shiftKey==true, so to tell whether
			// shift was held, we have to use onkeyup and onclick instead.
			document.documentElement.addEventListener("keyup", handleChange, true);
			document.documentElement.addEventListener("click", handleChange, true);
	
			})();
        </script>
        
        <!--multicheckbox 1-->
		<script type="text/javascript">
			<!--var NUM_BOXES = 10;
			// last checkbox the user clicked
			<!--var last = -1;
			<!--function check(event) {
			// in IE, the event object is a property of the window object
			// in Mozilla, event object is passed to event handlers as a parameter
			<!--if (!event) { event = window.event }
			<!--var num = parseInt(/box\[(\d+)\]/.exec(this.name)[1]);
			<!--if (event.shiftKey && last != -1) {
			<!--var di = num > last ? 1 : -1;
			<!--for (var i = last; i != num; i += di) {
			  <!--document.forms.boxes['box[' + i + ']'].checked = true;
			 <!--}
			<!--}
			  <!--last = num;
			<!--}
			<!--function init() {
			  <!--for (var i = 0; i < NUM_BOXES; i++) {
				<!--document.forms.boxes['box[' + i + ']'].onclick = check;
			  <!--}
			<!--}
		</script>

	</head>

    <body onload="javascript: $('#div_modifica_copertina').toggle(100, null);">
        
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
                            Puoi postare i box trascinandoli con il mouse. Rilascia il mouse per posizionarli.<br />
                            Puoi Gestire i parametri dell' album tramite il primo pannello.<br />
                            Puoi Caricare nuove foto, eliminarle, modificarne i paramentri tramite la serie di tasti che trovi nel riquadro "opzioni foto"
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
                        <br /><br />
                       	<a href="administrator/edit_admin_pwd.php" style="color:#000;">
                        	CAMBIA PASSWORD
                        </a>
                        <br />
                        <!-- </form> -->
                    </div>
                
                </div>
               
               
               	<!--Gestione dell'album e delle foto-->
                <div style="text-align:left;">


                    <!--pannello modifiche Album-->
	                <img src="gallery/theme/gestiscialbum.png" style="margin-left:15px;" />
                    <div id="mod_album">
 
						<!--modifica copertina-->
                        <div class="mod_copertina">
                            <?php
                                $img_path = 'gallery/theme/nocopertina.png';
                                if(file_exists("gallery/copertine_album/{$album['id_album']}.png") ){
                                    $img_path = "gallery/copertine_album/{$album['id_album']}.png";
                                }
                            ?>
                            <img src="<?php echo $img_path; ?>" style=" position:absolute; margin:10px 0 0 12px;" height="139"  width="295"/>
                            <div class="change" onclick="javascript: $('#div_modifica_copertina').toggle(500, null);"></div>
                            <img src="gallery/theme/line.png" class="line" style="margin-left:12px;" />
                            <p class="title_categorie" style="width:200px; height:20px; overflow:hidden; margin-left:5px; margin-top:162px;">
                                <?php echo $album['nome']; ?>
                            </p>
                        </div>
 
                        <!--opzioni dell'album-->
                        <div class="option">
                            <img src="gallery/theme/head_moddatialbum.png" style="position:absolute; margin-top:-2px;" />
                            <form id="form_album" method="post" action="" >
                                <input type="text" name="nome" id="nome" maxlength="60" value="<?php echo $album['nome']; ?>"
                                style="
                                position:absolute;
                                margin:36px 0;
                                border:none;
                                width:587px;
                                background:	url(gallery/theme/cambiatitolo.png) top no-repeat;
                                padding:30px 10px 10px 30px;
                                color:#FFF;
                                " />
                                <input type="button" value="&nbsp;"
                                style="
                                width:647px;
                                height:73px;
                                position:absolute;
                                margin:80px 0 0 0;
                                border:none;
                                background:url(gallery/theme/home.png) no-repeat;"
                                onclick="javascript: location.href='galleryadmin_categorie.php?id=<?php echo $album['id_categoria']; ?>';"
                                />
                                <a href="http://www.bordermaker.nl/en/download/" target="_blank"
                                style="
                                width:347px;
                                height:73px;
                                position:absolute;
                                margin:126px 0 0 0;
                                border:none;
                                background:url(gallery/theme/annulla.png) no-repeat;
                                "></a>
                                <input type="submit" name="modifica" value="&nbsp;"
                                style="
                                width:347px;
                                height:73px;
                                position:absolute;
                                margin:126px 0 0 292px;
                                border:none;
                                background:url(gallery/theme/invia.png) no-repeat;
                                "/>
                             </form>
                        </div>

                </div>
                <br />

				<!--Pannelli (hide/show)-->
                    <!-- MODIFICA COPERTINA (jcrop) -->
                    <div id="wrap_div_modifica_copertina">
                            <div id="div_modifica_copertina">
                                <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px; float:right;" onclick="javscript: $('#div_modifica_copertina').fadeOut(0, null);">CHIUDI IL BOX ED ESCI</p> 
                                <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">Cambia Copertina</p>

								<?php
                                    $img_path = 'gallery/theme/nocopertina.png';
                                    if(file_exists("gallery/copertine_album/{$album['id_album']}.png") ){
                                        $img_path = "gallery/copertine_album/{$album['id_album']}.png";
                                    }
                                ?>
                                <img id="copertina" src="<?php echo $img_path; ?>" />
                                <form name="frm_crop" id="frm_crop" action="" method="post">
                                    <!--<label>X1--> <input size="4" id="x" name="x" type="hidden"> <!--</label>-->
                                    <!--<label>Y1--> <input size="4" id="y" name="y" type="hidden"> <!--</label>-->
                                    <!--<label>X2--> <input size="4" id="x2" name="x2" type="hidden"> <!--</label>-->
                                    <!--<label>Y2--> <input size="4" id="y2" name="y2" type="hidden"> <!--</label>-->
                                    <!--<label>W--> <input size="4" id="w" name="w" type="hidden"> <!--</label>-->
                                    <!--<label>H--> <input size="4" id="h" name="h" type="hidden"> <!--</label>-->
                                    <input type="hidden" name="path" value="<?php echo $img_path; ?>" />
                                    <?php
                                        if(file_exists("gallery/copertine_album/{$album['id_album']}.png") ){
                                            echo "<input type=\"submit\" name=\"crop_copertina\" value=\"Taglia Immagine\" />";
                                        }
                                    ?>
                                </form>


								<form name="form_copertina" action="" method="post" enctype="multipart/form-data" id="form_copertina">
                                    <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">CARICA UNA NUOVA COPERTINA</p>
                                    <input type="file" name="immagine" id="immagine" />
                                    <input type="submit" name="modifica_copertina" id="modifica_copertina" value="Carica copertina" />
                                </form>
                      	   </div>
                    </div>
                    
                    <!-- CARICAMENTO FOTO -->
                    <div class="wrap">
                        <div id="carica_foto" style="display: none" class="genericBox" style="text-align:left !important;">
                        <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px; float:right;" onclick="javscript: $('.genericBox').fadeOut(0, null);">CHIUDI IL BOX ED ESCI</p> 
                            <br /><br /><p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">UPLOAD FOTO MULTIPLE</p><br />
                            <a href="#" onclick="javascript: $('#file_upload').uploadifyUpload(); " class="genericInput" >INVIA FILES</a><br /><br /><br />
                            <div style="border:#CCC solid 1px; padding:5px 5px 5px 5px;">
                            	<input id="file_upload" type="file" name="file_upload" class="caricafoto" /><br />
							</div>                            
                        </div>
                    </div>
                    
                    <!-- MODIFICA NOME -->
                    <div class="wrap">
                        <div id="modifica_nome" style="display: none" class="genericBox">
                        <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px; float:right;" onclick="javscript: $('.genericBox').fadeOut(0, null);">CHIUDI IL BOX ED ESCI</p> 
                            <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">Modifica nome:</p>
                            <input id="nuovo_nome" name="nome" type="text" value="" maxlength="12" class="genericInput"/>
                            <input type="button" name="modifica" id="modifica" value="Modifica Nome Foto"  onclick="javascript: modifica_nome_selezionati();" class="genericInput"/>
                        </div>
                    </div>
                    
                    <!-- MODIFICA TAG -->
                    <div class="wrap">
                        <div id="modifica_tag" style="display: none" class="genericBox">
                        <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px; float:right;" onclick="javscript: $('.genericBox').fadeOut(0, null);">CHIUDI IL BOX ED ESCI</p> 
                            <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">Modifica Tag:</p>
                            <input id="nuovo_tag" name="tag" type="text" value="" class="genericInput" maxlength="7"/>
                            <input type="button" name="modifica" id="modifica" value="Modifica Tag Foto" onclick="javascript: modifica_tag_selezionati();" class="genericInput"/>
                        </div>
                    </div>
                    
                    <!--ELIMINA FOTO SELEZIONATE-->
                    <div class="wrap">
                        <div class="pannello_elimina" style="display: none;">
                            <img src="gallery/theme/head_elimina.png" />
                            <div style="
                            width:436px;
                            height:162px;
                            background:url(gallery/theme/bkg_elimina.png) no-repeat top;
                            text-align:center;
                            ">
                                <img src="gallery/theme/okelimina.png" style="margin-bottom:-20px;" onclick="javascript: elimina_selezionati();"/>
                            <img class="okclose" src="gallery/theme/Noesci.png" onclick="javscript: $('.pannello_elimina').fadeOut(0, null);"/>
                            </div>
                        </div>
                    </div>
				<!--/Pannelli (hide/show)-->


                
                <img src="gallery/theme/gestiscifoto.png" style="margin-left:15px;" />
                <!--opzioni di massa (pulsanti "opzioni foto")-->
                <div class="opzionifotoalbum">
                	<div style="position:absolute; margin:40px 0 0 7px;">
                                <img src="gallery/theme/push_seleziona.png" onclick="javascript: seleziona_tutti();" />
                                <img src="gallery/theme/push_caricafoto.png" onclick="javascript: $('#carica_foto').fadeIn(0, null);" />
                                <img src="gallery/theme/push_eliminafoto.png" onclick="javascript: $('.pannello_elimina').fadeIn(0, null);"/>
                        <img src="gallery/theme/push_cambiatag.png" onclick="javascript: $('#modifica_tag').fadeIn(0, null);" />
                        <a><img src="gallery/theme/push_cambiatitolo.png" onclick="javascript: $('#modifica_nome').fadeIn(0, null);"/></a>
                        <!-- <a><img src="gallery/theme/push_spostain.png" /></a> -->
                    </div>
                </div><br />
                
                <!--Selectpage
                    <div id="optionbar">   
                       <img src="gallery/theme/number_left.png" class="number_left" />
                        <span id="numberfotoinpage">
                            <a href="">[1]</a>&nbsp;&nbsp;
                            <a href="">2</a>&nbsp;&nbsp;
                            <a href="">3</a>&nbsp;&nbsp;
                            <a href="">4</a> &nbsp;&nbsp;
                            <a href="">5</a> &nbsp;&nbsp;
                            <a href="">6</a> &nbsp;&nbsp;
                            <a href="">7</a> &nbsp;&nbsp;
                            <a href="">8</a> &nbsp;&nbsp;
                            <a href="">9</a> &nbsp;&nbsp;
                        </span>
                        <img src="gallery/theme/number_right.png" class="number_right" />
                    </div>-->
                    
                    
                <!--lista foto-->
                <div style="text-align:left; padding:0 0 0 14px;">
                	
                    <!--box foto
                    <div class="wrap_photo">
                    	<div class="copertina_photo" id="NoDrag">
	                        <a href="gallery/photo/nophoto.png">
                            <img src="gallery/theme/copia_vietata_e_punibile_in_tribunale.png"
                            style="background:url(gallery/theme/nophoto.png) no-repeat; height:146px; width:302px;" 
                            class="thumb_photo" />
                            <div class="thumb_protect_photo" ></div>
							</a>
                        </div>
                        <img src="gallery/theme/line_photo.png" class="line_photo" />
                        <p class="title_photo">
                        	SENZA TITOLO
                        </p>
                        <p class="tag_photo">
                        	<font color="#CC0000">TAG:</font>
                            <span class="tagname">ASSENTE</span>
                        </p>
                    </div>-->
                    
                    <ul id="lista_foto">
                        <?php
                        foreach ($lista_foto as $foto) {
                            /*
                            echo "<li id=\"lista_foto_{$foto['id_foto']}\">
                                    <img src=\"../common/thumb_generator.php?file=../foto/{$foto['id_foto']}.jpg\"  /><br/>
                                    {$foto['nome']}<br/>
                                    <a href=\"edit_foto.php?id={$foto['id_foto']}\">Modifica</a><br/>
                                    <a href=\"del_foto.php?id={$foto['id_foto']}\" onclick=\"javascript: return confirm('Sei sicuro di voler eliminare la foto?');\">Elimina</a><br/>
                                  </li>";
                            */
                        
                            echo "
								<li id=\"lista_foto_{$foto['id_foto']}\">
                            
                                    <div class=\"wrap_photo\">
                                        <div class=\"copertina_photo\">
                                                <a href=\"gallery/foto/{$foto['id_foto']}.jpg\">
                                            		<img src=\"gallery/theme/copia_vietata_e_punibile_in_tribunale.png\" style=\"background:url('common/thumb_generator.php?file=../gallery/foto/{$foto['id_foto']}.jpg') no-repeat; height:146px; width:174px;\" class=\"thumb_photo\" />
                                            		<div class=\"thumb_protect_photo\" ></div>
                                                </a>
                                        </div>
                                        <img src=\"gallery/theme/line_photo.png\" class=\"line_photo\" />
                                            
                                        <p class=\"title_photo\">
                                            <input type=\"checkbox\" class=\"foto_check\" name=\"foto_selezionate[]\" value=\"{$foto['id_foto']}\" id=\"foto_selezionate_{$foto['id_foto']}\" />
                                                {$foto['nome']}
                                        </p>
                                        <p class=\"tag_photo\">
                                            <font color=\"#CC0000\">TAG:</font>
                                            <span class=\"tagname\">{$foto['tag']}</span>
                                        </p>
                                    </div>
                                
								</li>";
                        }
                        ?>
                        <!-- <li><a href="add_foto.php?id_album=<?php echo $album['id_album']; ?>">Nuova Foto</a></li> -->
                    </ul>
                    <!--
                    <input type="button" name="visual" onclick="javascript: visualizza_ordinamento();" value="visualizza" />
                    <input type="button" name="salva" onclick="javascript: salva_ordininamento();" value="salva" />
                    -->            

                   <!--Selezione pagine-->
                    <div id="optionbar">   
                        &nbsp;
                        <?php
                        if($pagina_attuale>0){
                            $p = $pagina_attuale-1;
                            echo "<a href=\"{$_SERVER['PHP_SELF']}?id={$album['id_album']}&pagina=$p\"><img src=\"gallery/theme/number_left.png\" class=\"number_left\" /></a>";
                        }else{
                            echo "<img src=\"gallery/theme/number_left.png\" class=\"number_left\" />";
                        }
                       
                        //verifico che sia necessario visualizzare il menù delle pagine
                        $pagina=0;
						if ( $num_foto>0 && $num_foto>$elementi_per_pagina ){
                            echo '<select name="pagine" id="pagine" onchange="javascript: cambia_pagina();" >';
                            
                            while($num_foto>0){ //ciclo per creare una 'option' per ogni pagina
                                echo "<option value=\"$pagina\"";
                                if( $pagina_attuale==$pagina){
                                    echo 'selected="selected"'; //verrà selezionata la pagina attuale
                                }
                                echo " >$pagina</option>";
                                $num_foto -= $elementi_per_pagina;
                                $pagina++;
                            }
                            echo '</select>';
                        }
                        
                        
                        if($pagina_attuale<--$pagina){
                            $p = $pagina_attuale+1;
                            echo "<a href=\"{$_SERVER['PHP_SELF']}?id={$album['id_album']}&pagina=$p\"><img src=\"gallery/theme/number_right.png\" class=\"number_right\" /></a>";
                        }else{
                            echo "<img src=\"gallery/theme/number_right.png\" class=\"number_right\" />";
                        }
                        ?>
                        
                    </div>

                </div></div>
			</div>
            <p style="clear: both"> &nbsp </p>                     	
			<!--FINE PANNELLO CATEGORIA E CREA ALBUM-->

		</div>
        <img src="common/theme/img/wrap_bot.png" />

		<p id="scrollerp">
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CATEGORIE VELOCI  | <span style="margin:-40px 0 !important; position:relative;">
            <marquee direction="right" style="width:800px;">
            	~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK
            </marquee>
            </span>
        </p>

		<!--Footer-->
		<?php include("common/include/footbar/footbar.php");?>

	</body>

</html>