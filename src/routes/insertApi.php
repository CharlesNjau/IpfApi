<?php
/* 
This is route class was written to contain all the API post request

*/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;




$app->post('/login/add', function (Request $require,Response $response) {
    $email=$require->getParam('email');
    $password=$require->getParam('password');
   
   
    $Message= array(
        'Success' =>'Data Recorded successfully!',
        'Status'=>'201',
        'CompanyDetail'=>array
        ('email'=>$email,
         'password'=>$password,
        )
   );

return json_encode($Message);

});

$app->post('/insertApiEmployeeDetail/add', function (Request $require,Response $response) {
    $first_name=$require->getParam('first_name');
    $middle_name=$require->getParam('middle_name');
    $last_name=$require->getParam('last_name');
    $income=$require->getParam('income');
    $department=$require->getParam('department');
    $position=$require->getParam('position');
   
    $Message= array(
        'Success' =>'Data Recorded successfully!',
        'Status'=>'201',
        'CompanyDetail'=>array
        ('first_name'=>$first_name,
         'middle_name'=>$middle_name,
         'last_name'=>$last_name,
         'income'=>$income,
         'department'=>$department,
         'position'=>$position
        )
   );

return json_encode($Message);

});

//INSERt CUSTOMER DETAIL
$app->post('/insertApi/add',function(Request $request,Response $response){
	//echo "Emails by full name ROUTE WORKING"."<br>";
 //Escape mysqli string   
$first_name=$request->getParam('first_name');
$last_name=$request->getParam('last_name');
$company_bio=$request->getParam('company_bio');
$web_site=$request->getParam('web_site');
$title=$request->getParam('title');


//API POST VALIDATION
if($first_name===""){

$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"first_name is empty",'Status'=>'400','Status message'=>'Bad Request'));
return json_encode($Message);
}
else if($last_name===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"last_name is empty",'Status'=>'400','Status message'=>'Bad Request'));
return json_encode($Message);   

}
else if($company_bio===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"last_name is empty",'Status'=>'400','Status message'=>'Bad Request'));
return json_encode($Message);   

}
else if($web_site===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"phone number is empty",'Status'=>'400','Status message'=>'Bad Request'));
return json_encode($Message);  

}
else if($title===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"email field is empty",'Status'=>'400','Status message'=>'Bad Request'));
return json_encode($Message);  

}
else{

	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "ipf_db";
	
	// Create connection for offline version
	
	$conn = new mysqli($servername, $username, $password, $dbname);
 
   $sql= "INSERT INTO  comapny_data (first_name,last_name,company_bio,web_site,title) VALUES('$first_name','$last_name','$company_bio','$web_site','$title') ";
    if (mysqli_query($conn, $sql)) {

		    $Message= array(
							 	'Success' =>'Data Inserted successfully!',
							 	'Status'=>'201',
							 	'CompanyDetail'=>array
							 	('first_name'=>$first_name,
							 	 'last_name'=>$last_name,
							 	 'company_bio'=>$company_bio,
							 	 'website'=>$web_site,
							 	 'title'=>$title
							 	)
		    				);
		 
		 return json_encode($Message);
       } 
       else
        {
	        $data=array(
	    	'Error' => 'Bad request',
	        'Status'=>'400'
	    );
	        
	        return json_encode($data);
    	}
   
   

}

}); 
