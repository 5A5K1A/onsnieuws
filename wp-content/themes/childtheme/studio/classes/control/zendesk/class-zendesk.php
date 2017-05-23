<?
/**
 * Class to fetch Zendesk data
 */
class Control_Zendesk extends Control {

	private $sDomain;
	private $sLocale;
	private $sUrlBase;
	private $sUrlLocale;

	private $sErrorConn;

	public function __construct() {

		// @todo: extra security -> ACF Pro is required
		if( !defined('ZD_SUBDOMAIN') || !defined('ZD_LOCALE') ) {
			$message = __("First install ACF Pro! (or just provide the right settings)", THEME_SLUG);
			return $this->ErrorObject($message);
			exit;
		}

		// setup url
		$this->sDomain    = ZD_SUBDOMAIN;
		$this->sLocale    = ZD_LOCALE;
		$this->sUrlBase   = 'https://'.$this->sDomain.'.zendesk.com/api/v2/help_center/';
		$this->sUrlLocale = $this->sUrlBase.$this->sLocale.'/';

		$this->sErrorConn = "There's no connection with Zendesk. Contact your administrator.";

	}

	public function GetUrlBase() {
		return $this->sUrlBase;
	}

	public function GetUrlLocale() {
		return $this->sUrlLocale;
	}

	public function GetConnError() {
		return $this->sErrorConn;
	}
}
