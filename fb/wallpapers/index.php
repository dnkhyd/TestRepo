<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	$filename = strtolower(date("Fy").".jpg");
	$sizes = array("1920x1280", "1600x1200", "1680x1050", "1400x1050", "1280x1024", "1440x900", "1152x864", "1280x768", "1024x768");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta name="title" content="My Kerala - Wallpapers - <?php echo date("F Y"); ?>"/>
		<meta name="description" content="Get a new wallpaper every month featuring the most beautiful destinations of god's own country."/>
		<link rel="image_src" href="http://mykeralahotels.in/fb/wallpapers/200-200-<?php echo $filename; ?>" />
		<meta property="og:title" content="My Kerala - Wallpapers - <?php echo date("F Y"); ?>"/>
		<meta property="og:type" content="article"/>
		<meta property="og:image" content="http://mykeralahotels.in/fb/wallpapers/200-200-<?php echo $filename; ?>"/>
		<meta property="og:url" content="http://mykeralahotels.in/fb/wallpapers/"/>
		<meta property="og:site_name" content="My Kerala"/>
		<meta property="fb:admins" content="AntoCThomas"/>
		<title>My Kerala - Wallpapers - <?php echo date("F Y"); ?></title>
		<style>
			*
			{
				margin: 0px;
			}
			html, body
			{
				font-family: sans-serif;
				height: 100%;
			}
			h1
			{
				margin-bottom: 10px;
			}
			p
			{
				font-size: 11px;
				margin: 10px 0px;
			}
			#wrap
			{
				min-height: 100%;
				height: auto !important;
				height: 100%;
				margin: 0 auto -40px;
			}
			#header
			{
				border-top: 4px solid #0f5b35;
				width: 100%;
				text-align:center;
			}
			#intro
			{
				width: 460px;
				margin: auto;
				text-align: center;
			}
			div.tags
			{
				margin-top: 10px;
				width:460px;
				text-align: center;
			}
			div.tags a
			{
				display: inline-block;
				white-space: nowrap;
				padding:0px 8px;
				margin:5px;
				background:#8b986c;
				font: 10px Verdana;
				line-height:25px;
				text-decoration:none;
				text-transform:uppercase;
				color: #ffffff;
				-moz-border-radius: 5px;
				border-radius: 5px;
			}
			div.tags a:hover
			{
				background-color:#0f5b35;
			}
			input
			{
				margin: 0px 10px;
			}
			#footer
			{
				padding: 5px;
				height: 30px;
				text-align: center;
				background: #0f5b35;
				color: #ffffff;
			}
			#push
			{
				height: 4em;
			}
		</style>
		<script>
			changeLink = function()
			{
				var link = document.getElementById("custom");
				var cw = document.getElementById("cw");
				var ch = document.getElementById("ch");
				link.href = cw.value+'-'+ch.value+'-<?php echo $filename;?>';
			}
		</script>
	</head>
	<body>
		<div id="wrap">
			<div id="header"><a href="http://mykeralahotels.in"><img src="logo.jpg" border="0"></a></div>
			<div id="intro"><h1>Wallpaper Downloads</h1>
				<p>Gorgeous images of kerala, you can use to liven up your desktop.</p>
				<p><strong>Image of the month</strong></p>
				<p><img src="320-240-<?php echo $filename; ?>"></p>
				<p><strong>Choose a size:</strong></p>
				<div class="tags">
				<?php
					foreach ($sizes as $value)
					{
						$split = explode("x",$value);
						echo "<a href='$split[0]-$split[1]-$filename'>$value</a>";
					}
				?>
				</div>
				<div class="tags">
					<form>
						<p><strong>Or customise your size:</strong></p>
						<p>
							<input type="text" placeholder="width" size="6" id="cw" onchange="changeLink()"> x
							<input type="text" placeholder="height" size="6" id="ch" onchange="changeLink()">
						</p>
						<a href="#" id="custom">Download</a>
					</form>
				</div>
			</div>
			<div id="push"></div>
		</div>
		<div id="footer">
			<p>All content &copy; <?php echo date("Y"); ?> GOC Responsible Travels and Tourism Pvt Ltd. All rights reserved.
			</p>
		</div>
		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-719305-2']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</body>
</html>