<?php

namespace App\Http\Controllers;


class AWSComprehendController extends Controller{
    


    public function tosentimentAnalysis(){
        
        
        /*$config = [
            'LanguageCode' => 'en',
            'TextList' => ['This is good', 'This is bad'],
        ];

        $jobSentiment = \Comprehend::batchDetectSentiment($config);

        echo "<pre>";print_r($jobSentiment['ResultList']);*/





        $comments = [
            'I think this is very good considering I created a package/wrapper for Amazon Comprehend. Yay me!',
            'Oh my good this is such a bloody rubbish package/wrapper. I hope the author stops coding immediately.',
            'This is really good, I really love this stand by this',
            'This is sooooo bad'
        ];

        echo "<pre>";print_r($this->sentimentAnalysis($comments));


    }

}