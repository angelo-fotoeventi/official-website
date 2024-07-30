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
    	ANGELFOTOEVENTI
	</title>

	<meta name="description" lang="it"
     content="
     DESCRIZIONE
     " />

	<!--SITETHUMB-->	<link rel="image_src" 	href="common/template/thumbsite.png" />
	<!--FAVICON-->		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
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
	</style>
	<!--/WEBFONT-->

	<!--SCRIPT-->				

	<!--slidefade-->
	<link href="common/theme/css/css_slider/Slidecss.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="common/script/script_slide/packed.js"></script>
	<script type="text/javascript" src="common/script/script_slide/tinyfader.js"></script>
	<!--/SCRIPT-->				


	</head>

	<body>
        
        <!--header-->
        <?php include("common/include/header/header.php");?>

        <!--content-->
        <div id="content">

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