<?php 
/*
This Class was created to contain all get request 
warning when using modular design and routin don't do the follwoing

for all get request never use the same name this can cause an internal server Error
i.e 

 $app->get('/fetchApi/CompanyBios',function(Request $require,Response $response){..});
 followed by 
 $app->get('/fetchApi/{name}',function(Request $require,Response $response){..});

 will generate an internal status 500 server error

 always add  for all routes generated

 use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
*/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


//Get titles by first name and last name
  $app->get('/fetchApi/TitlesByName/{first_name}/{last_name}',function(Request $require,Response $response){

    $first_name=$require->getAttribute('first_name');
    $last_name=$require->getAttribute('last_name');

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
     $sql= "SELECT title FROM comapny_data WHERE first_name='$first_name' AND last_name='$last_name' ";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $company_bio=$row["title"];
            $data=array('title'=>$title);
    
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

  $app->get('/fetchApi/CompanyBios',function(Request $require,Response $response){
    //Create database connection*/
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
    
    //Get company titles
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
    
    //Get titles bt first and last name
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
    
    //Get all website
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
    
    //Get web site by company bio
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
    
  



