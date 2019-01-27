<?php
/*
Architechture modular 
This is APi was writen to accept user from a form
the inputs are as follow's.
 1.first_name
 2.last_name
 3.company_bio
 4.web_site
 5.title

The end point for perfoming POST request is as shown below

URL End point: http://ipf/insertApi/add

Structure used send form 

Form URL Encoded

Sample of Succesfull post request i.e

{
  "Success": "Data Inserted successfully!",
  "Status": "201",
  "CompanyDetail": {
    "first_name": "Andrew",
    "last_name": "Kapinga",
    "company_bio": "Atlas Telecom ",
    "website": "www.AtlTelco.com",
    "title": "Network Engineer"
  }
}

Sample of an unsuccesfull post request i.e

{
	    	'Error':'Bad request',
	        'Status':'400'	   
}

The end point for perfoming GET request is as shown below

URL End point: http://ipf/fetchApi/CompanyBios

Sample of an unsuccesfull post request i.e

{
  "List of company bios": [
    {
      "company_bio": "Safari LTD "
    },
    {
      "company_bio": "Safari LTD "
    },
    {
      "company_bio": "Safari LTD "
    },
    {
      "company_bio": "Azam"
    },
    {
      "company_bio": "Azam"
    },
    {
      "company_bio": "Atlas Telecom "
    },
    {
      "company_bio": "Atlas Telecom "
    },
    {
      "company_bio": "Atlas Telecom "
    },
    {
      "company_bio": "A Telecom "
    }
  ]
}

URL End point: http://ipf/fetchApi/CompanyBiosByName/{web_site}

{
  "company_bio": "Safari LTD "
}

URL End point: http://ipf/fetchApi/AllGetNameAndTitles

[
  {
    "title": "Auditor",
    "first_name": "Dawson",
    "last_name": "Nyambo"
  },
  {
    "title": "Auditor",
    "first_name": "Alex",
    "last_name": "Nyambo"
  },
  {
    "title": "Human Resource",
    "first_name": "Jackson",
    "last_name": "Kaniki"
  },
  {
    "title": "Operational Manger",
    "first_name": "Khalidi",
    "last_name": "Albani"
  },
  {
    "title": "Operational Manger",
    "first_name": "Saad",
    "last_name": "Al turky"
  },
  {
    "title": "Network Engineer",
    "first_name": "Andrew",
    "last_name": "Kapinga"
  },
  {
    "title": "Network Engineer",
    "first_name": "Andrew",
    "last_name": "Kapinga"
  },
  {
    "title": "Network Engineer",
    "first_name": "Andrew",
    "last_name": "Kapinga"
  },
  {
    "title": "Network Engineer",
    "first_name": "Andrewl",
    "last_name": "Kapingad"
  }
]

URL End point: http://ipf/fetchApi/GetNameAndTitlesByCompnayBio/{company_bio}

{
  "title": "Operational Manger",
  "first_name": "Khalidi",
  "last_name": "Albani"
}

URL End point: http://ipf/fetchApi/web_sites'

{
  "List of websites": [
    {
      "web_site": "www.tra.co.tz"
    },
    {
      "web_site": "www.tra.co.tz"
    },
    {
      "web_site": "www.tra.co.tz"
    },
    {
      "web_site": "www.azam-group.co.tz"
    },
    {
      "web_site": "www.azam-group.co.tz"
    },
    {
      "web_site": "www.AtlTelco.com"
    },
    {
      "web_site": "www.AtlTelco.com"
    },
    {
      "web_site": "www.AtlTelco.com"
    },
    {
      "web_site": "www.AtlTel.com"
    }
  ]
}

URL End point: http://ipf/fetchApi/web_sitesBycompany_bio/{company_bio}

{
  "web_site": "www.azam-group.co.tz"
}

Sample of an unsuccesfull post request i.e

{
	    	'Error':'Bad request',
	        'Status':'400'	   
}



*/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'C:/xampp/htdocs/Ipf_slim_api/vendor/autoload.php';
require 'C:/xampp/htdocs/Ipf_slim_api/src/config/db.php';
$config = ['settings' => [
  'addContentLengthHeader' => false,
]];

//Get All Company Bios 
$app = new \Slim\App($config);



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
$output=array('List of company bios'=>$data);
return json_encode($output);
mysqli_close($conn);

 }); 

//Get Company Bio  By Name
$app->get('/fetchApi/CompanyBiosByWebName/{web_site}',function(Request $require,Response $response){
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

$sql= "SELECT company_bio FROM comapny_data WHERE web_site='$web_site' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $company_bio=$row["company_bio"];
        $data=array('company_bio'=>$company_bio);

        return json_encode($data);

    }
} else {
     $data=array(
	    	'Error' => 'Bad request',
	        'Status'=>'400'
	    );
    return json_encode($data);
}

mysqli_close($conn);
});

//GET Company titles
$app->get('/fetchApi/AllGetNameAndTitles',function(Request $require,Response $response){
   // echo "TITLE ROUTE WORKING";
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
    $sql= "SELECT title,first_name,last_name FROM comapny_data ";
	$result = mysqli_query($conn, $sql);
	// Fetch all
	$data=mysqli_fetch_all($result,MYSQLI_ASSOC);

	return json_encode($data);
	//echo json_encode($data2);
	mysqli_close($conn);
}); 

//Get TITLE BY FIRST & LAST NAME
$app->get('/fetchApi/GetNameAndTitlesByCompnayBio/{company_bio}',function(Request $require,Response $response){

	$company_bio=$require->getAttribute('company_bio');
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "ipf_db";
	// Create connection for offline version
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql    = "SELECT title,first_name,last_name FROM comapny_data WHERE company_bio='$company_bio'";
    $result = mysqli_query($conn, $sql);
	   	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        $title=$row["title"];
	        $first_name=$row["first_name"];
	        $last_name=$row["last_name"];

	        $fullName=$first_name." ".$last_name;
	        $data=array(
	        	        'title'=>$title,
	        	        'first_name'=>$first_name,
	        	        'last_name'=>$last_name
	                   );

	        return json_encode($data);

	    }
	} else {
	    $data=array(
	    	'Error' => 'Bad request',
	        'Status'=>'400'
	    );
	    return json_encode($data);
	}

	mysqli_close($conn); 

}); 

//GET ALL ALL EMAIL
$app->get('/fetchApi/web_sites',function(Request $require,Response $response){
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

	$sql= "SELECT web_site FROM comapny_data ";
	$result = mysqli_query($conn, $sql);


	// Fetch all
	$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$output=array('List of websites'=>$data);
	return json_encode($output);
	mysqli_close($conn);
}); 

//GET WEBSITES BY COMPANY BIO
$app->get('/fetchApi/web_sitesBycompany_bio/{company_bio}',function(Request $require,Response $response){

	$company_bio=$require->getAttribute('company_bio');
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "ipf_db";
	
	// Create connection for offline version
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql    = "SELECT 	web_site FROM comapny_data WHERE company_bio='$company_bio'";
    $result = mysqli_query($conn, $sql);
	   	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        $web_site=$row["web_site"];
	        $data=array('web_site'=>$web_site);

	       return json_encode($data);

	    }
	} else {
	     $data=array(
	    	'Error' => 'Bad request',
	        'Status'=>'400'
	    );
	    return json_encode($data);
	}

	mysqli_close($conn); 



});


//Insert




//All routes here
//C:\xampp\htdocs\Ipf_slim_api\src\routes

require '../src/routes/fetchApi.php';
require '../src/routes/insertApi.php';
$app->run();