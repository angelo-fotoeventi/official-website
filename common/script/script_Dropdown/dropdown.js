// JavaScript Document

//dropdown topbar

		$(document).ready(function(){
				$('#hideshow_elenco').toggle(function(){
					$('#elenco_gallery').slideDown();
				}, function(){
					$('#elenco_gallery').slideUp();
				});
			});
		$(document).ready(function(){
				$('#hideshow_infogallery').toggle(function(){
					$('#info_gallery').slideDown();
				}, function(){
					$('#info_gallery').slideUp();
				});
			});
		$(document).ready(function(){
				$('#hideshow_accessogallery').toggle(function(){
					$('#accesso_gallery').slideDown();
				}, function(){
					$('#accesso_gallery').slideUp();
				});
			});
