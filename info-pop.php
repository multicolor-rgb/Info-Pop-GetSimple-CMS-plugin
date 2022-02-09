<?php

 
# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Info POP', 	//Plugin name
	'1.0', 		//Plugin version
	'Multicolor',  //Plugin author
	'http://www.multicolor.stargard.pl', //author website
	'Info for site users ( you can use it for all info what do you want, never show after close)', //Plugin description
	'plugins', //page type - on which admin tab to display
	'bulbSettings'  //main function (administration)
);
 
# activate filter 
add_action('theme-footer','bulb_footer'); 
 
# add a link in the admin tab 'theme'
add_action('plugins-sidebar','createSideMenu',array($thisfile,'Info Pop settings'));
 
# functions
function bulb_footer() {

 


    echo<<<END

    
	<style>
    .bulb-content{
        font-size:14px;
     
        box-shadow: 1px 1px 10px rgba(0,0,0,0.3);
        border-radius:10px;
        z-index:999;
        color:#fff;
        padding:20px;
        text-align:center;
        animation:fadeInLefter 250ms linear;
        opacity:0;
        animation-fill-mode:forwards;
        animation-delay:2s;
        cursor:pointer;
    }
    
    @media(max-width:992px){
        .bulb-content{display:none;}
    }
    
    @keyframes fadeInLefter{
        from{
            opacity:0;
            transform:translate(-50px,0)}
        
        to{
            opacity:1;
            transform:translate(0,0)}
    }
    
    .bulb-content .toper-close{
        position:absolute;
        right:5px;
        top:5px;
        font-size:1.2rem;
        
    }
    
    .bulb-content p{
        font-size:0.8rem;	
    }
    
    .bulb-content b{
        font-size:0.9rem}
    
    .bulb-content a{
        text-decoration:underline;
        color:#fff;}
    
</style>


    <script>
    const toper = document.querySelector('.bulb-content');
    const closeToper = document.querySelector('.bulb-content .toper-close');
    closeToper.addEventListener('click',()=>{
    toper.style.display="none";	
    localStorage.closeToperForever = "kliknięto zamknij";
    });        
    if(localStorage.getItem("closeToperForever")!==null){
    toper.style.display="none";	
    };
</script>
END;


echo'<style>.bulb-content{   width:'.file_get_contents('data/other/bulb/width.txt', true).';position:fixed;bottom:'.file_get_contents('data/other/bulb/bottom.txt', true).';left:'.file_get_contents('data/other/bulb/left.txt', true).';right:'.file_get_contents('data/other/bulb/right.txt', true).';top:'.file_get_contents('data/other/bulb/top.txt', true).';background: linear-gradient(to bottom, '.file_get_contents('data/other/bulb/colorBottom.txt', true).', '.file_get_contents('data/other/bulb/colorTop.txt', true).');}</style>';

echo'<div class="bulb-content">';
echo'<img src="/plugins/info-pop/img/close.svg" class="toper-close" style="width:24px;filter:invert(100%);">'.file_get_contents('data/other/bulb/content.txt', true);
echo '</div>';



}
 
function bulbSettings() {

echo <<<ENDI

<style>
.bulb-settings{
    display:grid;
    grid-template-columns:1fr 40px;
    grid-gap:15px;
}


.bulb-settings label{
grid-column:1/2;
}

.bulb-settings input{
    grid-column:2/3;
    padding:5px;
    border-radius:3px;
    border:solid 1px #ddd;
}

.bulb-settings input[type=color]{
    padding:0;
    width:100%;
}

.bulb-settings input[type=submit]{
grid-column:1/3;
margin-top:10px;
background:#000;
color:#fff;
padding:10px;
border:none;
border-radius:5px;
}

.bulb-settings textarea{
grid-column:1/3;
padding:10px;
height:200px;
}


#cke_post-content{
    grid-column:1/3;

}

</style>


ENDI;


echo'<h3>Info Pop settings</h3>';

echo'<form class="bulb-settings" action="#" method="POST">';
echo'<label for="top">top</label><input type="input" name="top" value ="'.@file_get_contents('../data/other/bulb/top.txt').'">';
echo'<label for="top">bottom</label><input name="bottom" type="input" value='.@file_get_contents('../data/other/bulb/bottom.txt').'>';
echo'<label for="left">left</label>  <input name="left" type="input" value="'.@file_get_contents('../data/other/bulb/left.txt').'">';
    
echo'<label for="width">width</label><input name="width" type="input" value="'.@file_get_contents('../data/other/bulb/width.txt').'">';
    echo'<label for="right">right</label><input name="right" type="input" value="'.@file_get_contents('../data/other/bulb/right.txt').'">';

    echo'<label for="color-top">top gradient color</label><input name="color-top" value="'.@file_get_contents('../data/other/bulb/colorTop.txt').'" type="color">';

    echo'<label for="color-bottom">bottom gradient color</label><input name="color-bottom" type="color" value="'.@file_get_contents('../data/other/bulb/colorBottom.txt').'">';
    
    echo'<label for="content">Content</label><textarea id="post-content" name="content">'.@file_get_contents('../data/other/bulb/content.txt').'</textarea>';
    
    echo'<input type="submit" name="submit" value="save settings"></form><p style="text-align:center;margin-top:20px;">Created by Multicolor</p>';



echo <<<ENDED
    <script type="text/javascript" src="template/js/ckeditor/ckeditor.js?t=3.3.15"></script>

			<script type="text/javascript">
			CKEDITOR.timestamp = '3.3.15';
			var editor = CKEDITOR.replace( 'post-content', {
					skin : 'getsimple',
					forcePasteAsPlainText : true,
					language : 'pl',
					defaultLanguage : 'en',
											contentsCss: 'http://localhost/theme/base bs4/editor.css',
										entities : false,
					// uiColor : '#FFFFFF',
					height: '300px',
					baseHref : 'http://localhost/',
					tabSpaces:10,
					filebrowserBrowseUrl : 'filebrowser.php?type=all',
					filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
					filebrowserWindowWidth : '730',
					filebrowserWindowHeight : '300'
					,toolbar: [["Cut","Copy","Paste","PasteFromWord","-","Undo","Redo","Find","Replace","-","SelectAll"],["Bold","Italic","Underline","NumberedList","BulletedList","JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock","Table","TextColor","BGColor","Link","Unlink","Image","RemoveFormat","Source"],"\/",["Styles","Format","Font","FontSize","Undo","Redo","Maximize"],["Templates","AddCMSGrid","AddCMSGridRow","DeleteCMSGridRow","ExpandCMSColLeft","ExpandCMSColRight","SwapCMSCols"],["Iframe","ckawesome","oembed","simplebutton","ckeditor-gwf-plugin","spacingsliders"]]					,extraPlugins:'cmsgrid,ckawesome,colorbutton,oembed,simplebutton,spacingsliders'					
			});

			CKEDITOR.instances["post-content"].on("instanceReady", InstanceReadyEvent);

			function InstanceReadyEvent(ev) {
				_this = this;

				this.document.on("keyup", function () {
					$('#editform #post-content').trigger('change');
					_this.resetDirty();
				});

			    this.timer = setInterval(function(){trackChanges(_this)},500);
			}		

			/**
			 * keep track of changes for editor
			 * until cke 4.2 is released with onchange event
			 */
			function trackChanges(editor) {
				// console.log('check changes');
				if ( editor.checkDirty() ) {
					$('#editform #post-content').trigger('change');
					editor.resetDirty();			
				}
			};

			</script>
ENDED;





$BulbForm  = GSDATAOTHERPATH . '/bulb/';
$top = $BulbForm . 'top.txt';
$bottom = $BulbForm  . 'bottom.txt';
$left = $BulbForm  . 'left.txt';
$right = $BulbForm  . 'right.txt';
$colorTop = $BulbForm  . 'colorTop.txt';
$colorBottom = $BulbForm  . 'colorBottom.txt';
$content = $BulbForm  . 'content.txt';
$width = $BulbForm  . 'width.txt';

$chmod_mode    = 0755;
$folder_exists = file_exists($BulbForm) || mkdir($BulbForm,$chmod_mode);
 
// Save the file (assuming that the folder indeed exists);
if( isset($_POST["submit"]) ){

$topData = $_POST["top"];
$bottomData = $_POST["bottom"];
$leftData = $_POST["left"];
$rightData = $_POST["right"];
$colorTopData = $_POST["color-top"];
$colorBottomData = $_POST["color-bottom"];
$contentData = $_POST["content"];
$widthData = $_POST["width"];


if ($folder_exists) {
  file_put_contents($top, $topData);
  file_put_contents($bottom, $bottomData);
  file_put_contents($left, $leftData);
  file_put_contents($right, $rightData);
  file_put_contents($colorTop, $colorTopData);
  file_put_contents($colorBottom, $colorBottomData);
  file_put_contents($content, $contentData);
  file_put_contents($width, $widthData);

  echo "<meta http-equiv='refresh' content='0'>";

};
};
}
?>