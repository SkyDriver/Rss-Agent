<?php

namespace RssAgent;

/**
 * Class RssAgent
 *
 *	@since 1.0.0
 *	@package RssAgent
 *
 *	@author Damjan Krstevski
 *
 *	@version 1.0.0
 *
 *	@uses SimpleXmlElement to parse XML data
 *	@uses \RssAgent\Spider::xml() to get the XML data
 */
class RssAgent extends Spider
{
	/**
	 * @var const Package version
	 */
	const VERSION = '1.0.0';



	/**
	 *	@since 1.0.0
	 *	@var array $feeds RSS data
	 */
	private $feeds;





	/**
	 * Object constructor.
	 *
	 *	@since 1.0.0
	 *
	 *	@param string $url RSS feed URL
	 *
	 *	@return void
	 */
	final public function __construct( $url )
	{
		if ($url)
			$this->rss($url);
	} // End of function __construct();





	/**
	 * Object destructor. Clear the memory.
	 *
	 *	@since 1.0.0
	 *
	 *	@return void.
	 */
	public function __destruct()
	{
		unset($this->feeds);
	} // End of function __construct();





	/**
	 * Read the RSS data from the given URL and set into feed data.
	 * Note: This function will delete the old feed data.
	 *
	 *	@since 1.0.0
	 *	@access public
	 *
	 *	@param string $url RSS feed URL
	 *
	 *	@return mixed Object of SimpleXmlElement or falce.
	 */
	final public function rss( $url )
	{
		// Prevent from exceptions
		if (empty($url) || !class_exists('\SimpleXmlElement') || !function_exists('curl_init'))
			return $this->feeds = false;

		// Try to get the XML data
		$xml = $this->xml($url);
		if (empty($xml))
			return $this->feeds = false;

		// Parse and set into feed data.
		$dom = new \SimpleXmlElement( $xml );
		if (property_exists($dom, 'channel'))
			$this->feeds = $dom->channel;

		// Clear memory
		unset($dom);

		return true;
	} // End of function rss();





	/**
	 * Get all feed items.
	 *
	 *	@since 1.0.0
	 *	@access public
	 *
	 *	@return array All RSS feed items.
	 */
	public function feeds()
	{
		return empty($this->feeds) ? array() : $this->feeds->item;
	} // End of function feeds();





	/**
	 * Get the properties from feeds.
	 *
	 *	@since 1.0.0
	 *
	 *	@param string $key The feed property
	 *
	 *	@return mixed Property value if the property exists or NULL.
	 */
	public function __get( $key )
	{
		return (is_object($this->feeds) && property_exists($this->feeds, $key)) ? $this->feeds->{$key} : null;
	} // End of function __get();

} // End of class RssAgent;
