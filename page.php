<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '1066597540188266',
  'app_secret' => '0e5c2f9fd1626689fb67a5df4dead4e2',
  'default_graph_version' => 'v3.1',
  //'default_access_token' => '{access-token}', // optional
]);

$fb->setDefaultAccessToken('EAAPKEJeAUGoBAAYfSd8FJCEZAGbCx2XG5zTyMQdnIfcLZBZAR7w3y9fstP5PImxMcr4mqkhfS58NZApIF5BZCBXQgIqtKzDAkPhvoTwCUoeZC1S9UjnrOs6yI9JLW3pZADgtQJNGkRZBSpxOlIGYDc6kPZCHXEUWERvynjE1rNa0IHgZDZD');

$a_post = array(
    'message' => "My test post"
);

try {
  //$response = $fb->get('/218056112203420_218064452202586/comments');
  $response = $fb->post('/me/feed', $a_post); // post to page
} catch(Exception $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getDecodedBody();
echo 'Logged in as ' . $me['name'].'<br>';
var_dump($me);

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
  </head>
  <body>
    
  </body>
</html>
