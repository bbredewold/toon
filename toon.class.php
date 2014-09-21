<?php

class Toon {
	
	public function __construct($email, $pass) {

		$this->email 		= $email;
		$this->pass 		= $pass;
		$this->toonstate 	= false;
		$this->sessiondata 	= '';

	}


	public function login()
	{
		// Build query with login credentials
		$loginParams		= http_build_query(array('username' => $this->email,
													 'password' => $this->pass) );
		// Make initial request with credentials
		$loginJSON 			= file_get_contents('https://toonopafstand.eneco.nl/toonMobileBackendWeb/client/login?'.$loginParams);
		
		// Decode JSON data to Array
		$this->sessiondata 	= json_decode($loginJSON, true);

		// Build query for auth request
		$authParams			= http_build_query(array('clientId' => $this->sessiondata['clientId'],
													 'clientIdChecksum' => $this->sessiondata['clientIdChecksum'],
													 'agreementId' => $this->sessiondata['agreements'][0]['agreementId'],
													 'agreementIdChecksum' => $this->sessiondata['agreements'][0]['agreementIdChecksum'],
													 'random' => uniqid() ) );
		// Make auth start / login request
		$authenticate 		= file_get_contents('https://toonopafstand.eneco.nl/toonMobileBackendWeb/client/auth/start?'.$authParams);
	}


	public function logout()
	{
		// Build query for auth request
		$authParams			= http_build_query(array('clientId' => $this->sessiondata['clientId'],
													 'clientIdChecksum' => $this->sessiondata['clientIdChecksum'],
													 'random' => uniqid() ) );
		// Make logout request
		$authenticate 		= file_get_contents('https://toonopafstand.eneco.nl/toonMobileBackendWeb/client/auth/logout?'.$authParams);
	}


	public function get_toon_state()
	{
		// If toonstate is not set to false, go on
		if ($this->toonstate == false) {

			// Build query for auth request
			$authParams		= http_build_query(array('clientId' => $this->sessiondata['clientId'],
													 'clientIdChecksum' => $this->sessiondata['clientIdChecksum'],
													 'random' => uniqid() ) );
			// Make data retrieve request
			$authenticate 	= file_get_contents('https://toonopafstand.eneco.nl/toonMobileBackendWeb/client/auth/retrieveToonState?'.$authParams);

			// Decode JSON data to Array, save in toonstate var
			$this->toonstate = json_decode($authenticate, true);
		}
	}


	public function refresh_toon_state()
	{
		// Reset toonstate var
		$this->toonstate = false;

		// Run get_toon_state method to refresh data
		$this->get_toon_state();
	}


	public function get_power_usage()
	{
		// Call get_toon_state method
		$this->get_toon_state();

		// Return the actual power usage as JSON
		return $this->toonstate['powerUsage'];
	}


	public function get_gas_usage()
	{
		// Call get_toon_state method
		$this->get_toon_state();

		// Return the actual gas usage as JSON
		return $this->toonstate['gasUsage'];
	}


	public function get_thermostat_info()
	{
		// Call get_toon_state method
		$this->get_toon_state();

		// Return Toon's thermostate info as JSON
		return $this->toonstate['thermostatInfo'];
	}


	public function get_thermostat_states()
	{
		// Call get_toon_state method
		$this->get_toon_state();

		// Return Toon's thermostate states as JSON
		return $this->toonstate['thermostatStates'];
	}



}

?>