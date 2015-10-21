<?php
use RssAgent\RssAgent;
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>RSS Agent</title>
</head>
<body>

<?php
$url = 'https://packagist.org/feeds/packages.rss';

$rss = new RssAgent( $url );

if( $rss ):
	// You can get every feed channel property 
	printf(
		'<h1>Feed from <a href="%s">%s</a></h1>',
		$url,
		$rss->title
	);

	foreach($rss->feeds() as $feed):
		// You can cat every feed property
		printf(
			'<div class="feed-item">
				<a href="%s" target="_blank">%s</a>
				<p>%s</p>
			</div>',
			$feed->link,
			$feed->title,
			$feed->description
		);
	endforeach;
endif;
?>

</body>
</html>