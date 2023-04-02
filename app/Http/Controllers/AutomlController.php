<?php

namespace App\Http\Controllers;

use Google\Cloud\Core\ServiceBuilder;

class AutomlController extends Controller
{
    
    public function googleautoml()
    {
        // Code will be added here
        $cloud = new ServiceBuilder([
    		'keyFilePath' => base_path('gc.json'),
    		'projectId' => 'automl-first'
		]);

		$language = $cloud->language();

		$text = 'ungry';

		// Detect the sentiment of the text
		$annotation = $language->analyzeSentiment($text);
		$sentiment = $annotation->sentiment();

		echo $text 	.	"<br/>";
		echo "<pre>";print_r($sentiment) . "<br/>" . "<br/>";
		echo 'Sentiment Score: ' . $sentiment['score'] . ', Magnitude: ' . $sentiment['magnitude'];

    }

}