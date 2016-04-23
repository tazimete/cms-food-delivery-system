<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_controller extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		
		//Loading Helper 
		$this->load->helper(array('form', 'url'));
		
		//Loading Library 
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		//Loading Model
		$this->load->model('user_model', 'UserModel');
		$this->load->model('client_model', 'ClientModel');
		$this->load->model('rider_model', 'RiderModel');
		$this->load->model('outlet_model', 'OutletModel');
		$this->load->model('singpost_model', 'SingpostModel');
		$this->load->model('singpost_model', 'SingpostModel');
		$this->load->model('option_model', 'OptionModel');
		$this->load->model('order_model', 'OrderModel');
		
	}

	public function index(){
		
	}
	
	//Check Rider 
	public function check_rider($email, $password){
		//$riderData = this->input->post();
		$riderEmail = urldecode(utf8_decode($email));
		$riderPassword = urldecode(utf8_decode($password));
		
		if(!empty($email)){
			$rider = $this->RiderModel->get_rider_by_email_and_password($riderEmail, $riderPassword);
		
			if($rider){
				$status = $this->RiderModel->change_rider_status_by_id($rider->id, 1);
				$data["error"] = false;
				$data["id"] = $rider->id;
				$data["name"] = $rider->name;
				$data["email"] = $rider->email;
				$data["password"] = $rider->password;
				$data["bike_number"] = $rider->bike_number;
				$data["contact_number"] = $rider->contact_number;
				$data["created_date"] = $rider->created_date;
				$data["profile_picture"] = $rider->profile_picture;
				$data["status"] = $status;
				
				echo json_encode($data);
				exit;
			}else{
				$data["error"] = true;
				$data["error_message"] = "Failed to login";
				
				echo json_encode($data);

				exit;
			}
		}
		
	}
	
	
	//Check Client 
	public function check_client($email, $password){
		//$clientData = this->input->post();
		$clientEmail = urldecode(utf8_decode($email));
		$clientPassword = urldecode(utf8_decode($password));
		
		if(!empty($email)){
			$client = $this->ClientModel->get_client_by_email_and_password($clientEmail, $clientPassword);
		
			if($client){
				$status = $this->ClientModel->change_client_status_by_id($client->id, 1);
				$data["error"] = false;
				$data["id"] = $client->id;
				$data["company_name"] = $client->company_name;
				$data["email"] = $client->email;
				$data["password"] = $client->password;
				$data["location"] = $client->location;
				$data["contact_number"] = $client->contact_number;
				$data["company_postal_code"] = $client->company_postal_code;
				$data["company_unit_number"] = $client->company_unit_number;
				$data["billing_address"] = $client->billing_address;
				$data["contact_person_name"] = $client->contact_person_name;
				$data["contact_person_number"] = $client->contact_person_number;
				$data["contact_person_email"] = $client->contact_person_email;
				$data["client_type"] = $client->client_type;
				$data["created_date"] = $client->created_date;
				$data["status"] = $status;
				
				echo json_encode($data);
				exit;
			}else{
				$data["error"] = true;
				$data["error_message"] = "Failed to login";
				
				echo json_encode($data);
				exit;
			}
		}
		
	}
	
	//Change RiderLocation 
	public function change_rider_location($id, $lat, $lng){
		$result = $this->RiderModel->change_rider_location_by_id($id, $lat, $lng);
		
		if($result){
			$data["error"] = false;
			$data["success_message"] = "Location changed";
				
			echo json_encode($data);
			exit;
		}else{
			$data["error"] = true;
			$data["error_message"] = "Failed to change location";
				
			echo json_encode($data);
			exit;
		}
	}
	
	
	//Get all outlet by client id 
	public function get_all_outlet_by_client_id($id){
		$client = $this->ClientModel->get_client_by_id($id);
		
		if($client){
			$data["error"] = false;
			$data["success_message"] = "Got outlets";
			$data["outlet_0"] = $client->company_name;
			$data["outlet_id_0"] = $client->id;
			$data["outlet_type_0"] = 1;
			$data["length"] = 1;
			
			$outlets = $this->OutletModel->get_all_outlet_by_client_id($id);
			
			if($outlets){
				foreach($outlets as $index => $outlet){
					$data["outlet_".($index+1)] = $outlet->name;
					$data["outlet_id_".($index+1)] = $outlet->id;
					$data["outlet_type_".($index+1)] = 2;
				}
			
				$data["length"] = count($outlets)+1;
			}
			
			echo json_encode($data);
			exit;
		}else{
			$data["error"] = true;
			$data["error_message"] = "Failed to get outlet";
				
			echo json_encode($data);
			exit;
		}
	}
	
	//Get address by postal code and measure the distance 
	public function get_address_by_postal_code($deliverPostalCode, $outletId, $outletType){
		$singpost = $this->SingpostModel->get_address_by_postal_code($deliverPostalCode);
		
		if($singpost){
			$data["error"] = false;
			$data["success_message"] = "Address Found";
			$data["zip_bulding_no"] = $singpost->zip_bulding_no;
			$data["zip_bulding_name"] = $singpost->zip_bulding_name;
			$data["zip_street_name"] = $singpost->zip_street_name;
			$data["zip_code"] = $singpost->zip_code;
			
			//Get outlet postcode 
			if($outletType == 1){
				$outletPostalCode = $this->ClientModel->get_postal_code_by_id($outletId);
			}else if($outletType == 2){
				$outletPostalCode = $this->OutletModel->get_postal_code_by_id($outletId);
			}
			
			$distance = (float) $this->get_distance_between_outlet_to_deliver_address($outletPostalCode, $deliverPostalCode);
			$MAX_DISTANCE_ORDER = $this->OptionModel->get_option_by_key("max-distance-order");
			$MAX_DISTANCE_RIDER = $this->OptionModel->get_option_by_key("max-distance-rider");
			
			$MAX_DISTANCE_ORDER = (float) $MAX_DISTANCE_ORDER;
			$MAX_DISTANCE_RIDER = (float) $MAX_DISTANCE_RIDER;
			
			if(!$MAX_DISTANCE_ORDER || empty($MAX_DISTANCE_ORDER)){
				$MAX_DISTANCE_ORDER = 10000;
			}
			
			if(!$MAX_DISTANCE_RIDER || empty($MAX_DISTANCE_RIDER)){
				$MAX_DISTANCE_RIDER = 10000;
			}
			
			//Check distance is greater or not 
			if($distance > 0 && $distance <= $MAX_DISTANCE_ORDER){
				$data["distance"] = true;
				$data["success_message"] = "Postal Code is ok";
			}else{
				$data["distance"] = false;
				$data["error"] = true;
				$data["error_message"] = "Please enter postcode within ".$MAX_DISTANCE_ORDER."km of outlet";
				
				echo json_encode($data);
				exit;
			}
			
			echo json_encode($data);
			exit;
		}else{
			$data["error"] = true;
			$data["error_message"] = "Address not found. Please enter valid postal code";
				
			echo json_encode($data);
			exit;
		}
	}
	
	//Get distance from outlet address to delivery address 
	public function get_distance_between_outlet_to_deliver_address($outletPostCode, $deliverPostCode){
		$base_url = 'http://maps.googleapis.com/maps/api/directions/json?sensor=false';
		$mode = 'driving';
		$units = 'imperial'; 
			
		$locationsUrl = $base_url."&origin=".$outletPostCode."&destination=".$deliverPostCode."&sensor=false&mode=".$mode."&units=".$units;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $locationsUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$distanceData = curl_exec($ch);
		curl_close($ch);
		$distanceData = json_decode($distanceData, TRUE);
		
		if(array_key_exists("routes", $distanceData)){
			$distance = (float) $distanceData['routes'][0]['legs'][0]['distance']['text'];
			$distance = $distance*1.609;
			return $distance;
		}else{
			return 10000;
		}
		
		
	}
	
	
	//Send order notification to rider and calculate distance 
	public function send_order_to_rider(){
		
		//Post data from Android 
		$ClientID = $_POST['client_id'];
		$outletID = $_POST['outlet_id'];
		$outletName = $_POST['outlet_name'];
		$outletType = $_POST['outlet_type'];
		$pickupDateTime = $_POST['pickup_datetime'];
		$deliverDateTime = $_POST['deliver_datetime'];
		$mobileNumber = $_POST['mobile_number'];
		$customerName = $_POST['customer_name'];
		$postalCode = $_POST['postal_code'];
		$address = $_POST['address'];
		$unitNumberFirst = $_POST['unit_number_first'];
		$unitNumberLast = $_POST['unit_number_last'];
		$foodCost = $_POST['food_cost'];
		$receiptNumber = $_POST['receipt_number'];
		
		//Bind the post data to data variable 
		$data['client_id'] = $ClientID;
		$data['outlet_id'] = $outletID;
		$data['outlet_name'] = $outletName;
		$data['outlet_type'] = $outletType;
		$data['pickup_datetime'] = $pickupDateTime;
		$data['deliver_datetime'] = $deliverDateTime;
		$data['mobile_number'] = $mobileNumber;
		$data['customer_name'] = $customerName;
		$data['postal_code'] = $postalCode;
		$data['address'] = $address;
		$data['unit_number_first'] = $unitNumberFirst;
		$data['unit_number_last'] = $unitNumberLast;
		$data['food_cost'] = $foodCost;
		$data['receipt_number'] = $receiptNumber;
		
		
		
		$loggedInRiders = $this->RiderModel->get_all_signed_in_rider();
		
		$MAX_DISTANCE_ORDER = $this->OptionModel->get_option_by_key("max-distance-order");
		$MAX_DISTANCE_RIDER = $this->OptionModel->get_option_by_key("max-distance-rider");
			
		if(!$MAX_DISTANCE_ORDER || empty($MAX_DISTANCE_ORDER)){
			$MAX_DISTANCE_ORDER = 10000;
		}
			
		if(!$MAX_DISTANCE_RIDER || empty($MAX_DISTANCE_RIDER)){
			$MAX_DISTANCE_RIDER = 10000;
		}
			
		$MAX_DISTANCE_ORDER = (float) $MAX_DISTANCE_ORDER;
		$MAX_DISTANCE_RIDER = (float) $MAX_DISTANCE_RIDER;
		
		if($loggedInRiders){
			$data["error"] = false;
			$data["success_message"] = "Rider Found";
			$data["loggedInRiders"] = $loggedInRiders;
			
			//Get outlet postcode 
			if($outletType == 1){
				$outletPostalCode = $this->ClientModel->get_postal_code_by_id($outletID);
			}else if($outletType == 2){
				$outletPostalCode = $this->OutletModel->get_postal_code_by_id($outletID);
			}
			
			//Get outlet lat-lng 
			if($outletPostalCode){
				$outletLatLng = $this->get_outlet_lat_lng_by_postcode($outletPostalCode);
				$data['outletLatLng'] = $outletLatLng;
			}
			
			//Get nearest rider within km (max-distance-rider)
			if($outletLatLng){
				$nearestRiders = $this->get_all_nearest_rider_from_outlet($outletLatLng, $loggedInRiders);
			}
			
			if($nearestRiders){
				foreach($nearestRiders as $index => $nearestRider){
					$data['rider_id_'.$index] = $nearestRider->id;
					$data['rider_name_'.$index] = $nearestRider->name;
					$data['rider_lat_'.$index] = $nearestRider->latitude;
					$data['rider_lng_'.$index] = $nearestRider->longitude;
					$data['rider_gcm_reg_id_'.$index] = $nearestRider->device_reg_id;
				}
				
				$data["rider"] = true;
				$data["success_message"] = "Riders Available";
				$data["current_rider_index"] = 0;   //Send notification to first rider 
				$data['total_rider_index'] = count($nearestRiders);
				$data['notification_for'] = "rider";
				
				$data['MessageFromGCM'] = $this->send_notification_to_rider( array($data['rider_gcm_reg_id_0']), $data );
			}else{
				$data["rider"] = false;
				$data["error"] = true;
				$data["error_message"] = "No rider found within ".$MAX_DISTANCE_ORDER."km of outlet";
				
				echo json_encode($data);
				exit;
			}
			
			//$data['MessageFromGCM'] = $this->send_notification_to_rider( array($data['rider_gcm_reg_id_0']), $data );
			echo json_encode($data);
			exit;
		}else{
			$data["error"] = true;
			$data["error_message"] = "No Rider Found";
				
			echo json_encode($data);
			exit;
		}
	}
	
	//Get outlet latlng by postcode 
	public function get_outlet_lat_lng_by_postcode($postalCode){
		$base_url = 'https://maps.googleapis.com/maps/api/geocode/json?';
		$mode = 'driving';
		$units = 'imperial'; 
			
		$locationsUrl = $base_url."&address=".$postalCode."&sensor=false";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $locationsUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$latLntData = curl_exec($ch);
		curl_close($ch);
		$latLntData = json_decode($latLntData, TRUE);
		
		if(array_key_exists("results", $latLntData)){
			$data['lat'] = $latLntData['results'][0]['geometry']['location']['lat'];
			$data['lng'] = $latLntData['results'][0]['geometry']['location']['lng'];
			return $data;
		}else{
			return false;
		}
	}
	
	//Get all nearest rider 
	public function get_all_nearest_rider_from_outlet($outletLatLng, $loggedInRiders){
		$nearestRider = array();
		
		foreach($loggedInRiders as $loggedInRider){
			$distance = (float) $this->get_distance_between_rider_and_outlet($outletLatLng, $loggedInRider->latitude, $loggedInRider->longitude);
			
			$MAX_DISTANCE_ORDER = $this->OptionModel->get_option_by_key("max-distance-order");
			$MAX_DISTANCE_RIDER = $this->OptionModel->get_option_by_key("max-distance-rider");
			
			if(!$MAX_DISTANCE_ORDER || empty($MAX_DISTANCE_ORDER)){
				$MAX_DISTANCE_ORDER = 10000;
			}
			
			if(!$MAX_DISTANCE_RIDER || empty($MAX_DISTANCE_RIDER)){
				$MAX_DISTANCE_RIDER = 10000;
			}
			
			$MAX_DISTANCE_ORDER = (float) $MAX_DISTANCE_ORDER;
			$MAX_DISTANCE_RIDER = (float) $MAX_DISTANCE_RIDER;
			
			if($distance > 0 && $distance <= $MAX_DISTANCE_RIDER){
				$nearestRider[] = $loggedInRider;
			}
		}
		
		if( count($nearestRider) > 0 ){
			return $nearestRider;
		}else{
			return false;
		}
		
	}
	
	//Get distance between rider and outlet 
	public function get_distance_between_rider_and_outlet($outletLatLng, $latitude, $longitude){
		//$base_url = "http://maps.googleapis.com/maps/api/distancematrix/json?sensor=false";
		$base_url = "http://maps.googleapis.com/maps/api/directions/json?sensor=false";
		/** $origin = urlencode($outletLatLng['lat'].",".$outletLatLng['lng']);
		$destination = urlencode($latitude.",".$longitude); **/
		$mode = 'driving';
		$units = 'imperial'; 
			
		$locationsUrl = $base_url."&origin=".$outletLatLng['lat'].",".$outletLatLng['lng']."&destination=".$latitude.",".$longitude."&sensor=false&mode=".$mode."&units=".$units;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $locationsUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$distanceData = curl_exec($ch);
		curl_close($ch);
		$distanceData = json_decode($distanceData, TRUE); 
		
		//echo json_encode($distanceData); exit;
			
		
		if(array_key_exists("routes", $distanceData)){
			$distance = (float) $distanceData['routes'][0]['legs'][0]['distance']['text'];
			$distance = $distance*1.609;
			//return 100;
			return $distance;
		}else{
			return 10000;
		} 
		
		
	}
	
	//Register Rider Device to GCM 
	public function register_rider_device($riderId, $deviceRegId){
		$isRegistrered = $this->RiderModel->register_rider_device($riderId, $deviceRegId);
		if($isRegistrered){
			$data['error'] = false;
			$data['success_message'] = "Registration Success";
		}else{
			$data['error'] = true;
			$data['error_message'] = "Registration Failed";
		}
		
		echo json_encode($data);
		exit;
	}
	
	//Register Client  Device to GCM 
	public function register_client_device($clientId, $deviceRegId){
		$isRegistrered = $this->ClientModel->register_client_device($clientId, $deviceRegId);
		if($isRegistrered){
			$data['error'] = false;
			$data['success_message'] = "Registration Success";
		}else{
			$data['error'] = true;
			$data['error_message'] = "Registration Failed";
		}
		
		echo json_encode($data);
		exit;
	}
	
	
	//Send notification to rider 
	public function send_notification_to_rider($registatoin_ids, $message){
		// Set POST variables
		$apiKey = "AIzaSyAUIC4KNCbdJjtzUbyHptUgPhzwzeTo-vA";
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message
        );
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return false;
        }
 
        // Close connection
        curl_close($ch);
        return $result;

	}
	
	//Send notification to client 
	public function send_notification_to_client($registatoin_ids, $message){
		// Set POST variables
		$apiKey = "AIzaSyAUIC4KNCbdJjtzUbyHptUgPhzwzeTo-vA";
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message
        );
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return false;
        }
 
        // Close connection
        curl_close($ch);
        return $result;

	}
	
	
	//Send order to rider Testing  (Not Used)
	public function send_order_to_rider_2(){
		
		if(isset($_POST['postal_code'])){
			$data['json_data'] = $_POST['postal_code'];
			$data['error'] = false;
			$data['success_message'] = "Parameter found";
		}else{
			$data['error'] = true;
			$data['error_message'] = "No Post Data Found";
		}
		
		echo json_encode($data);
		exit;
	}	
	
	//Store order data and send notification to client  
	public function store_order_data_and_send_notification_to_client(){
		if($_POST['client_id']){
			$result = $this->OrderModel->store_order_data($_POST);
			
			if($result){
				$data['error'] = false;
				$data['success_message'] = "Parameter found";
				
				$client = $this->ClientModel->get_client_by_id((int) $_POST['client_id']);
				$rider = $this->RiderModel->get_rider_by_id((int) $_POST['rider_id']);				
				$data['rider_id'] = $rider->id;
				$data['rider_device_reg_id'] = $rider->device_reg_id;
				$data['rider_name'] = $rider->name;
				$data['rider_email'] = $rider->email;
				$data['rider_password'] = $rider->password;
				$data['rider_bike_number'] = $rider->bike_number;
				$data['rider_contact_number'] = $rider->contact_number;
				$data['rider_profile_picture'] = "http://dev.intaresta.com/smartsend/static/images/profile-pictures/".$rider->profile_picture;
				$data['rider_latitude'] = $rider->latitude;
				$data['rider_longitude'] = $rider->longitude;
				$data['rider_created_date'] = $rider->created_date;
				$data['rider_status'] = $rider->status;
				$data['notification_for'] = "client";
				
				$data['GCM_Message'] = $this->send_notification_to_client(array($client->device_reg_id), $data);
				
			}else{
				$data['error'] = true;
				$data['error_message'] = "Failed to store order data";
			}
		}else{
			$data['error'] = true;
			$data['error_message'] = "No Post Data Found";
		}
		
		echo json_encode($data);
		exit;
	}
	
	
	//Send notification to next rider 
	public function send_notification_to_next_rider(){
		//Post data from Android 
		$ClientID = $_POST['client_id'];
		$outletID = $_POST['outlet_id'];
		$outletName = $_POST['outlet_name'];
		$outletType = $_POST['outlet_type'];
		$pickupDateTime = $_POST['pickup_datetime'];
		$deliverDateTime = $_POST['deliver_datetime'];
		$mobileNumber = $_POST['mobile_number'];
		$customerName = $_POST['customer_name'];
		$postalCode = $_POST['postal_code'];
		$address = $_POST['address'];
		$unitNumberFirst = $_POST['unit_number_first'];
		$unitNumberLast = $_POST['unit_number_last'];
		$foodCost = $_POST['food_cost'];
		$receiptNumber = $_POST['receipt_number'];
		$currentRiderIndex = (int) $_POST['current_rider_index'];
		$totalRiderIndex = (int) $_POST['total_rider_index'];
		$currentRiderIndex = $currentRiderIndex + 1;
		
		//Bind the post data to data variable 
		$data['client_id'] = $ClientID;
		$data['outlet_id'] = $outletID;
		$data['outlet_name'] = $outletName;
		$data['outlet_type'] = $outletType;
		$data['pickup_datetime'] = $pickupDateTime;
		$data['deliver_datetime'] = $deliverDateTime;
		$data['mobile_number'] = $mobileNumber;
		$data['customer_name'] = $customerName;
		$data['postal_code'] = $postalCode;
		$data['address'] = $address;
		$data['unit_number_first'] = $unitNumberFirst;
		$data['unit_number_last'] = $unitNumberLast;
		$data['food_cost'] = $foodCost;
		$data['receipt_number'] = $receiptNumber;
		$data['current_rider_index'] = $currentRiderIndex;
		$data['total_rider_index'] = $totalRiderIndex;
		$data['notification_for'] = "rider";
		
		for($i=0; $i < $totalRiderIndex; $i++){
			$data["rider_id_".$i] = $_POST["rider_id_".$i];
			$data["rider_name_".$i] = $_POST["rider_name_".$i];
			$data["rider_lat_".$i] = $_POST["rider_lat_".$i];
			$data["rider_lng_".$i] = $_POST["rider_lng_".$i];
			$data["rider_gcm_reg_id_".$i] = $_POST["rider_gcm_reg_id_".$i];
		}
		
		$data['MessageFromGCM'] = $this->send_notification_to_rider( array($data["rider_gcm_reg_id_".$currentRiderIndex]), $data );
		
		if($data['MessageFromGCM'] == false){
			$data['error'] = true;
			$data['error_message'] = "Failed to send notification";
			
			echo json_encode($data);
			exit;
		}else{		
			$data['error'] = false;
			$data['success_message'] = "Notification sent to next rider";
			
			echo json_encode($data);
			exit;
		}
	} //End of Send notification to next rider 
	
	
	//Send failed notification to client 
	public function send_failed_notification_to_client(){
		if($_POST['client_id']){
			$data['error'] = false;
			$data['success_message'] = "Parameter found";
				
			$client = $this->ClientModel->get_client_by_id((int) $_POST['client_id']);			
			$data['message'] = "All rider are busy currently";
			$data['notification_for'] = "no_rider";
			
			$data['GCM_Message'] = $this->send_notification_to_client(array($client->device_reg_id), $data);
				
		}else{
			$data['error'] = true;
			$data['error_message'] = "No Post Data Found";
		}
		
		echo json_encode($data);
		exit;
	}
	
	
	//Get rider status 
	public function get_rider_status($riderId){
		if($riderId){
			$rider = $this->RiderModel->get_rider_by_id((int) $riderId);
			
			if($rider){
				$data['error'] = false;
				$data['success_message'] = "Rider status found";
				$data['rider_status'] = (int) $rider->status;
			}else{
				$data['error'] = true;
				$data['error_message'] = "No rider status found";
			}
		}else{
			$data['error'] = true;
			$data['error_message'] = "No rider status found";
		}
		
		echo json_encode($data);
		exit;
	}
	
	
	//Set rider status 
	public function set_rider_status($riderId, $status){
		if($riderId){
			$result = $this->RiderModel->set_rider_status_by_id((int) $riderId, (int) $status);
			
			if($result){
				$data['error'] = false;
				$data['success_message'] = "Rider status changed";
			}else{
				$data['error'] = true;
				$data['error_message'] = "Failed to changed rider status";
			}
		}else{
			$data['error'] = true;
			$data['error_message'] = "No rider status found";
		}
		
		echo json_encode($data);
		exit;
	}
	
	
}//End of COntroller 