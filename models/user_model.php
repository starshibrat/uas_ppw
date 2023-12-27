<?php


class User
{
    
    public $username;
    public $id;
    public $posts;
    public $followed;
    public $followers;
    public $bio;

    function __construct($username, $id)
    {

        $this->username = $username;
        $this->id = $id;

        include(__DIR__ . '/../server/docs/api_url.php');

        $url = "$getUserById?id=" . $this->id;

        $response = file_get_contents($url);

        $responseJson = json_decode($response, true);
        
        $this->followers = $responseJson["followers"];
        $this->following = $responseJson["following"];
        $this->bio = $responseJson["bio"];

    }


}


?>