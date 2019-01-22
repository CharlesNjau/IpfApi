<?php
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


getCompanyBio($conn);
//getCompanyBioByName($conn, "Caltex");
//getTitles($conn);
//getTitlesByName($conn,"Charles","Njau");
//getName($conn);
//getNamesByTitle($conn,"402");
//getWebSites($conn);
//getWebSitesByName($conn, "Caltex");

function getCompanyBio($conn)
{
    $sql    = "SELECT company_bio FROM comapny_data ";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                
                'company_bio' => $row["company_bio"],
                
            );
            
            $json=json_encode($result);
            echo $json;

           // return $json;
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        $error=json_encode($result);
        return $error;
        $conn->close();
    }
    
}



function getCompanyBioByName($conn, $company_bio)
{
    $sql    = "SELECT * FROM comapny_data WHERE company_bio='$company_bio'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                'company_bio' => $row["company_bio"]
            );
            
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
    
    
}





function getTitles($conn)
{
    $sql    = "SELECT title FROM comapny_data";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                'title' => $row["title"]
            );
            
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
}

function getTitlesByName($conn, $first_name, $last_name)
{
    $sql    = "SELECT title FROM comapny_data WHERE first_name='$first_name' AND last_name='$last_name'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                'title' => $row["title"]
            );
            
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
}

function getName($conn)
{
    $sql    = "SELECT first_name,last_name  FROM comapny_data ";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                'first_name' => $row["first_name"],
                'last_name'=>$row["last_name"]
            );
            
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
}

function getNamesByTitle($conn, $title)
{
    $sql    = "SELECT first_name,last_name FROM comapny_data WHERE title='$title'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
              $result = array(
                'first_name' => $row["first_name"],
                'last_name'=>$row["last_name"]
            );
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
}
exit();
function getWebSites($conn)
{
    $sql    = "SELECT web_site FROM comapny_data";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                'web_site' => $row["web_site"]
            );
            
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
}

function getWebSitesByName($conn, $company_bio)
{
    $sql    = "SELECT web_site FROM comapny_data WHERE company_bio='$company_bio'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            
            $result = array(
                'web_site' => $row["web_site"]
            );
            
            echo json_encode($result);
            
            
        }
        $conn->close();
    } else {
        $result = array(
            'Error' => "500"
        );
        
        echo json_encode($result);
        $conn->close();
    }
}

function InsertCompanyDetail($conn, $first_name,$last_name,$company_bio,$web_site,$title)

{

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


?>

