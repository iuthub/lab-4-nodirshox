<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">
			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
		<div id="listarea">
			<ul id="musiclist">
				<?php
				if(isset($_REQUEST["playlist"])){
					$playlist=$_REQUEST["playlist"];
					$file_contents=file_get_contents("songs/".$playlist);
					$arr_of_songs = explode("\n",$file_contents);
					foreach($arr_of_songs as $filename){
						$fullpath="songs/".$filename;
					?>
					<li class="mp3item">
						<a href="songs/<?=$filename?>"><?=$filename?></a>
					</li> 
					<?php
					}
				} else { ?>

				<?php
					foreach(glob("songs/*.mp3") as $filename){ ?>
						<li class="mp3item">
							<a href="<?=$filename?>"><?=basename($filename)?></a> 
		<?php
		$size=filesize($filename);
		$file_info=$size." b";
		if($size>1024){
			$file_info = round($size/1024,2)." kb";
			if($size>1024*1024){
				$file_info=round($size/1024/1024.2). " mb";
			}
		}
		echo "(".$file_info.")";
		?>
		
						</li>
					<?php
					}
				?>

				<?php
					foreach(glob("songs/*.txt") as $filename){ ?>
						<li class="playlistitem">
							<a href="<?=$filename?>"><?=basename($filename)?></a>
						</li>
					<?php
					}
					}
				?>

			</ul>
		</div>
	</body>
</html>