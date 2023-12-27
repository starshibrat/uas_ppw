<?php
class Post
{
    public $id;
    public $author;
    public $content;
    public $created_at;
    public $loves;
    
    public $author_id;


    function __construct($id)
    {
        $this->id = $id;

        $post = $this->fetch();

        $content = $post["content"];

        $author = $this->fetch_author($post["user_id"]);

        $author_username = $author["username"];
        $this->author_id = $post["user_id"];
        $this->author = $author_username;
        $this->content = $content;
        $this->created_at = $post["post_date"];
        $this->loves = $post["loves"];

    }

    function fetch()
    {


        include(__DIR__ . '/../server/docs/api_url.php');
        $url = "$getTweet?post_id=" . $this->id;

        $response = file_get_contents($url);

        $responseJson = json_decode($response, true);

        return $responseJson;


    }

    function fetch_author($user_id)
    {

        include(__DIR__ . '/../server/docs/api_url.php');
        $url = "$getUserById?id=" . $user_id;

        $response = file_get_contents($url);

        $responseJson = json_decode($response, true);

        return $responseJson;

    }

}

?>