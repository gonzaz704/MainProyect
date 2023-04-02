<?php

namespace App\Http\Controllers;

use willvincent\Feeds\Facades\FeedsFacade;
use MonkeyLearn;

/**
 * Class RssReaderController
 * @package App\Http\Controllers
 */
class RssReaderController extends Controller
{

    /**
     * @return mixed
     */
    function index()
    {
        $feed = FeedsFacade::make(config('feeds.sources'), 2, true);
        $sentiments_for_news = [];
        $model_id = 'cl_LQF6NKzW';
        $data = array(
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items()
        );

        $monkeyClient = new MonkeyLearn\Client('b2e5bb14f08343dc6aeb7e262d34a2421e9bfc77');
        foreach ($data['items'] as $item) {
            $content_without_html_tags[] = trim(strip_tags($item->get_content()));
        }

        $response = $monkeyClient->classifiers->classify($model_id, $content_without_html_tags);
/**        foreach($response->result as $key => $result){
            if ($result['error'] == false) {
                $tags = $result['classifications'];
                foreach ($tags as $tag) {
                    $sentiments_for_news[$key][] = $tag['tag_name'];
                }
            }
        }
**/
        return \View::make('rssreader.index', ['data' => $data, 'sentiments_for_news' => $sentiments_for_news]);

    }


}

/** AWScomprehend $comprend
 *Todo  RSS se carga en el $feed
 *Las funciones get_title() get_permalink() y get_items() seleccionan qué cosa del feed cargar (tienen esa capacidad porque ya vienen programadas en la libreria willvincent).. nosotros elegimos que cargue solo el titulo y los items
 * Con eso elegido, todo se carga en $data
 * Se hace un foreach con $data['items'] donde se carga en $data cada feed que serían los 'items'
 * Entonces se carga
 * a) en el $item el get_title() str_slug para que se vea lindo el titulo en notidata
 * b) con $item->get_decription() cargo en $item el contenido de la noticia pero cortito, que no la muestre toda
 * c) Esta ultima lina del foreach no la entiendo, no entiendo que son las variables que tienen corchetes y despues variables o nombres adentro.... lo que veo es que analiza las noticias con sentimentanalysis y luego lo carga en el $comprehend que es le parametro de la funcion principal de arriba y eso es igual a una varibale que crea ahi llamada $sentiment_for_news con un corchete y el $slug que es el titulo adentro (capaz es para analizar el titulo tambien).. pero no porque lo analiza con la funcion de sentimentanalysis
 *
 * d) Esto no lo entiendo $data['sentiments_for_news'] = $sentiments_for_news;
 *
 *
 * $data agarra toda la news titulo, items,**/
