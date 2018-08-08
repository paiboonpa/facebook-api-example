<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '{your-app-id}', // TODO: EDIT HERE
  'app_secret' => '{your-secret}', // TODO: EDIT HERE
  'default_graph_version' => 'v3.0',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
  $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
$permissions = ['email']; // Optional permissions
echo '<a href="'.$helper->getLoginUrl('https://localhost/swp/', $permissions).'">Login Redirect</a>';
$access_token = $helper->getAccessToken();

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getJavaScriptHelper();

try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me', $access_token);
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getDecodedBody();
echo 'Logged in as ' . $me['name'].'<br>';

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
  </head>
  <body>
    <div>
      <img src="https://graph.facebook.com/me/picture?access_token=<?=strval($access_token)?>">
    </div>
  </body>
</html>
