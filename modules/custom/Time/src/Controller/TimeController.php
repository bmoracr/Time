<?php

namespace Drupal\Time\Controller;

use Drupal\Core\Controller\ControllerBase;

// Declaring Time Controller for module
class TimeController extends ControllerBase {


  // Requesting to API and getting the information
  public function getDateTime(Array $timezone){

    $output = [];
    for ($i=0; $i < count($timezone); $i++) { 
      $request = file_get_contents("https://worldtimeapi.org/api/timezone/" . $timezone[$i]);
      $response = json_decode($request);
      $output[] = $response;
    }
    return $output;

  }

  public function content() {

    // Returning data to render a module
    return [      
      '#theme' => 'Time_theme_hook',
      '#getDate' => $this->getDateTime(['America/Costa_Rica','America/New_York','Europe/Belgrade']),
      '#attached' => [
        'library' => [
          'Time/Time-styling',
        ],
      ],      
    ];
    
  }

}


