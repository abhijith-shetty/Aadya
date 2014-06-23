<?php
class pushNotification
{
  protected static $objInstance;
  
  public static function get()
  {
    if(!isset(self::$objInstance)){
      $class=__CLASS__;
      self::$objInstance=new $class;
    }
    return self::$objInstance;
  }
  
  public function iOSPushNotification($deviceToken, $message, $options=array())
  {
    $badge = 3;
    $sound = 'default';
    $apns_port = 2195;
    $apns_url  = getConfig('ios_push_url');
    $apns_cert = getConfig('ios_push_certificate');
    
    $payload = array();
    $payload['aps'] = array('alert' => $message, 'badge' => intval($badge), 'sound' => $sound);
    $payload = json_encode($payload);

    $stream_context = stream_context_create();
    stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);

    $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
    
    $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
    $res = fwrite($apns, $apns_message); 
    
    log::showd($error);
    @socket_close($apns);
    @fclose($apns);
  }
}
