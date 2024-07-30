		<div id="header">
	
			<!--menu-->
            <div id="wrap_menutop">   
                <img src="common/theme/img/ul_menu_left.png" style="margin: 0 -4px -19px 0;"/>
                <span id="menutop">
                    &nbsp;&nbsp;<a href="index.php">HOME</a>&nbsp;&nbsp;
                    <a href="chisono.php">SU DI ME</a>&nbsp;&nbsp;
                    <a href="contatto.php">CONTATTO</a>&nbsp;&nbsp;
                    <a href="gallery_categorie.php">WEB GALLERY</a> &nbsp;&nbsp;
                </span>
                <img src="common/theme/img/ul_menu_right.png" style="margin: 0 0 -19px -4px;"/>
			</div>
            
			<br />
            <img src="common/theme/img/logo.png"  style="margin-top: -20px;"/>
            <img src="common/theme/img/wrap_top.png"  style="margin-top: -10px;"/>
            
            
    		<!--menu microgallery-->
            <div id="wrap_microgallery">
            	<div id="microgallery_menu">
                   <img id="hideshow_micromenu" src="microgallery/open.png" style="position:absolute; margin:-8px 0 0 -50px;"  />
                   		<div style="overflow:hidden;">
                        <a href="microgallery_reportage.php" style="margin-top:9px;">Reportage</a>
                        <a href="microgallery_ballo.php">Ballo</a>
                        <a href="microgallery_cerimonie.php">Cerimonie</a>
                        <a href="microgallery_ritratti.php">Ritratti</a>
                        <a href="microgallery_sport.php">Sport</a>
                		</div>
                </div>
            </div>
            
            <div id="slider">
              
                <div class="sliderbutton">

                    <div class="arrowposition">
                        <img name="left" src="common/theme/img/slider_left.png" alt="previus foto" 
                        class="sliderbuttonleft" onclick="slideshow.move(-1)"
                        onmouseover="document.left.src='common/theme/img/slider_left_on.png';"
                        onmouseout="document.left.src='common/theme/img/slider_left.png';" />
        
                        <img name="right" src="common/theme/img/slider_right.png" alt="next foto"
                        class="sliderbuttonright" onclick="slideshow.move(1)"
                        onmouseover="document.right.src='common/theme/img/slider_right_on.png';"
                        onmouseout="document.right.src='common/theme/img/slider_right.png';" />
					</div>
                    
                </div>

                
                <div id="slideshow">
                    <ul id="slides">
                        <li><img src="common/theme/img/slider_foto/01.png" style="shot" alt="Sea turtle" /></li>
                        <li><img src="common/theme/img/slider_foto/02.png" style="shot" alt="Coral Reef" /></li>
                        <li><img src="common/theme/img/slider_foto/03.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/04.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/05.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/06.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/07.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/08.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/09.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/10.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/11.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/12.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/13.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/14.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/15.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/16.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/17.png" style="shot" alt="Blue Fish" /></li>
                        <li><img src="common/theme/img/slider_foto/18.png" style="shot" alt="Blue Fish" /></li>
                    </ul>
                </div>
            
                <ul id="pagination" class="pagination">
                    <li onclick="slideshow.pos(1)">&nbsp;</li>
                    <li onclick="slideshow.pos(2)">&nbsp;</li>
                    <li onclick="slideshow.pos(3)">&nbsp;</li>
                    <li onclick="slideshow.pos(4)">&nbsp;</li>
                    <li onclick="slideshow.pos(5)">&nbsp;</li>
                    <li onclick="slideshow.pos(6)">&nbsp;</li>
                    <li onclick="slideshow.pos(7)">&nbsp;</li>
                    <li onclick="slideshow.pos(8)">&nbsp;</li>
                    <li onclick="slideshow.pos(9)">&nbsp;</li>
                    <li onclick="slideshow.pos(10)">&nbsp;</li>
                    <li onclick="slideshow.pos(11)">&nbsp;</li>
                    <li onclick="slideshow.pos(12)">&nbsp;</li>
                    <li onclick="slideshow.pos(13)">&nbsp;</li>
                    <li onclick="slideshow.pos(14)">&nbsp;</li>
                    <li onclick="slideshow.pos(15)">&nbsp;</li>
                    <li onclick="slideshow.pos(16)">&nbsp;</li>
                    <li onclick="slideshow.pos(17)">&nbsp;</li>
                    <li onclick="slideshow.pos(18)">&nbsp;</li>
                </ul>
            
                <script type="text/javascript">
                    var slideshow=new TINY.fader.fade('slideshow',{
                        id:'slides',
                        auto:2,
                        resume:true,
                        navid:'pagination',
                        activeclass:'current',
                        visible:true,
                        position:0
                    });
                </script>
                <img src="common/theme/img/slider_shadow.png" />
            </div>
        
        </div>