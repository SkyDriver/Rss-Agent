## Rss-Agent

Version 1.0.0

Package to read the RSS Feeds from URL according RSS v2 standards (https://validator.w3.org/feed/docs/rss2.html).

Install
-------

This package can be found on [packagist](https://packagist.org/packages/skydriver/rss-agent) and is best loaded using [composer](http://getcomposer.org/).

Usage
-----

```php

use RssAgent\RssAgent;

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
```
