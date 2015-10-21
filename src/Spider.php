<?php

namespace RssAgent;

/**
 * Class Spider
 *
 *	@since 1.0.0
 *	@package RssAgent
 *
 *	@author Damjan Krstevski
 *
 *	@version 1.0.0
 *
 *	@uses curl
 */
abstract class Spider
{

	/**
	 * Get XML data from the given URL.
	 *
	 *	@since 1.0.0
	 *	@access protected
	 *
	 *	@param string $url The RSS feed URL.
	 *	@return mixed XML data from the given URL, FALSE on failure.
	 */
	final protected function xml( $url )
	{
		$spider = curl_init();

		curl_setopt_array(
			$spider,
			array(
				CURLOPT_RETURNTRANSFER 	=> 1,
				CURLOPT_HEADER 			=> 0,
				CURLOPT_URL 			=> filter_var($url, FILTER_VALIDATE_URL),
				CURLOPT_USERAGENT 		=> 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
			)
		);

		$output = curl_exec($spider);

		curl_close($spider);

		return $output;
	} // End of function read_xml();

} // End of class Spider;