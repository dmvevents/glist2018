<?php namespace App\Services;

use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;

class Mandrill
{


    public function send ($from, $from_name, $to, $to_name,$subject,$html,$text)
    {
        try {
            $api_key= Config::get('mandrill.app_key');

            $mandrill = new \Mandrill($api_key);
            $message = array(
                'html' => $html,
                'text' => $text,
                'subject' => $subject,
                'from_email' => $from, //
                'from_name' => $from_name,
                'to' => array(
                    array(
                        'email' => $to,
                        'name' => $to_name,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $from),
                'important' => false,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => $from,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',
                'tags' => array('password-resets'),
            );

            $async = false;
            $ip_pool = 'Main Pool';
            $result = $mandrill->messages->send($message, $async, $ip_pool);


        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }

    public function sendRsvpEmail($user, $event, $venue, $guest )
    {
        $from = $user->email;
        $from_name = $user->first.' '.$user->last;
        $to = $guest->email;
        $to_name = $guest->first.' '.$guest->last;
        $subject =$guest->first.', we have received your rsvp ';
        $html =$subject;
        $text =$subject;

        $this->send($from, $from_name, $to, $to_name,$subject,$html,$text);

    }

    public function sendSignUp($user )
    {
        $from = 'DMVevents@gmail.com';
        $from_name = 'DMVevents';
        $to = $user->email;
        $to_name = $user->first.' '.$user->last;
        $subject =$user->first.', you have just signed up';
        $html =$subject;
        $text =$subject;

        $this->send($from, $from_name, $to, $to_name,$subject,$html,$text);

    }
}
