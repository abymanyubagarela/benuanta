<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {
    var $client;
    function __construct() {
        parent::__construct();
        // $this->calendarapi = new Google_Service_Calendar($this->googlecalender183->client());
        // $client = new Google_Client();
        // $client->setAuthConfig('credential.json');
        // $client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client = $client;
    }

    public function index() {    
        // https://www.youtube.com/watch?v=q3imho6ZBhY&ab_channel=WebDevMatics
        // https://developers.google.com/calendar/api/guides/create-events
        // https://techarise.com/integrate-google-calendar-api-with-codeigniter-calendar-library/
        // https://developers.google.com/calendar/api/concepts/events-calendars?hl=en_US
        // echo $this->googlecalender183->getLibraryVersion();   
        // echo $this->googlecalender183->isAccessTokenExpired();   
        // $client = new Google_Client();

    //  $event = new Google_Service_Calendar_Event(
    //     array(
    //         'summary'     => "tes",
    //         'description' => "desc",
    //         'start'       => array(
    //             'dateTime' => "2021-06-24T02:08:00",
    //             'timeZone' => 'Asia/Jakarta',
    //         ),
    //         'end'         => array(
    //             'dateTime' => "2021-06-24T02:10:00",
    //             'timeZone' => 'Asia/Jakarta',
    //         ),
    //         'attendees'   => array(
    //             array('email' => 'subbagumumti.jakarta@gmail.com'),
    //         ),
    //     )
    // );

        // $x= $this->googlecalender183->getUser();
        // print_r($x);die();
        // $service = new Google_Service_Calendar($this->googlecalender183->getClient());
        // return $service->events->insert("primary", $event);

        
        // $x = $this->googlecalender183->loginUrl();
        // var_dump(filter_var($x, FILTER_VALIDATE_URL));
        // $y = $this->googlecalender183->getAuthenticate("aojofw");
        
        // print_r($x);die();
        // 


        //$lala = "4/0AY0e-g4w4l9foXqbViznUSl8kq3R4ah72WyqIXyP9MaW2G_WTfYSb_rnNivTOtFCzQIp-w";
        // print_r($this->googlecalender183->client->isAccessTokenExpired());die();
        //$this->googlecalender183->client->authenticate($_GET['code']);
        // $token = $this->googlecalender183->client->getAccessToken();
        
        //$this->googlecalender183->setAccessToken($this->googlecalender183->client->getAccessToken());

        //$service = new Google_Service_Calendar($this->googlecalender183->client);
        //$service->events->insert("primary", $event);
    }
}
