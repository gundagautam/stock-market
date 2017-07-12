$(document).ready(function() {
	$("#second").hide();
	
	$("#email").after("<span id='emailnotif'></span>");
	$("#emailnotif").hide();
	
	$("#emailID").after("<span id='emailIDnotif'></span>");
	$("#emailIDnotif").hide();
	
	$("#password").after("<span id='passnotif'></span>");
	$("#passnotif").hide();
	
	$("#confirmPass").after("<span id='confpassnotif'></span>");
	$("#confpassnotif").hide();
	
	$("#fname").after("<span id='fnamenotif'></span>");
	$("#fnamenotif").hide();
	
	$("#lname").after("<span id='lnamenotif'></span>");
	$("#lnamenotif").hide();
	
	$("#add").after("<span id='addnotif'></span>");
	$("#addnotif").hide();
	
	$("#city").after("<span id='citynotif'></span>");
	$("#citynotif").hide();
	
	$("#county").after("<span id='countynotif'></span>");
	$("#countynotif").hide();
	
	$("#state").after("<span id='statenotif'></span>");
	$("#statenotif").hide();
	
	$("#country").after("<span id='countrynotif'></span>");
	$("#countrynotif").hide();
	
	$("#postal").after("<span id='postalnotif'></span>");
	$("#postalnotif").hide();
	
	$("#phone").after("<span id='phonenotif'></span>");
	$("#phonenotif").hide();
	
	$("#confirmPass").focus(function(){
		$("#confpassnotif").html(" Please retype your password");
		$("#confpassnotif").removeClass();
		$("#confpassnotif").addClass("info");
		$("#confpassnotif").show();
	});
	$("#confirmPass").blur(function(){
		var confPass=$(this).val();
		var origPass=$("#password").val();
		console.log("Value : "+confPass+"orig = "+origPass);
		if(confPass==origPass){
			$("#confpassnotif").hide();
			$("#confpassnotif").html("OK");
			$("#confpassnotif").removeClass();
			$("#confpassnotif").addClass("ok");
			$("#confpassnotif").show();
			$("#second").show();
		}else {
			$("#confpassnotif").html("Error");
			$("#confpassnotif").removeClass();
			$("#confpassnotif").addClass("error");
			$("#confpassnotif").show();
		}
    }); 
	$("#password").focus(function(){
		$("#passnotif").html(" The password field should be at least 9 characters long");
		$("#passnotif").removeClass();
		$("#passnotif").addClass("info");
		$("#passnotif").show();
	});
	$("#password").blur(function(){
		var pass=$(this).val();
		console.log("Value : "+pass);
		if(pass.length == 0){
			$("#passnotif").hide();
		} else if(pass.length<9){
			$("#passnotif").html(" Password length is less than 9");
			$("#passnotif").removeClass();
			$("#passnotif").addClass("error");
			$("#passnotif").show();
		}else if(pass.length>=9){
			$("#passnotif").html("OK");
			$("#passnotif").removeClass();
			$("#passnotif").addClass("ok");
			$("#passnotif").show();
		}
    }); 
	
	$("#email").focus(function(){
		$("#emailnotif").html(" The email should be a valid email address eg. someone@somewhere.com");
		$("#emailnotif").removeClass();
		$("#emailnotif").addClass("info");
		$("#emailnotif").show();
	});
	$("#email").blur(function(){
		var email=$(this).val();
		console.log("Value : "+email);
		if(email==""){
			$("#emailnotif").hide();
		}else if(!email.match(/[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/)){
			$("#emailnotif").html("Error");
			$("#emailnotif").removeClass();
			$("#emailnotif").addClass("error");
			$("#emailnotif").show();
		}
		else if(email.match(/[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/)){
			$("#emailnotif").html("OK");
			$("#emailnotif").removeClass();
			$("#emailnotif").addClass("ok");
			$("#emailnotif").show();
			
		}
    }); 
	
	$("#emailID").blur(function(){
		var emailID=$(this).val();
		console.log("Value : "+emailID);
		$.post('./checklogin.php', 'value='+emailID,function(data) {
			console.log(data);
			$("#emailIDnotif").html(data);
			$("#emailIDnotif").removeClass();
			$("#emailIDnotif").addClass("error");
			$("#emailIDnotif").show();
		});
	});
	
	$("#fname").focus(function(){
		$("#fnamenotif").html(" Should contain only Alphabets");
		$("#fnamenotif").removeClass();
		$("#fnamenotif").addClass("info");
		$("#fnamenotif").show();
	});
	$("#fname").blur(function(){
		var fname=$(this).val();
		console.log("Value : "+fname);
		if(fname==""){
			$("#fnamenotif").hide();
		}else if(!fname.match(/[a-zA-Z]+$/)){
			$("#fnamenotif").html(" Firstname cannot have anything other than alphabets or be empty");
			$("#fnamenotif").removeClass();
			$("#fnamenotif").addClass("error");
			$("#fnamenotif").show();
		}
		else{
			$("#fnamenotif").html("OK");
			$("#fnamenotif").removeClass();
			$("#fnamenotif").addClass("ok");
			$("#fnamenotif").show();
			
		}
    }); 
	
	$("#lname").focus(function(){
		$("#lnamenotif").html(" Should contain only Alphabets");
		$("#lnamenotif").removeClass();
		$("#lnamenotif").addClass("info");
		$("#lnamenotif").show();
	});
	$("#lname").blur(function(){
		var lname=$(this).val();
		console.log("Value : "+lname);
		if(lname==""){
			$("#lnamenotif").hide();
		}else if(!lname.match(/[a-zA-Z]+$/)){
			$("#lnamenotif").html(" Last name cannot have anything other than alphabets or be empty");
			$("#lnamenotif").removeClass();
			$("#lnamenotif").addClass("error");
			$("#lnamenotif").show();
		}
		else{
			$("#lnamenotif").html("OK");
			$("#lnamenotif").removeClass();
			$("#lnamenotif").addClass("ok");
			$("#lnamenotif").show();
			
		}
    }); 
	
	$("#add").focus(function(){
		$("#addnotif").html(" Please enter a valid address");
		$("#addnotif").removeClass();
		$("#addnotif").addClass("info");
		$("#addnotif").show();
	});
	$("#add").blur(function(){
		var add=$(this).val();
		console.log("Value : "+add);
		if(add==""){
			$("#addnotif").hide();
		}else if(!add.match(/[a-zA-Z0-9]+$/)){
			$("#addnotif").html(" Address is invalid please check the rules again");
			$("#addnotif").removeClass();
			$("#addnotif").addClass("error");
			$("#addnotif").show();
		}
		else{
			$("#addnotif").html("OK");
			$("#addnotif").removeClass();
			$("#addnotif").addClass("ok");
			$("#addnotif").show();
			
		}
    });
	
	$("#city").focus(function(){
		$("#citynotif").html(" Please enter a valid city name");
		$("#citynotif").removeClass();
		$("#citynotif").addClass("info");
		$("#citynotif").show();
	});
	$("#city").blur(function(){
		var city=$(this).val();
		console.log("Value : "+city);
		if(city==""){
			$("#citynotif").hide();
		}else if(!city.match(/[a-zA-Z]+$/)){
			$("#citynotif").html(" city is invalid");
			$("#citynotif").removeClass();
			$("#citynotif").addClass("error");
			$("#citynotif").show();
		}
		else{
			$("#citynotif").html("OK");
			$("#citynotif").removeClass();
			$("#citynotif").addClass("ok");
			$("#citynotif").show();
			
		}
    });
	
	$("#county").focus(function(){
		$("#countynotif").html(" Please enter a valid county name");
		$("#countynotif").removeClass();
		$("#countynotif").addClass("info");
		$("#countynotif").show();
	});
	$("#county").blur(function(){
		var county=$(this).val();
		console.log("Value : "+county);
		if(county==""){
			$("#countynotif").hide();
		}else if(!county.match(/[a-zA-Z]+$/)){
			$("#countynotif").html(" county is invalid");
			$("#countynotif").removeClass();
			$("#countynotif").addClass("error");
			$("#countynotif").show();
		}
		else{
			$("#countynotif").html("OK");
			$("#countynotif").removeClass();
			$("#countynotif").addClass("ok");
			$("#countynotif").show();
			
		}
    });
	
	$("#state").focus(function(){
		$("#statenotif").html(" Please enter a valid state name (only 2 chars)");
		$("#statenotif").removeClass();
		$("#statenotif").addClass("info");
		$("#statenotif").show();
	});
	$("#state").blur(function(){
		var state=$(this).val();
		console.log("Value : "+state.lenght);
		if(state==""){
			$("#statenotif").hide();
		}else if(!state.match(/[a-zA-Z]+$/) || state.length!=2){
			$("#statenotif").html(" State is invalid");
			$("#statenotif").removeClass();
			$("#statenotif").addClass("error");
			$("#statenotif").show();
		}
		else{
			$("#statenotif").html("OK");
			$("#statenotif").removeClass();
			$("#statenotif").addClass("ok");
			$("#statenotif").show();
			
		}
    });
	
	$("#country").focus(function(){
		$("#countrynotif").html(" Please enter a valid country name");
		$("#countrynotif").removeClass();
		$("#countrynotif").addClass("info");
		$("#countrynotif").show();
	});
	$("#country").blur(function(){
		var country=$(this).val();
		console.log("Value : "+country);
		if(country==""){
			$("#countrynotif").hide();
		}else if(!country.match(/[a-zA-Z]+$/)){
			$("#countrynotif").html(" country is invalid");
			$("#countrynotif").removeClass();
			$("#countrynotif").addClass("error");
			$("#countrynotif").show();
		}
		else{
			$("#countrynotif").html("OK");
			$("#countrynotif").removeClass();
			$("#countrynotif").addClass("ok");
			$("#countrynotif").show();
			
		}
    });
	
	$("#postal").focus(function(){
		$("#postalnotif").html(" Zip should be only numeric and lenght should be 5s");
		$("#postalnotif").removeClass();
		$("#postalnotif").addClass("info");
		$("#postalnotif").show();
	});
	$("#postal").blur(function(){
		var postal=$(this).val();
		console.log("Value : "+postal.length);
		if(postal==""){
			$("#postalnotif").hide();
		}else if(!postal.match(/[0-9]+$/) || postal.length!=5){
			$("#postalnotif").html(" postal is invalid");
			$("#postalnotif").removeClass();
			$("#postalnotif").addClass("error");
			$("#postalnotif").show();
		}
		else{
			$("#postalnotif").html("OK");
			$("#postalnotif").removeClass();
			$("#postalnotif").addClass("ok");
			$("#postalnotif").show();
			
		}
    });
	
	$("#phone").focus(function(){
		$("#phonenotif").html(" Phone should be only numeric and in format 999-999-9999");
		$("#phonenotif").removeClass();
		$("#phonenotif").addClass("info");
		$("#phonenotif").show();
	});
	$("#phone").blur(function(){
		var phone=$(this).val();
		console.log("Value : "+phone);
		patt1 = /[0-9]{3}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/;
		
		if(phone==""){
			$("#phonenotif").hide();
		}else if(!phone.match(patt1)){
			$("#phonenotif").html(" phone is invalid please check rules");
			$("#phonenotif").removeClass();
			$("#phonenotif").addClass("error");
			$("#phonenotif").show();
		}
		else{
			$("#phonenotif").html("OK");
			$("#phonenotif").removeClass();
			$("#phonenotif").addClass("ok");
			$("#phonenotif").show();
			
		}
    });
});
