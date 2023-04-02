<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::post('/getNewsSourceByCountry', 'HomeController@getNewsSourceByCountry')->name('newsSource.byCountry');
Route::get('/policy', 'HomeController@policy');
Auth::routes();
Route::post('news/country/change', 'NewsController@changeCountry')->name('news.country.change');
Route::get('news/{id}/popular/paper', 'NewsController@getPopularPaper');
Route::get('news/{id}/title', 'NewsController@getTitle');
Route::get('/confirm/paper/data/{id}', 'NewsDataController@confirm')->name('papers.confirm');
Route::get('/rejct/paper/data/{id}', 'NewsDataController@reject')->name('papers.reject');
Route::get('/verify/paper/confirm/{id}', 'PapersController@confirm')->name('papers.verify.confirm');
Route::get('/verify/paper/reject/{id}', 'PapersController@reject')->name('papers.verify.reject');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
Route::get('/languageDemo', 'HomeController@languageDemo');
Route::get('/retrive-metadata-from-url', 'HomeController@retriveMetadataFromUrl');

Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact', 'ContactController@store')->name('contact.store');


Route::get('data/{id}/share', 'SocialShareController@socialShare')->name('data.share');
Route::get('news/details/{id}', 'NewsController@details')->name('news.details');

// Route::group(['middleware' => ['role:Admin|Author']], function () {
Route::resource('my-news', 'MyNewsController');
// });

Route::group(['middleware' => ['role:Admin']], function () {
    Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
        Route::resource('users', 'AdminUserController', ['only' => ['index', 'destroy', 'show']]);
        Route::resource('news', 'AdminNewsController', ['only' => ['index', 'destroy', 'show']]);
        Route::get('news/delete/all', 'AdminNewsController@deleteAll')->name('news.delete-all');
        Route::get('newstags/{id}/changeStatus', 'AdminNewsTagsController@changeStatus')->name('newstags.changeStatus');
        Route::get('chartstags/{id}/changeStatus', 'AdminChartsTagsController@changeStatus')->name('chartstags.changeStatus');
        Route::get('paperstags/{id}/changeStatus', 'AdminPapersTagsController@changeStatus')->name('paperstags.changeStatus');
        Route::get('newstags/delete-all', 'AdminNewsTagsController@deleteAll')->name('newstags.delete-all');
        Route::get('chartstags/delete-all', 'AdminChartsTagsController@deleteAll')->name('chartstags.delete-all');
        Route::get('paperstags/delete-all', 'AdminPapersTagsController@deleteAll')->name('paperstags.delete-all');
        Route::resource('newstags', 'AdminNewsTagsController');
        Route::resource('paperstags', 'AdminPapersTagsController');
        Route::resource('chartstags', 'AdminChartsTagsController');

        Route::resource('news_sources', 'AdminNewsSourceController');
        Route::get('news_sources/{id}/changeStatus', 'AdminNewsSourceController@changeStatus')->name('news_sources.changeStatus');
        Route::get('news_source/delete-all', 'AdminNewsSourceController@deleteAll')->name('news_sources.delete-all');
        Route::resource('contact', 'AdminContactController');
        Route::get('countries/delete-all', 'CountryController@deleteAll')->name('countries.delete-all');
        Route::get('countries/{id}/changeStatus', 'CountryController@changeStatus')->name('countries.changeStatus');
        Route::resource('countries', 'CountryController');
        Route::get('topics/{id}/changeStatus', 'TopicController@changeStatus')->name('topics.changeStatus');

        Route::get('topics/delete-all', 'TopicController@deleteAll')->name('topics.delete-all');
        Route::resource('topics', 'TopicController');
        // Route::resource('filters/countries', 'FilterCountryController');
        // Route::resource('filters/maintopic', 'FilterMainTopicController');
        // Route::resource('filters/subtopic1', 'FilterSubtopic1Controller');

        Route::get('/papers', 'PapersController@adminManagePapers')->name('papers.index');
        Route::get('/papers/approve/{id}', 'PapersController@adminApprovePapers')->name('papers.approve');
        Route::get('/papers/reject/{id}', 'PapersController@adminRejectPapers')->name('papers.reject');
        Route::get('/papers/edit/{id}', 'PapersController@adminEditPapers')->name('papers.edit');
        //Route::get('/papers/update/{id}', 'PapersController@adminUpdatePapers')->name('papers.update');
        Route::get('/papers/review/{id}', 'PapersController@adminReviewPapers')->name('papers.review');

        Route::delete('/papers/delete/{id}', 'PapersController@destroy')->name('papers.destroy');
        Route::delete('/papers/delete-all', 'PapersController@deleteAll')->name('papers.delete-all');
    });
    Route::resource('pais', 'PaisController');
    Route::get('paisdata', 'PaisController@get_datatable');
    Route::post('pais/save', 'PaisController@to_save');
    Route::resource('categoria', 'CategoriaController');
    Route::post('categoria/save', 'CategoriaController@save');
    Route::post('categoria/{id}/actualizar', 'CategoriaController@actualizar');
    Route::post('categoria/edit', 'CategoriaController@edit');
    Route::resource('subcategoria', 'SubCategoriaController');
    Route::post('subcategoria/save', 'SubCategoriaController@save');
    Route::resource('nacademicos', 'NivelAcademicoController');
    Route::get('nacademicosdata', 'NivelAcademicoController@get_datatable');
    Route::post('nacademicos/save', 'NivelAcademicoController@to_save');
    Route::resource('interes', 'InteresController');
    Route::get('interesdata', 'InteresController@get_datatable');
    Route::post('interes/save', 'InteresController@to_save');


    Route::get('news', 'NewsController@index');
    Route::get('news-create', 'NewsController@createNews')->name('news-create');
    Route::post('news-store', 'NewsController@storeNews')->name('news-store');
    Route::post('news/update', 'NewsController@updateNews');
    Route::post('news/classify', 'NewsController@classifyNews');
    Route::get('news/{id}', 'NewsController@edit');

    // charts
    Route::resource('investigadores', 'InvestigadoresController');
    Route::post('investigadores/save', 'InvestigadoresController@save');

    Route::get('/rssreader', 'RssReaderController@index')->name('rssreader');
    Route::resource('datatests', 'DataTestsController');
    Route::post('datatests/index', 'DataTestsController@index');
});

Route::group(['middleware' => ['role:Author']], function () {
    Route::get('/confirm/papers', 'NewsDataController@index')->name('papers.confirm.index');
    Route::get('/reviews/papers', 'PaperReviewController@index')->name('papers.reviews.index');
    Route::get('/confirm/paper/review/{id}', 'PaperReviewController@confirm')->name('papers.review');
    Route::post('/feedback/paper', 'PapersController@feedback')->name('papers.feedback');
});


Route::group(['middleware' => ['role:User|Author']], function () {
    Route::resource('seguidores', 'FollowersController');
    Route::resource('siguiendo', 'FollowingsController');
    Route::resource('papers', 'PapersController'); //Route::resource('nombre de la ruta', 'Nombre del controlador') sin esta no anda la ruta y no carga la pagina y sin la de abajo no guarda pero carga la pagina?
    Route::post('papers/save', 'PapersController@save'); //Route::post('nombre de la base de datos/nombre de la ruta a activar desde el home hasta esa ruta'/guardar', 'NombredelControlador@save'esto esta en las views)
    Route::post('papers/save_ajax', 'PapersController@save_json');
    Route::get('edit-paper/{paper}', 'PapersController@editPaper');
    Route::put('edit-paper/{paper}', 'PapersController@updatePaper');
    Route::get('delete-paper/{paper}', 'PapersController@deletePaper');
    Route::get('restore-paper/{paper}', 'PapersController@restorePaper');

    Route::resource('usuario', 'UserController');
    Route::post('usuario/save', 'UserController@updateprofile');
    Route::post('usuario/put_intereses', 'UserController@set_intereses');
    Route::post('usuario/followings_interests', 'UserController@get_followings_interests');
    Route::get('dashbord/{user_to_follow}/follow', 'ProfileController@follow')->name('profile.follow');
    Route::post('usario/follow', 'ProfileController@usario')->name('usario.follow');
    Route::get('dashbord/{user_to_vote}/vote/{paper_id}', 'ProfileController@vote')->name('vote.papers');
    Route::get('user/{id}/profile', 'ProfileController@index')->name('user.profile');
    Route::get('/usuario/{name}', 'UserController@show'); //video de hasmany, mostrar los mensajes de un usuario
    Route::get('/user/{id}/profile/seguir', 'UserController@seguir'); //Listado de usuario que sigue. A quienes sigue el usuario que esta en la URL
    Route::get('/discussions', 'DiscussionController@index')->name('discussion.index');
    Route::get('/discussions/{paper_id}/create', 'DiscussionController@create')->name('papers.discuss');
    Route::post('/discussions/{paper_id}/store', 'DiscussionController@store')->name('papers.discuss.submit');
    Route::post('/discussions/{id}/store', 'DiscussionController@store')->name('papers.discuss.submit');
    Route::get('/discussions/{id}/show', 'DiscussionController@show')->name('papers.discuss.show');
    Route::post('/discussions/{id}/comment', 'DiscussionController@comment')->name('papers.discuss.comment');
    Route::get('/ranking', 'RankingController@index')->name('ranking.index');
});

Route::resource('data', 'PapersDashboardController');
Route::get('papers_dashboard/show-charts', 'PapersDashboardController@showCharts')->name('dashboard.showcharts.papers');

Route::group(['middleware' => ['role:User|Author|Admin']], function () {
    Route::post('/papers/review/{id}', 'PapersController@adminReviewUpdatePapers')->name('papers.review.update');

    Route::get('paper/{id}/view', 'PapersController@viewPaperDetail')->name('paper.view');
    Route::get('chart/{id}/view', 'ChartController@viewChartDetail')->name('chart.view');
    Route::get('/chart/{id}/details', 'ChartController@details')->name('chart.details');

    Route::get('notification/{id}', 'NotificationController@index')->name('notification');
    Route::get('notifications/read', 'NotificationController@markRead')->name('notification.read');
    Route::get('/papers/{id}/details', 'PapersController@details')->name('papers.details');
    Route::post('/papers/filter', 'PapersController@filter')->name('papers.filter');

    Route::post('news/{id}/charts', 'NewsController@addCharts')->name('news.charts');
    Route::post('news/{id}/papers', 'NewsController@addPapers')->name('news.papers');
    Route::get('news/data/{id}', 'NewsDataController@edit')->name('news.data.edit');

    Route::get('papers_dashboard/search/papers', 'PapersDashboardController@searchPapers')->name('dashboard.search.papers');
    Route::get('papers_dashboard/search/open_data', 'PapersDashboardController@searchOpenData')->name('dashboard.search.open_data');


    Route::get('search', 'DashboardController@seachPapers');
    Route::get('search_news', 'NewsController@searchNews')->name('search_news');
    Route::get('/markAsRead', 'NotificationController@markRead')->name('markRead.notification');

    Route::post('news/{id}', 'NewsController@update');


    Route::get('charts/create', 'ChartController@create')->name('create.chart');
    Route::get('charts/{id}', 'ChartController@edit')->name('charts.edit');
    Route::post('charts/store', 'ChartController@store')->name('charts.store');
    Route::post('charts/{id}/edit', 'ChartController@update')->name('charts.update');
    Route::get('charts/{id}/delete', 'ChartController@destroy')->name('charts.destroy');
    Route::post('/charts/filter', 'ChartController@filter')->name('chart.filter');

    //Filters on charts/create
    Route::get('/admin/charts', 'ChartController@chartList')->name('charts.index'); //table country for filters
    Route::get('/charts/create', 'ChartController@index')->name('create.index'); //table country for filters
    Route::get('/getMainTopic/{id}', 'ChartController@getMainTopic')->name('getMainTopic');
    Route::get('/getSubtopic1/{id}', 'ChartController@getSubTopic1')->name('getSubTopic1');
    Route::get('/getSubtopic2/{id}', 'ChartController@getSubTopic2')->name('getSubTopic2');
    Route::get('/getSubtopic3/{id}', 'ChartController@getSubTopic3')->name('getSubTopic3');
    Route::get('/charts/create', 'ChartController@index')->name('create.chart'); //table tags

    Route::delete('/charts/delete-all', 'ChartController@deleteAll')->name('charts.delete-all');
    Route::get('/admin/charts/changeStatus/{id}', 'ChartController@changeStatus')->name('charts.changeStatus');

    Route::get('/papers', 'PapersController@index')->name('papers.index');
    Route::get('/papers/create', 'PapersController@create')->name('papers.create');
    // Route::get('/papers/create','PapersController@index')->name('create.papers');

    Route::get('/country/{id}/topics', 'TopicController@getTopicsByCountryId');
    Route::get('/topic/parent/{id}', 'TopicController@getTopicsByParentTopicId');

    Route::get('topics/{id}/countries', 'TopicController@getTopicsByCountry')->name('topics.countries');
    Route::get('/filter/tags/pappers', 'PapersController@filterTags')->name('filter.tags');
});
