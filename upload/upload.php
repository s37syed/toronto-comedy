<?php

	//declare local variables for usage
	$upload_dir_videos = "http://www.shahsyed.com/toronto-comedy/upload/videos/";
	$upload_dir_img = "http://www.shahsyed.com/toronto-comedy/upload/img/";
	$upload_dir_info = "http://www.shahsyed.com/toronto-comedy/upload/description/";
	$upload_desc = "http://www.shahsyed.com/toronto-comedy/upload/description/metadata.txt";
	$error = false;

	
	
	//this is my function
	//it's a header for html so that repeated code can easily be called via this header function
	function htmlHeader() 
	{
		echo '<!DOCTYPE html>';
		echo '<html>';
		echo '<head>';
		echo '<link rel="stylesheet" type="text/css" href="http://www.shahsyed.com/toronto-comedy/style.css">';
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	}
	
	//error checking

	foreach($_FILES as $name => $file)
	{
		/* error while uploading shit */
		if($name == "thumbnail" && !preg_match("/\.(gif|png|jpg|jpeg|bmp|tiff)$/", $file['name']))
		{
			htmlHeader();
			echo '<title>Error</title></head><body><h1>Error: Image uploaded was invalid.</h1><div class="hello"><p>Please go back and try to upload a valid image file.</p></div></body></html>';
			$error = true;
			break;
			exit;
		}
		if($name == "video" && !preg_match("/\.(mp4|ogg)$/", $file['name']))
		{
			htmlHeader();
			echo '<title>Error</title></head><body><h1>Error: Video uploaded was invalid.</h1><div class="hello"><p>Please go back and try to upload a valid video file.</p></div></body></html>';
			$error = true;
			break;
			exit;
		}
	}
	
	

	if ($error == false) 
	{

		$lines = count(file($upload_desc)); 
		if ($lines == 5) 
		{
			$contents = file($upload_desc, FILE_IGNORE_NEW_LINES);
			$first_line = array_shift($contents);
			$current = implode("\r\n", $contents) . "\n";
			file_put_contents($upload_desc, $current);
			// Write the contents back to the file
		}

		foreach($_FILES as $name => $file)
		{
			if ($name == "thumbnail") 
			{
				$target = $upload_dir_img . $file['name'];
				move_uploaded_file($file['tmp_name'], $target);
				$video_thumb = $file['name'];
				// Open the file to get existing content
				$current = file_get_contents($upload_desc);
				// Append a new person to the file
				$current .= $video_thumb . "\t";
				// Write the contents back to the file
				file_put_contents($upload_desc, $current);

			}
			elseif ($name == "video") 
			{
				$target = $upload_dir_videos . $file['name'];
				move_uploaded_file($file['tmp_name'], $target);
				$video_name = $file['name'];
					// Open the file to get existing content
				$current = file_get_contents($upload_desc);
				// Append a new person to the file
				$current .= $video_name . "\t";
				// Write the contents back to the file
				file_put_contents($upload_desc, $current);
			}
		}
		$video_info = $_POST['description'];
		// Open the file to get existing content
		$current = file_get_contents($upload_desc);
		// Append a new person to the file
		$current .= $video_info . "\r\n";
		// Write the contents back to the file
		file_put_contents($upload_desc, $current);
		htmlHeader();
		?>
		<title>Youtube Clone - Toronto Comedy - File uploaded succesfully!</title>
		</head>
		<body>
		<h1>File uploaded succesfully!</h1>
		<ul>
			<li><a href="hhttp://www.shahsyed.com/toronto-comedy/upload">Upload</a></li>
			<li><a href="http://www.shahsyed.com/toronto-comedy/videos.php">Videos</a></li>
		</ul>
		<hr>
		<div class="hello">
			<p>Your file has been uploaded to the TorCom directory.</p>
		</div>
		<div class="hello"><p>Thanks for uploading your video.</p></div>
		<div class="hello">
		<p>Thumbnail:</p>
		<p><img src="http://www.shahsyed.com/toronto-comedy/upload/img/<?php echo $video_thumb?>" alt="photo" width="100" height="100"/></p>
		<p>Description:</p>
		<p><?php echo $video_info?></p>
		<p>Video:</p>
		<video class="center" width="640" height="480" controls>
		<source src="http://www.shahsyed.com/toronto-comedy/upload/videos/<?php echo $video_name?>" type="video/mp4">
		<source src="http://www.shahsyed.com/toronto-comedy/upload/videos/<?php echo $video_name?>" type="video/ogg">
		</video>
		</div>
		</body>
		</html>
	<?php
	}
?>