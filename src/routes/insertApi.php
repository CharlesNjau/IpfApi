<?php
/* 
This is route class was written to contain all the API post request

*/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;





$app->post('/login/add', function (Request $require,Response $response) {
    $email=$require->getParam('email');
    $first_name=$require->getParam('first_name');
    $middle_name=$require->getParam('middle_name');
    $last_name=$require->getParam('last_name');
    $income=$require->getParam('income');
    $department=$require->getParam('department');
    $position=$require->getParam('position');

    if(ctype_alpha($first_name)!=true || $first_name===" "){//first_name
        $valdation_error=array('status'=>'400','first name'=>'Not a valid name text or empty');

        echo json_encode($valdation_error);
    }
    else if(ctype_alpha($middle_name)!=true || $middle_name===" "){
        $valdation_error=array('status'=>'400','middle name'=>'Not a valid name text or empty');

        echo json_encode($valdation_error);

    }
    else if(ctype_alpha($last_name)!=true || $last_name===" "){
        $valdation_error=array('status'=>'400','last name'=>'Not a valid name text or empty');

        echo json_encode($valdation_error);
        
    }
    else if(ctype_digit($income)!=true || $income===" "){
        $valdation_error=array('status'=>'400','income'=>'Not a valid name integer or empty');

        echo json_encode($valdation_error);
        
    }
    else if(ctype_alpha($department)!=true || $department===" "){
        $valdation_error=array('status'=>'400','deprtment'=>'Not a valid text or empty');

        echo json_encode($valdation_error);
    }
    else if(ctype_alpha($position)!=true || $position===" "){
        $valdation_error=array('status'=>'400','position'=>'Not a valid text or empty');
        echo json_encode($valdation_error); 
        
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)|| $email===" "){
        $valdation_error=array('status'=>'400','email'=>'Not a valid text or empty');
        echo json_encode($valdation_error); 
        
    }
    else{
        $Message= array(
            'Success' =>'Data Recorded successfully!',
            'Status'=>'201',
            'CompanyDetail'=>array
            ('email'=>$email,
             'first_name'=>$first_name,
             'middle_name'=>$middle_name,
             'last_name'=>$last_name,
             'income'=>$income,
             'department'=>$department,
             'position'=>$position

            )
       );
    
    return json_encode($Message);
    }

   
    

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
if(ctype_alpha($first_name)!=true || $first_name===" "){//first_name
    $valdation_error=array('status'=>'400','first name'=>'Not a valid name text or empty');

    echo json_encode($valdation_error);
}
else if(ctype_alpha($last_name)!=true || $last_name===" "){
    $valdation_error=array('status'=>'400','last name'=>'Not a valid name text or empty');

    echo json_encode($valdation_error);
    
}
else if(ctype_alpha($company_bio)!=true || $company_bio===" "){
    $valdation_error=array('status'=>'400','middle name'=>'Not a valid name text or empty or has an extra space');

    echo json_encode($valdation_error);

}
else if(ctype_alpha($title)!=true || $title===" "){
    $valdation_error=array('status'=>'400','title name'=>'Not a valid title text or empty');

    echo json_encode($valdation_error);

}
else if(!filter_var($web_site, FILTER_VALIDATE_DOMAIN)|| $web_site===" "){
    $valdation_error=array('status'=>'400','email'=>'Not a valid text or empty');
    echo json_encode($valdation_error); 
    
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
