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

require '../vendor/autoload.php';
require '../src/config/db.php';
$config = ['settings' => [
  'addContentLengthHeader' => false,
]];

//Get All Company Bios 
$app = new \Slim\App($config);







//Insert




//All routes here
//C:\xampp\htdocs\Ipf_slim_api\src\routes

require '../src/routes/fetchApi.php';
require '../src/routes/insertApi.php';
$app->run();