<?php namespace App\Services;


use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;
use App\Number;

class GoogleApi {

    protected $client;

    protected $service;

    function __construct() {

        /* Get config variables */
        $client_id = Config::get('google.client_id');
        $service_account_name = Config::get('google.service_account_name');
        $key_file_location = base_path() . Config::get('google.key_file_location');

        /*Create instance of client*/
        $this
            ->client = new \Google_Client();

        /*Set application name */
        $this
            ->client
            ->setApplicationName("Your Application Name");

        //$this->service = new \Google_Service_Calendar($this->client);

        /* If we have an access token */
        if (Cache::has('service_token')) {
            $this
                ->client
                ->setAccessToken(Cache::get('service_token'));
        }

        $key = file_get_contents($key_file_location);

        /* Add the scopes you need */
        $scopes = array('https://spreadsheets.google.com/feeds',
            'https://www.googleapis.com/auth/drive',
            'email',
            'profile');

        $cred = new \Google_Auth_AssertionCredentials(
            $service_account_name,
            $scopes,
            $key
        );

        $this->client->setAssertionCredentials($cred);

        if ($this->client->getAuth()->isAccessTokenExpired()) {
            $this->client->getAuth()->refreshTokenWithAssertion($cred);
        }

        Cache::forever('service_token', $this->client->getAccessToken());
    }

    public function token()
    {
        $obj_token = json_decode($this->client->getAccessToken());
        $accessToken = $obj_token->access_token;

        return($accessToken);
    }

    public function client()
    {

        return($this->client);
    }


    /* Share a document with a user in the system
     *
     * @inputs:
     *      user email
     */

    public function shareDoc($email,$fileID){

        //Create Client
        $google = new GoogleApi();
        $client = $google->client();
        $service = new \Google_Service_Drive($client);

        //Call Class to handle permissions
        $newPermission = new \Google_Service_Drive_Permission();
        $newPermission->setValue($email);
        $newPermission->setType('user');
        $newPermission->setRole('reader');

        //Error handling
        try {
            $service->permissions->insert($fileID, $newPermission);
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }

    }

    /*
     * This method creates a file Json objects that is passed to the API
     * and creates a new instance of a sheet in the service drive
     *
     * @inputs:
     *      Title: Name of the file
     *
     * @return:
     *      This file must return the fileID so it can be passed to the
     *      shared method
     */

    public function createDoc($title)
    {
        //Create Client
        $google = new GoogleApi();
        $client = $google->client();
        $service = new \Google_Service_Drive($client);

        //Call class to handle drive files
        $file = new \Google_Service_Drive_DriveFile();
        $file->setTitle($title);
        $file->setDescription("Guestlist");
        $file->setMimeType('application/vnd.google-apps.spreadsheet');
        $createdFile = $service->files->insert($file);

        return $createdFile->getId();
    }

    /*
     * Gets the title of a file from the fileId  so
     * it can be accesed using the Spreedsheet helper class
     *
     * @input $fileId
     *
     * @return $title
     */
    public function getDocTitle($fileId)
    {

        //Create Client
        $google = new GoogleApi();
        $client = $google->client();
        $service = new \Google_Service_Drive($client);

        //Retrive title
        $file = $service->files->get($fileId);
        $title = $file->getTitle();

        return $title;

    }

    public function insertRsvpHeader($title)
    {
        //Create instance of client api and request token
        $spreadsheetService = $this->getSpreadsheetService();


        //Get the cell worksheet from worksheet
        $worksheet = $this->getFeed($spreadsheetService, $title);
        $cellFeed = $worksheet->getCellFeed();

        //Create row headers
        $this->insertDocHeaders($cellFeed);

    }

    public function insertTableHeader($title)
    {
        //Create instance of client api and request token
        $spreadsheetService = $this->getSpreadsheetService();


        //Get the cell worksheet from worksheet
        $worksheet = $this->getFeed($spreadsheetService, $title);
        $cellFeed = $worksheet->getCellFeed();

        //Create row headers
        $this->insertTableHeaders($cellFeed);

    }

    public function insertRsvp($fileId,$guest,$rsvp)
    {
        $spreadsheetService = $this->getSpreadsheetService();

        //Get the list feed for the doc
        $title = $this->getDocTitle($fileId);
        $worksheet = $this->getFeed($spreadsheetService, $title);
        $listFeed = $worksheet->getListFeed();

        //Create the RSVP for the Google Sheet
        $dt = new \DateTime;
        $stamp = $dt->format('m-d-y H:i:s');

        $row = $this->getInputArray($guest, $rsvp, $stamp);

        //TODO: add info from the rsvp and guest

        //Insert
        $listFeed->insert($row);
    }

    public function insertTable($fileId,$guest,$table)
    {
        $spreadsheetService = $this->getSpreadsheetService();

        //Get the list feed for the doc
        $title = $this->getDocTitle($fileId);
        $worksheet = $this->getFeed($spreadsheetService, $title);
        $listFeed = $worksheet->getListFeed();

        //Create the RSVP for the Google Sheet
        $dt = new \DateTime;
        $stamp = $dt->format('m-d-y H:i:s');

        $row = $this->getTableArray($guest, $table, $stamp);

        //TODO: add info from the rsvp and guest

        //Insert
        $listFeed->insert($row);
    }

    /**
     * @param $spreadsheetService
     * @param $title
     * @return mixed
     */
    public function getFeed($spreadsheetService, $title)
    {
//Get the list feed from worksheet

        $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
        $spreadsheet = $spreadsheetFeed->getByTitle($title);
        $worksheetFeed = $spreadsheet->getWorksheets();
        $worksheet = $worksheetFeed->getByTitle('Sheet1');

        return $worksheet;
    }

    /**
     * @return SpreadsheetService
     */
    public function getSpreadsheetService()
    {
//Create instance of client api and request token
        $google = new GoogleApi();
        $token = $google->token();

        //Create instance of spreed sheet service
        $serviceRequest = new DefaultServiceRequest($token);
        ServiceRequestFactory::setInstance($serviceRequest);
        $spreadsheetService = new SpreadsheetService();

        return $spreadsheetService;
    }

    /**
     * @param $guest
     * @param $num_of_guest
     * @param $stamp
     * @return array
     */
    public function getInputArray($guest, $rsvp, $stamp)
    {
        $number = Number::where('id',$guest->number_id)->value('number');

        $row = array(
            'timestamp' => htmlentities($stamp, ENT_QUOTES, "UTF-8"),
            'first' => htmlentities($guest->first, ENT_QUOTES, "UTF-8"),
            'last' => htmlentities($guest->last, ENT_QUOTES, "UTF-8"),
            'email' => htmlentities($guest->email, ENT_QUOTES, "UTF-8"),
            'date' => htmlentities($rsvp->rsvp_date, ENT_QUOTES, "UTF-8"),
            'guest' => htmlentities($rsvp->num_of_guest, ENT_QUOTES, "UTF-8"),
            'number' => htmlentities($number, ENT_QUOTES, "UTF-8"),
            'dob' => htmlentities($guest->dob, ENT_QUOTES, "UTF-8"),
            'gender' => htmlentities($guest->gender, ENT_QUOTES, "UTF-8"),
            'instagram' => htmlentities($guest->instragram, ENT_QUOTES, "UTF-8"),
            'facebook' => htmlentities($guest->facebook, ENT_QUOTES, "UTF-8"),
            'twitter' => htmlentities($guest->twitter, ENT_QUOTES, "UTF-8"),
        );

        return $row;
    }

    public function getTableArray($guest, $table, $stamp)
    {

        $number = Number::where('id',$guest->number_id)->value('number');

        $row = array(
            'timestamp' => htmlentities($stamp, ENT_QUOTES, "UTF-8"),
            'first' => htmlentities($guest->first, ENT_QUOTES, "UTF-8"),
            'last' => htmlentities($guest->last, ENT_QUOTES, "UTF-8"),
            'email' => htmlentities($guest->email, ENT_QUOTES, "UTF-8"),
            'date' => htmlentities($table->table_date, ENT_QUOTES, "UTF-8"),
            'guest' => htmlentities($table->num_of_guest, ENT_QUOTES, "UTF-8"),
            'budget' => htmlentities($guest->budget, ENT_QUOTES, "UTF-8"),
            'number' => htmlentities($number, ENT_QUOTES, "UTF-8"),
            'dob' => htmlentities($guest->dob, ENT_QUOTES, "UTF-8"),
            'gender' => htmlentities($guest->gender, ENT_QUOTES, "UTF-8"),
        );


        return $row;
    }

    /**
     * @param $cellFeed
     */
    public function insertDocHeaders($cellFeed)
    {
        $cellFeed->editCell(1, 1, "timestamp");
        $cellFeed->editCell(1, 2, "first");
        $cellFeed->editCell(1, 3, "last");
        $cellFeed->editCell(1, 4, "email");
        $cellFeed->editCell(1, 5, "date");
        $cellFeed->editCell(1, 6, "guest");
        $cellFeed->editCell(1, 7, "number");
        $cellFeed->editCell(1, 8, "dob");
        $cellFeed->editCell(1, 9, "gender");
        $cellFeed->editCell(1, 10, "instagram");
        $cellFeed->editCell(1, 11, "facebook");
        $cellFeed->editCell(1, 12, "twitter");
    }

    public function insertTableHeaders($cellFeed)
    {
        $cellFeed->editCell(1, 1, "timestamp");
        $cellFeed->editCell(1, 2, "first");
        $cellFeed->editCell(1, 3, "last");
        $cellFeed->editCell(1, 4, "email");
        $cellFeed->editCell(1, 5, "date");
        $cellFeed->editCell(1, 6, "guest");
        $cellFeed->editCell(1, 7, "budget");
        $cellFeed->editCell(1, 8, "number");
        $cellFeed->editCell(1, 9, "dob");
        $cellFeed->editCell(1, 10, "gender");
    }
}