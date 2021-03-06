<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://www2.scs.ryerson.ca/~s37syed/labs/assignments/ass1/style.css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="http://www2.scs.ryerson.ca/~s37syed/labs/assignments/ass1/html5gallery/html5gallery.js"></script>
		<title>Assignment Two - Latest Videos</title>
	</head>
	<body>
		<!-- COOKIE CODE HERE -->
		<?php
			if (isset($_COOKIE["user"]))
			{
				echo "<h1>Welcome back!</h1>";
			}
			else
			{	
				setcookie("user", "Guest", time()+3600);
				echo "<h1>Welcome!</h1>";
			}
		?>
	<h1>Latest Videos</h1>
	<ul>
		<li><a href="http://www2.scs.ryerson.ca/~s37syed/labs/assignments/ass2/">Home</a></li>
        <li><a href="http://www2.scs.ryerson.ca/~s37syed/labs/assignments/ass2/upload/">Upload</a></li>
	</ul>
	<hr>
	<div class="hello">
		<p>These are the latest videos.</p>
	</div>	
	<div class="center">
		<div style="display:block; margin-left: auto; margin-right: auto;" class="html5gallery" data-skin="vertical" data-width="480" data-height="272">
			<?php 
				$file = fopen("/home/s37syed/public_html/labs/assignments/ass2/upload/description/metadata.txt", "r");

				//Output a line of the file until the end is reached
				while ( $line = fgets($file) ) 
				{
						$metadata = explode("\t", $line);
						echo "<a href=\"http://www2.scs.ryerson.ca/~s37syed/labs/assignments/ass2/upload/videos/". $metadata[1] . "\"><img src=\"http://www2.scs.ryerson.ca/~s37syed/labs/assignments/ass2/upload/img/". $metadata[0] ."\" alt=\"" . $metadata[2]. "\"></a>";
				}
				fclose($file);
			?>
		</div>
    </div>
	</body>
</html>