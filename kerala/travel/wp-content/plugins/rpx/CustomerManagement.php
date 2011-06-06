<?php

if (!class_exists("GetWebServiceVersion")) {
/**
 * GetWebServiceVersion
 */
class GetWebServiceVersion {
}}

if (!class_exists("GetWebServiceVersionResponse")) {
/**
 * GetWebServiceVersionResponse
 */
class GetWebServiceVersionResponse {
	/**
	 * @access public
	 * @var string
	 */
	public $GetWebServiceVersionResult;
}}

if (!class_exists("recordLogin")) {
/**
 * recordLogin
 */
class recordLogin {
	/**
	 * @access public
	 * @var Customer
	 */
	public $customer;
}}

if (!class_exists("Customer")) {
/**
 * Customer
 */
class Customer {
	/**
	 * @access public
	 * @var string
	 */
	public $customerName;
	/**
	 * @access public
	 * @var string
	 */
	public $customerStatus;
	/**
	 * @access public
	 * @var ArrayOfContact
	 */
	public $contactInformation;
	/**
	 * @access public
	 * @var ArrayOfAddress
	 */
	public $customerAddressInformation;
	/**
	 * @access public
	 * @var ArrayOfCustomerLogin
	 */
	public $customerLoginDetails;
}}

if (!class_exists("Contact")) {
/**
 * Contact
 */
class Contact {
	/**
	 * @access public
	 * @var string
	 */
	public $contact_type;
	/**
	 * @access public
	 * @var string
	 */
	public $contact_info;
}}

if (!class_exists("Address")) {
/**
 * Address
 */
class Address {
	/**
	 * @access public
	 * @var string
	 */
	public $AddressLine1;
	/**
	 * @access public
	 * @var string
	 */
	public $AddressLine2;
	/**
	 * @access public
	 * @var string
	 */
	public $AddressLine3;
	/**
	 * @access public
	 * @var City
	 */
	public $CityInformation;
	/**
	 * @access public
	 * @var State
	 */
	public $StateInformation;
	/**
	 * @access public
	 * @var Country
	 */
	public $CountryInformation;
	/**
	 * @access public
	 * @var string
	 */
	public $Postal;
}}

if (!class_exists("City")) {
/**
 * City
 */
class City {
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $CityId;
	/**
	 * @access public
	 * @var string
	 */
	public $CityName;
	/**
	 * @access public
	 * @var History
	 */
	public $HistoryInformation;
}}

if (!class_exists("History")) {
/**
 * History
 */
class History {
	/**
	 * @access public
	 * @var sdateTime
	 */
	public $EffectiveDate;
	/**
	 * @access public
	 * @var string
	 */
	public $Status;
}}

if (!class_exists("State")) {
/**
 * State
 */
class State {
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $StateId;
	/**
	 * @access public
	 * @var string
	 */
	public $StateName;
	/**
	 * @access public
	 * @var History
	 */
	public $HistoryInformation;
}}

if (!class_exists("Country")) {
/**
 * Country
 */
class Country {
	/**
	 * @access public
	 * @var sdecimal
	 */
	public $CountryId;
	/**
	 * @access public
	 * @var string
	 */
	public $CountryName;
	/**
	 * @access public
	 * @var History
	 */
	public $History;
}}

if (!class_exists("CustomerLogin")) {
/**
 * CustomerLogin
 */
class CustomerLogin {
	/**
	 * @access public
	 * @var string
	 */
	public $LoginId;
	/**
	 * @access public
	 * @var string
	 */
	public $LoginDomain;
	/**
	 * @access public
	 * @var sdateTime
	 */
	public $LoginSetupOnDate;
	/**
	 * @access public
	 * @var ArrayOfString
	 */
	public $loginLog;
}}

if (!class_exists("recordLoginResponse")) {
/**
 * recordLoginResponse
 */
class recordLoginResponse {
	/**
	 * @access public
	 * @var sint
	 */
	public $recordLoginResult;
}}

if (!class_exists("SecuredWebServiceHeader")) {
/**
 * SecuredWebServiceHeader
 */
class SecuredWebServiceHeader {
	/**
	 * @access public
	 * @var string
	 */
	public $Username;
	/**
	 * @access public
	 * @var string
	 */
	public $Password;
	/**
	 * @access public
	 * @var string
	 */
	public $AuthenticatedToken;
}}

if (!class_exists("addCustomerAddressInformation")) {
/**
 * addCustomerAddressInformation
 */
class addCustomerAddressInformation {
	/**
	 * @access public
	 * @var sint
	 */
	public $customerId;
	/**
	 * @access public
	 * @var Address
	 */
	public $customerAddress;
}}

if (!class_exists("addCustomerAddressInformationResponse")) {
/**
 * addCustomerAddressInformationResponse
 */
class addCustomerAddressInformationResponse {
	/**
	 * @access public
	 * @var sint
	 */
	public $addCustomerAddressInformationResult;
}}

if (!class_exists("associateIds")) {
/**
 * associateIds
 */
class associateIds {
	/**
	 * @access public
	 * @var CustomerLogin
	 */
	public $customerLoginRequestor;
	/**
	 * @access public
	 * @var CustomerLogin
	 */
	public $customerLoginRecepient;
}}

if (!class_exists("associateIdsResponse")) {
/**
 * associateIdsResponse
 */
class associateIdsResponse {
	/**
	 * @access public
	 * @var sint
	 */
	public $associateIdsResult;
}}

if (!class_exists("CustomerManagement")) {
/**
 * CustomerManagement
 * @author WSDLInterpreter
 */
class CustomerManagement extends SoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	private static $classmap = array(
		"GetWebServiceVersion" => "GetWebServiceVersion",
		"GetWebServiceVersionResponse" => "GetWebServiceVersionResponse",
		"recordLogin" => "recordLogin",
		"Customer" => "Customer",
		"Contact" => "Contact",
		"Address" => "Address",
		"City" => "City",
		"History" => "History",
		"State" => "State",
		"Country" => "Country",
		"CustomerLogin" => "CustomerLogin",
		"recordLoginResponse" => "recordLoginResponse",
		"SecuredWebServiceHeader" => "SecuredWebServiceHeader",
		"addCustomerAddressInformation" => "addCustomerAddressInformation",
		"addCustomerAddressInformationResponse" => "addCustomerAddressInformationResponse",
		"associateIds" => "associateIds",
		"associateIdsResponse" => "associateIdsResponse",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl="http://testservice.mykeralahotels.in/services/management/CustomerManagement.asmx?WSDL", $options=array("Exception"=>"true")) {
		foreach(self::$classmap as $wsdlClassName => $phpClassName) {
		    if(!isset($options['classmap'][$wsdlClassName])) {
		        $options['classmap'][$wsdlClassName] = $phpClassName;
		    }
		}
		parent::__construct($wsdl, $options);
	}

	/**
	 * Checks if an argument list matches against a valid argument type list
	 * @param array $arguments The argument list to check
	 * @param array $validParameters A list of valid argument types
	 * @return boolean true if arguments match against validParameters
	 * @throws Exception invalid function signature message
	 */
	public function _checkArguments($arguments, $validParameters) {
		$variables = "";
		foreach ($arguments as $arg) {
		    $type = gettype($arg);
		    if ($type == "object") {
		        $type = get_class($arg);
		    }
		    $variables .= "(".$type.")";
		}
		if (!in_array($variables, $validParameters)) {
		    throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
		}
		return true;
	}

	/**
	 * Service Call: GetWebServiceVersion
	 * Parameter options:
	 * (GetWebServiceVersion) parameters
	 * (GetWebServiceVersion) parameters
	 * @param mixed,... See function description for parameter options
	 * @return GetWebServiceVersionResponse|string
	 * @throws Exception invalid function signature message
	 */
	public function GetWebServiceVersion($mixed = null) {
		$validParameters = array(
			"(GetWebServiceVersion)",
			"(GetWebServiceVersion)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("GetWebServiceVersion", $args);
	}


	/**
	 * Service Call: recordLogin
	 * Parameter options:
	 * (recordLogin) parameters
	 * (recordLogin) parameters
	 * @param mixed,... See function description for parameter options
	 * @return recordLoginResponse
	 * @throws Exception invalid function signature message
	 */
	public function recordLogin($mixed = null) {
		$validParameters = array(
			"(recordLogin)",
			"(recordLogin)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		try {
			$responceValue=$this->__soapCall("recordLogin", $args);
		return $responceValue;
		} catch (SoapFault $e) {
			echo "<pre>";
			echo $e->getMessage();
			 print_r($args);
			print_r($e->detail);
			echo "</pre>";
		}
		
	}


	/**
	 * Service Call: addCustomerAddressInformation
	 * Parameter options:
	 * (addCustomerAddressInformation) parameters
	 * (addCustomerAddressInformation) parameters
	 * @param mixed,... See function description for parameter options
	 * @return addCustomerAddressInformationResponse
	 * @throws Exception invalid function signature message
	 */
	public function addCustomerAddressInformation($mixed = null) {
		$validParameters = array(
			"(addCustomerAddressInformation)",
			"(addCustomerAddressInformation)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("addCustomerAddressInformation", $args);
	}


	/**
	 * Service Call: associateIds
	 * Parameter options:
	 * (associateIds) parameters
	 * (associateIds) parameters
	 * @param mixed,... See function description for parameter options
	 * @return associateIdsResponse
	 * @throws Exception invalid function signature message
	 */
	public function associateIds($mixed = null) {
		$validParameters = array(
			"(associateIds)",
			"(associateIds)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("associateIds", $args);
	}


}}

?>