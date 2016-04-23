//Custom JS
var baseUrl;
$(document).ready(function(){
	baseUrl = $('#ss-base-url').val().trim();
	
	//FOr Client 
	//Client Billing Address for Client 
	$('#client-postal-code').keyup(function(){
		var postalCode = $('#client-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCode(postalCode);
		}else{
			$('#client-company-location').val('');
		}
	});
	
	//After entering unite number  for Client 
	$('#client-unite-number').keyup(function(){
		var postalCode = $('#client-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCode(postalCode);
		}else{
			$('#client-company-location').val('');
		}
	});
	
	//Contact person address for Client 
	$('#client-cp-postal-code').keyup(function(){
		var postalCode = $('#client-cp-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCodeForContact(postalCode);
		}else{
			$('#client-cp-address').val('');
		}
	});
	
	//After entering unite number of contact person  
	$('#client-cp-unite-number').keyup(function(){
		var postalCode = $('#client-cp-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCodeForContact(postalCode);
		}else{
			$('#client-cp-address').val('');
		}
	});
	
	
	//For Outlet 
	//Outlet  Billing Address for Outlet 
	$('#outlet-postal-code').keyup(function(){
		var postalCode = $('#outlet-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCodeOutlet(postalCode);
		}else{
			$('#outlet-location').val('');
		}
	});
	
	//After entering unite number  for Outlet 
	$('#outlet-unite-number').keyup(function(){
		var postalCode = $('#outlet-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCodeOutlet(postalCode);
		}else{
			$('#outlet-location').val('');
		}
	});
	
	//Outlet Location  
	$('#outlet-cp-postal-code').keyup(function(){
		var postalCode = $('#outlet-cp-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCodeForContactOutlet(postalCode);
		}else{
			$('#outlet-cp-address').val('');
		}
	});
	
	//After entering unite number of contact person of outlet 
	$('#outlet-cp-unite-number').keyup(function(){
		var postalCode = $('#outlet-cp-postal-code').val().trim();
		
		if(postalCode.length >= 6){
			getAddressByPostalCodeForContactOutlet(postalCode);
		}else{
			$('#outlet-cp-address').val('');
		}
	});
	
});


//Ajax FOr CLient 
//Ajax for getting address by postal code for Client 
function getAddressByPostalCode(postalCode){
	$.ajax({
	  method: "POST",
	  data: {postalCode:postalCode},
	  url: baseUrl+"singpost/get_address_by_postal_code"
	})
	  .done(function( result ) {
		//alert( "Data : " + result );
		result = $.parseJSON(result);
		if(result){
			var unitNumber = $('#client-unite-number').val().trim(); 
			unitNumber.replace('#', ' ');
			var address = result.zip_bulding_no+' ';
			
			if(result.zip_bulding_name){
				address = address + '('+result.zip_bulding_name+')';
			}
			
			address = address + ', ';
			address = address + result.zip_street_name + ', ';
			
			if(unitNumber){
				address = address + '#' + unitNumber + ', ';
			}
			
			address = address + 'Singapore-' + result.zip_code;
			$('#form-error').empty();
			$('#client-company-location').val(address);
			//return address;
		}else{
			//alert('Please enter a valid postal code');
			$('#form-error').text('Invald postal Code');
			//return 0;
		}
		
	  });
}

//Ajax for getting address by postal code of Contact person for Client 
function getAddressByPostalCodeForContact(postalCode){
	$.ajax({
	  method: "POST",
	  data: {postalCode:postalCode},
	  url: baseUrl+"singpost/get_address_by_postal_code"
	})
	  .done(function( result ) {
		//alert( "Data : " + result );
		result = $.parseJSON(result);
		if(result){
			var unitNumber = $('#client-cp-unite-number').val().trim(); 
			unitNumber.replace('#', ' ');
			var address = result.zip_bulding_no+' ';
			
			if(result.zip_bulding_name){
				address = address + '('+result.zip_bulding_name+')';
			}
			
			address = address + ', ';
			address = address + result.zip_street_name + ', ';
			
			if(unitNumber){
				address = address + '#' + unitNumber + ', ';
			}
			
			address = address + 'Singapore-' + result.zip_code;
			$('#form-error-cp').empty();
			$('#client-cp-address').val(address);
			//return address;
		}else{
			alert('Please enter a valid postal code');
			$('#form-error-cp').empty();
			$('#form-error-cp').text('Invald postal Code');
			//return 0;
		}
		
	  });
}


//AJax For Outlet 
//Ajax for getting address by postal code for Outlet
function getAddressByPostalCodeOutlet(postalCode){
	$.ajax({
	  method: "POST",
	  data: {postalCode:postalCode},
	  url: baseUrl+"singpost/get_address_by_postal_code"
	})
	  .done(function( result ) {
		//alert( "Data : " + result );
		result = $.parseJSON(result);
		if(result){
			var unitNumber = $('#outlet-unite-number').val().trim(); 
			unitNumber.replace('#', ' ');
			var address = result.zip_bulding_no+' ';
			
			if(result.zip_bulding_name){
				address = address + '('+result.zip_bulding_name+')';
			}
			
			address = address + ', ';
			address = address + result.zip_street_name + ', ';
			
			if(unitNumber){
				address = address + '#' + unitNumber + ', ';
			}
			
			address = address + 'Singapore-' + result.zip_code;
			$('#form-error').empty();
			$('#outlet-location').val(address);
			//return address;
		}else{
			//alert('Please enter a valid postal code');
			$('#form-error').text('Invald postal Code');
			//return 0;
		}
		
	  });
}

//Ajax for getting address by postal code of Contact person  for Outlet 
function getAddressByPostalCodeForContactOutlet(postalCode){
	$.ajax({
	  method: "POST",
	  data: {postalCode:postalCode},
	  url: baseUrl+"singpost/get_address_by_postal_code"
	})
	  .done(function( result ) {
		//alert( "Data : " + result );
		result = $.parseJSON(result);
		if(result){
			var unitNumber = $('#outlet-cp-unite-number').val().trim(); 
			unitNumber.replace('#', ' ');
			var address = result.zip_bulding_no+' ';
			
			if(result.zip_bulding_name){
				address = address + '('+result.zip_bulding_name+')';
			}
			
			address = address + ', ';
			address = address + result.zip_street_name + ', ';
			
			if(unitNumber){
				address = address + '#' + unitNumber + ', ';
			}
			
			address = address + 'Singapore-' + result.zip_code;
			$('#form-error-cp').empty();
			$('#outlet-cp-address').val(address);
			//return address;
		}else{
			alert('Please enter a valid postal code');
			$('#form-error-cp').empty();
			$('#form-error-cp').text('Invald postal Code');
			//return 0;
		}
		
	  });
}


//For Client 
function checkClientFormBeforeSubmit(element){
	if($("input[name='clients[]']:checked").length == 0){
			alert('No item selected'); 
			return false;
		} else{
			if($('#filter-form-client').val() == 1 || $('#filter-form-client-down').val() == 1 ){
				$('#form-client').submit();
			}else if( $('#filter-form-client').val() == 2 || $('#filter-form-client-down').val() == 2 ){
				$('#form-client').submit();
			}else{
				$('#form-client').attr('action','');
			}
		}
}

//For client restaurant 
function checkClientRestaurantFormBeforeSubmit(element){
	if($("input[name='restaurants[]']:checked").length == 0){
			alert('No item selected'); 
			return false;
		} else{
			if($('#filter-form-client-restaurant').val() == 1 || $('#filter-form-client-restaurant-down').val() == 1){
				$('#form-client-restaurant').submit();
			}else if($('#filter-form-client-restaurant').val() == 2 || $('#filter-form-client-restaurant-down').val() == 2){
				$('#form-client-restaurant').submit();
			}else{
				$('#form-client-restaurant').attr('action','');
			}
		}
	
}

//For client company 
function checkClientCompanyFormBeforeSubmit(element){
	if($("input[name='company[]']:checked").length == 0){
			alert('No item selected'); 
			return false;
		} else{
			if($('#filter-form-client-company').val() == 1 || $('#filter-form-client-company-down').val() == 1){
				$('#form-client-company').submit();
			}else if($('#filter-form-client-company').val() == 2 || $('#filter-form-client-company-down').val() == 2){
				$('#form-client-company').submit();
			}else{
				$('#form-client-comapny').attr('action','');
			}
		}
	
}

//FOr Rider 
function checkRiderFormBeforeSubmit(element){
	if($("input[name='riders[]']:checked").length == 0){
			alert('No item selected'); 
			return false;
		} else{
			if($('#filter-form-rider').val() == 1 || $('#filter-form-rider-down').val() == 1 ){
				$('#form-rider').submit();
			}else if( $('#filter-form-rider').val() == 2 || $('#filter-form-rider-down').val() == 2 ){
				$('#form-rider').submit();
			}else{
				$('#form-rider').attr('action','');
			}
		}
}

//FOr Outlet  
function checkOutletFormBeforeSubmit(element){
	if($("input[name='outlets[]']:checked").length == 0){
			alert('No item selected'); 
			return false;
		} else{
			if($('#filter-form-outlet').val() == 1 || $('#filter-form-outlet-down').val() == 1 ){
				$('#form-outlet').submit();
			}else if( $('#filter-form-outlet').val() == 2 || $('#filter-form-outlet-down').val() == 2 ){
				$('#form-outlet').submit();
			}else{
				$('#form-outlet').attr('action','');
			}
		}
}

//FOr Order   
function checkOrderFormBeforeSubmit(element){
	if($("input[name='orders[]']:checked").length == 0){
			alert('No item selected'); 
			return false;
		} else{
			if($('#filter-form-order').val() == 1 || $('#filter-form-order-down').val() == 1 ){
				$('#form-order').submit();
			}else if( $('#filter-form-order').val() == 2 || $('#filter-form-order-down').val() == 2 ){
				$('#form-order').submit();
			}else{
				$('#form-order').attr('action','');
			}
		}
}