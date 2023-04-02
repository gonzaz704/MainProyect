<?php
namespace App\Library\Services\AWS;

/**
 * Class AWSComprehend
 */
class AWSComprehend
{
    /**
     * @param $comments
     * @return array|string
     */
    public function sentimentAnalysis($comments) // sentimentAnalysis es inventada---INICIA $COMMENTS, hace un contador que si los comentarios son mayores a cero, empieza la variable $CONFIG, donde asigna el idioma y los propios $COMMENTS los asocia con 'TextList'
    {

     //   $results = array(); // INICIA $RESULTS Y ARRAY()-- $RESULTS va a ser lo que carga los 'positive' y 'negative' dentro de sus parentesis, como un array-- y ARRAY() va a equivaler a $results a $positive y $negative a la vez-- PREGUNTAR ESTO PORQUE NO LO ENTIENDO.. por que a dos variables distintas? o es que carga... ah para, es que trae datos, es una fucion para traer datos. Los trae y carga en $RESULTS, que despues va a estar en RETURN, va a mostrarnos lo positivo en negativo de una news-- 

        if (count($comments) > 0) { //$comments es el parametro de la clase creada SentimentAnalysis
            $config = [ // INICIA $CONFIG
               // 'LanguageCode' => 'en', 
               // 'TextList' => $comments, // $comments sigue siendo el parametro de la Clase principal
                'DataAccessRoleArn' => 'arn:aws:iam::180517273611:role/fromsupport',
                'InputDataConfig' => [
                'InputFormat' => 'ONE_DOC_PER_FILE', 
                'S3Uri' => 's3://inputsupport1'],
                'OutputDataConfig' => [ // REQUIRED
                'S3Uri' => 's3://outpusupport'], // REQUIRED
                                        
            ]; 

        //    $jobSentiment = \Comprehend::batchDetectSentiment($config); //INICIA $JOBSENTIMENT ACA ESTA LA CONEXION CON AWS

       $topics = \Comprehend::startTopicsDetectionJob($config);
        dd($topics); 


            $positive = array(); //INICIA $POSITIVE
            $negative = array(); //INICIA $NEGATIVE

            if (count($jobSentiment['ResultList'])) { //INICIA RESULTLIST
                foreach ($jobSentiment['ResultList'] as $result) { //INICIA $RESULT
                    $positive[] = $result['SentimentScore']['Positive'];
                    $negative[] = $result['SentimentScore']['Negative'];
                }
            }

            $results['positive'] = array_sum($positive) / count($positive);
            $results['negative'] = array_sum($negative) / count($negative);
            $results['sentiment'] = ($results['positive'] > $results['negative'] ? 'POSITIVE' : 'NEGATIVE');

            return $results;
        } else {
            return $results['sentiment'] = 'INVALID';
        }

    }


}

