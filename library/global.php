<?php
function getConfig($key)
{
  return isset(autoload::$_CONFIG[$key]) ? autoload::$_CONFIG[$key] : "";
}

function setConfig($key, $value)
{
  autoload::$_CONFIG[$key] = $value;
  return isset(autoload::$_CONFIG[$key]) ? autoload::$_CONFIG[$key] : "";
}

function getString($key)
{
  return isset(autoload::$_STRING[$key]) ? autoload::$_STRING[$key] : "";
}

function getComponentUrl($moduleName, $componentName, $params = array())
{
  return '?module=' . $moduleName . '&component=' . $componentName . "&" . http_build_query($params);
}

function isPost()
{
  return ($_SERVER['REQUEST_METHOD'] == 'POST') ? true : false;
}

function getUserId()
{
  return ($_SESSION['user_id'] > 0) ? $_SESSION['user_id'] : 0;
}

function getUserRole()
{
  return $_SESSION['user_role'];
}

function isAdmin()
{
  return (isset($_SESSION['user_role']) && $_SESSION['user_role'] == USER_ROLE_ADMIN) ? true : false;
}

function isUserRole($roleId)
{
  return (getUserRole() == $roleId) ? true : false;
}

function isOwner($userId)
{
  return ($userId == getUserId()) ? true : false;
}

function isLoggedInUser()
{
  if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    return true;
  } else {
    return false;
  }
}

function sendAjaxResponse($status = true, $message = "", $options = array())
{
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  header('Content-Type: application/json');
  echo json_encode(array('status' => $status, 'message' => $message));
  die();
}

?>
