<?php namespace App\Services;


use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;

class TelApi
{

    protected $client;

    protected $service;

    function __construct()
    {

    }

    public function sendSms($number,$message)
    {

        //Get API Client
        $sid= Config::get('telapi.sid');
        $auth_token = Config::get('telapi.auth_token');

        // Set up your TelAPI credentials
        $telapi = \TelApi::getInstance();
        $telapi -> setOptions(array(
                'account_sid'       => $sid,
                'auth_token'        => $auth_token,
            ));

        // Send the SMS
        $sms_message = $telapi->create('sms_messages', array(
                'From' => '+12025170647',
                'To'   => '+1'.$number,
                'Body' => $message
            ));

    }
    public function getCarrier()
    {
        //Get API Client
        $sid= Config::get('telapi.sid');
        $auth_token = Config::get('telapi.auth_token');

        // Set up your TelAPI credentials
        $telapi = \TelApi::getInstance();
        $telapi -> setOptions(array(
                'account_sid'       => $sid,
                'auth_token'        => $auth_token,
            ));

        $carrier_resource = $telapi->get('carrier', array(
                'PhoneNumber' => '14436940212'
            ));

        dd($carrier_resource->getResponse());
    }
}