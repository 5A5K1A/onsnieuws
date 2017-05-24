<?
/**
 * Class to create Woocommerce user
 */
class Control_Woocommerce_User_Create extends Control_Woocommerce {

	private $sUserEmail;
	private $sUserName;
	private $sUserPassw;

	public function __construct() {

		parent::__construct();

		if(empty($this->aData['email']) || empty($this->aData['username']) || empty($this->aData['password']) ) {
			$this->Error('No valid data posted');
		}

		$this->sUserEmail = $this->aData['email'];
		$this->sUserName  = $this->aData['username'];
		$this->sUserPassw = $this->aData['password'];

		if( $iUserId = email_exists($this->sUserEmail) ) {
			p($iUserId);
			// update user?? @todo
			$this->Error('Existing email address, try logging in with your username & password (ID: '.$iUserId.')');
			exit;
		}

		if( $iUserId = username_exists($this->sUserName) ) {
           p($iUserId);
			// update user?? @todo
			$this->Error('Existing username, try logging in with your username & password (ID: '.$iUserId.')');
			exit;
		}

		$iUserId = $this->CreateUser();
		p($iUserId);
			$this->Success('User created (ID: '.$iUserId.')');
			wc_set_customer_auth_cookie($iUserId);

		exit;
	}

	/**
	 * Creates a Woocommerce user.
	 * @return   int/WP_Error   User ID or Error object on failure.
	 */
	private function CreateUser() {
		return wc_create_new_customer($this->sUserEmail, $this->sUserName, $this->sUserPassw);
	}
}


