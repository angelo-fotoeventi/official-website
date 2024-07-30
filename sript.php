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
	<!--/SCRIPT-->				


	</head>

	<body onload="init()">
        
<!--<form name="boxes">
<input name="box[0]" type="checkbox">
<input name="box[1]" type="checkbox">
<input name="box[2]" type="checkbox">
<input name="box[3]" type="checkbox">
<input name="box[4]" type="checkbox">
<input name="box[5]" type="checkbox">
<input name="box[6]" type="checkbox">
<input name="box[7]" type="checkbox">
<input name="box[8]" type="checkbox">
<input name="box[9]" type="checkbox">
</form>-->

<form>
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />
<input type="checkbox" />


</form>

	</body>

</html>