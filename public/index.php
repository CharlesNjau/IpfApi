<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//require '../src/config/db.php';




//Get All Company Bios 
$app = new \Slim\App;


$app->get('/fetchApi/CompanyBios',function(Request $require,Response $response){
//echo "COMPANY BIOS ROUTE WRKING";
//Create object*/
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "ipf_db";
// Create connection for offline version
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo"Connection Succesfull";
}

$sql= "SELECT company_bio FROM comapny_data ";
$result = mysqli_query($conn, $sql);


// Fetch all
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
$output=array('List of company bio'=>$data);
echo json_encode($output);
mysqli_close($conn);

 }); 

//Get Company Bio  By Name
$app->get('/fetchApi/CompanyBiosByName/{web_site}',function(Request $require,Response $response){
$web_site=$require->getAttribute('web_site');
//echo "COMPANY BIOS BY NAME ROUTE WORKING ".$website."<br>";
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "ipf_db";
// Create connection for offline version
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo"Connection Succesfull";
}

$sql= "SELECT company_bio FROM comapny_data WHERE web_site='www.youtube.com' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $company_bio=$row["company_bio"];
        $data=array('company_bio'=>$company_bio);

        echo json_encode($data);

    }
} else {
    $data=array('Error' => '500');
    echo json_encode($data);
}

mysqli_close($conn);
});

//GET Company titles
$app->get('/fetchApi/Titles',function(Request $require,Response $response){
    echo "TITLE ROUTE WORKING";
     return $response;


}); 

//GET TITLE BY FIRST & LAST NAME
$app->get('/fetchApi/TitlesByName/first-name/{FirstName}/last-name/{LastName}',function(Request $require,Response $response){

$FirstName=$require->getAttribute('FirstName');
//$MiddleName=$require->getAttribute('MiddleName');
$LastName=$require->getAttribute('LastName');

echo "TITLE ROUTE BY FULL NAME WRKING"."<br>";
echo "fetch title by name";
echo "full name ".$FirstName." ".$LastName;

 return $response;

}); 

//GET ALL ALL EMAIL
$app->get('/fetchApi/Emails',function(Request $require,Response $response){
    echo "Emails ROUTE WORKING";
     return $response;

}); 

//GET EMAILS BY FIRST LAST NAME
$app->get('/fetchApi/EmailsByName/FirstName/{FirstName}/LastName/{LastName}',function(Request $require,Response $response){


echo "Emails by full name ROUTE WORKING"."<br>";
$FirstName=$require->getAttribute('FirstName');
$LastName=$require->getAttribute('LastName');
echo "full name ".$FirstName."@ ".$LastName;
 return $response;

});


//Insert


//INSERt CUSTOMER DETAIL
$app->post('/insertApi/add',function(Request $request,Response $response){
	//echo "Emails by full name ROUTE WORKING"."<br>";
 //Escape mysqli string   
$first_name=$request->getParam('first_name');
$last_name=$request->getParam('last_name');
$Company_bio=$request->getParam('Company_bio');
$web_site=$request->getParam('web_site');
$title=$request->getParam('title');




//API POST VALIDATION
if($first_name===""){

$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"first_name is empty",'Status'=>'400','Status message'=>'Bad Request'));
echo json_encode($Message);
}
else if($last_name===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"last_name is empty",'Status'=>'400','Status message'=>'Bad Request'));
echo json_encode($Message);   

}
else if($Company_bio===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"last_name is empty",'Status'=>'400','Status message'=>'Bad Request'));
echo json_encode($Message);   

}
else if($website===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"phone number is empty",'Status'=>'400','Status message'=>'Bad Request'));
echo json_encode($Message);  

}
else if($title===""){
$Message= array('Error'=>'Post Validation Data Error','Error Report'=>array('Server error Meassge'=>"email field is empty",'Status'=>'400','Status message'=>'Bad Request'));
echo json_encode($Message);  

}
else{
   
   $sql    = "INSERT INTO  comapny_data (first_name,last_name,company_bio,web_site,title) VALUES('$first_name','$last_name','$company_bio','$web_site','$title') ";
    $result = mysqli_query($conn, $sql);
       if ($conn->query($sql) === TRUE) {

              $Message= array('Success' =>'Data entered successfully!','Status'=>'201','CompanyDetail'=>array('first_name'=>$first_name,'last_name'=>$last_name,'website'=>$web_site,'Title'=>$title));
                 echo json_encode($Message); 
        
        $conn->close();
       } 
       else {
        $result = array(
            'Error' => $conn->error
        );
        
        echo json_encode($result);
        $conn->close();
    }
   
   

}

}); 




$app->run();