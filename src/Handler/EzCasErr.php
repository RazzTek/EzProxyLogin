<?php

namespace KC7VSZ\Handler;

class EzCasErr
{

    function ezmail($ipaddress, $userattributes)
    {

        $to = EZERRMAILTO; //, usueres@usu.edu';
        $subject = 'EzProxy Login Error Security';
        $headers = 'From: ' . EZERRMAILFROM . "\r\n" .
               'Reply-To: ' . EZERRMAILFROM . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

        $message = "User was successful logging in but was block until verification of account.";
                       //        . " the following line needs the host added: " . $ezproxyurl;
        $message .= "\r\nBrowser info: " . htmlentities($_SERVER['HTTP_USER_AGENT']);
        $message .= "\r\nA-number info: " . $userattributes['cn'];
        $message .= "\r\nIP info: " . $ipaddress;
        $message .= "\r\nEmail Address: " . $userattributes['preferredEmail'];
        $message .= "\r\n Information returned from CAS server: \r\n";
        $message .= "Member of Count: " . count($userattributes['memberOf']) . "\r\n";
        $message .= wordwrap($this->getalluserattr($userattributes), 200, PHP_EOL);
        // Send
        mail($to, $subject, $message, $headers);
    }

    function getalluserattr($userattributes)
    {
        $attr ="";

        if (count($userattributes) > 0) {
             foreach ($userattributes as $key => $value) {
                 if (is_array($value) && $key == "memberOf") {
                      $attr .= PHP_EOL . $key . ' :';
                      foreach ($value as $item) {
                          $attr .= PHP_EOL . $item;
                      }
                 } else {
                     if ($key == "displayName") {
                          $attr .= PHP_EOL . $key . ' : ' . $value . ',';
                      }
                 }
              }
          }
    return $attr;

    }

}
