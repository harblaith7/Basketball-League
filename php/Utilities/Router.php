<?php

/**
 * All router settings and protocols.
 *
 */
class Router
{
  /**
   * Router config settings. Starts session. Calls santization of post values. Lists allowed external hostnames. If an external request hostname is in the allowed hostnames list, then includes the origin in Access Control Allow Origin. Defines set error handler. Defines timezone.
   *
   */
  public static function config()
  {
    session_start();
    DB::sanitize();
    $allowed_hostnames = [
      "http://localhost",
      "http://anklebreaker.ca"
    ];
    if(isset(apache_request_headers()['Origin'])){
      if(in_array(apache_request_headers()['Origin'], $allowed_hostnames)){
        header(
          "Access-Control-Allow-Origin: ".apache_request_headers()['Origin']
        );
      } else {
        http_response_code(403);
        exit();
      }
    }
    date_default_timezone_set('America/New_York');
    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header_remove("X-Powered-By");
    error_reporting(E_ALL);
    set_error_handler("Router::errorHandler");
  }

  /**
   * Calls router config. Check if route exists. Loops through routes, if a match exists auth, group and method. The callback is then called and returned in JSON if it is an array, returned as a string if not.
   * @return mixed
   */
  public static function enable()
  {
    self::config();
    self::checkRouteExists();
    foreach(self::$routes as $array){
      if($_GET['route'] === $array['route']){
        // if(
        //   $_SERVER['REQUEST_METHOD'] !== $array['REQUEST_METHOD']
        // ){
        //   if($_SERVER['REQUEST_METHOD'] !== "OPTIONS"){
        //     http_response_code(405);
        //     error_log($_SERVER['REQUEST_METHOD']);
        //     return;
        //   }
        // }
        $auth = $array['auth'];
        if(
          (in_array('admin', $auth) && isset($_SESSION['admin_id']))
          || in_array('public', $auth)
        ){
          $callback = call_user_func($array['callback']);
          http_response_code(200);
          if(is_array($callback)){
            return json_encode($callback);
          } else {
            return $callback;
          }
        }
      }
    }
    return json_encode(['status' => 'error', 'message' => 'Access Denied']);
  }

  /**
   * Checks if current route exists, if not a 404 is returned and the operation is exited.
   *
   */
  public static function checkRouteExists()
  {
    $paths = [];
    foreach(self::$routes as $route){
      $paths[] = $route['route'];
    }
    if(!in_array($_GET['route'], $paths)){
      http_response_code(404);
      exit();
    }
  }

  /**
   * The function thats called when an error occurs. In localhost, Internal Server Error 500 is returned with the callback and message. Message error logged. Else, error details recorded in database. Operation exited.
   *
   * @param  int $errno
   * @param  string $errstr  message
   * @param  string $errfile file
   * @param  int $errline error line
   * @return string json array of the call status and result
   */
  public static function errorHandler($errno, $errstr, $errfile, $errline)
  {
    http_response_code(500);
    if($_SERVER['SERVER_NAME'] === "localhost"){
      $errmsg = $errstr." Error on line ".$errline." in ".$errfile;
      print json_encode(
        [
          'status' => 'error',
          'message' => $errmsg
        ]
      );
      error_log($errmsg);
    } else {
      $timestamp = DB::timestamp();
      $sql = "INSERT INTO php_errors(errno, errstr, errfile, errline, timestamp) VALUES('$errno', '$errstr', '$errfile', '$errline', '$timestamp')";
      mysqli_query(DB::connect(), $sql);
    }
    exit();
  }

  /**
   * Returns test gherkin front end test plans
   *
   * @return string testplan file
   */
  public static function testPlans()
  {
    return require("testplan.feature");
  }

  /**
   * Route arrays and their details.
   *
   * @var array
   */
  static $routes = [
  	[
  		'group' => 'public',
  		'route' => 'readTeams',
  		'callback' => 'PublicController::readTeams',
  		'auth' => ['public'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'public',
  		'route' => 'readSchedule',
  		'callback' => 'PublicController::readSchedule',
  		'auth' => ['public'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'public',
  		'route' => 'readPlayerStats',
  		'callback' => 'PublicController::readPlayerStats',
  		'auth' => ['public'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'public',
  		'route' => 'loginRequest',
  		'callback' => 'PublicController::loginRequest',
  		'auth' => ['public'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'logout',
  		'callback' => 'PublicController::logout',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'GET'
  	],
  	[
  		'group' => 'public',
  		'route' => 'createTeam',
  		'callback' => 'PublicController::createTeam',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'public',
  		'route' => 'joinTeam',
  		'callback' => 'PublicController::joinTeam',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminCreateEditTeam',
  		'callback' => 'AdminController::adminCreateEditTeam',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminDeleteTeam',
  		'callback' => 'AdminController::adminDeleteTeam',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminAddEditSchedule',
  		'callback' => 'AdminController::adminAddEditSchedule',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminDeleteSchedule',
  		'callback' => 'AdminController::adminDeleteSchedule',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminCreateEditPlayer',
  		'callback' => 'AdminController::adminCreateEditPlayer',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminReadPlayers',
  		'callback' => 'AdminController::adminReadPlayers',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'GET'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminDeletePlayer',
  		'callback' => 'AdminController::adminDeletePlayer',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminCreateStat',
  		'callback' => 'AdminController::adminCreateStat',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminReadUnpaid',
  		'callback' => 'AdminController::adminReadUnpaid',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'GET'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminDeleteUnpaid',
  		'callback' => 'AdminController::adminDeleteUnpaid',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  	[
  		'group' => 'admin',
  		'route' => 'adminPaidUnpaid',
  		'callback' => 'AdminController::adminPaidUnpaid',
  		'auth' => ['admin'],
  		'REQUEST_METHOD' => 'POST'
  	],
  ];
}
