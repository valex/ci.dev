<?php namespace App\Http\Controllers;

use App\CI\Api\Lastfm;
use App\CI\Helpers\DistanceHelper;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function lastfm(){

		//https://github.com/SciDevs/delicious-api/blob/master/api/posts.md#v1postsget
		$lastfm = new Lastfm();

		$userDict  = $lastfm->initializeUserDict('russia');

		var_dump($userDict);

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function recomendation(DistanceHelper $distanceHelper)
	{

		$critics = [
			'Lisa Rose' => [
				'Lady in the Water' => 2.5,
				'Snakes on a Plane' => 3.5,
				'Just My Luck' => 3.0,
				'Superman Returns' => 3.5,
				'You, Me and Dupree' => 2.5,
				'The Night Listener' => 3.0
			],
			'Gene Seymour' => [
				'Lady in the Water' => 3.0,
				'Snakes on a Plane' => 3.5,
				'Just My Luck' => 1.5,
				'Superman Returns' => 5.0,
				'The Night Listener' => 3.0,
				'You, Me and Dupree' => 3.5
			],
			'Michael Phillips' => [
				'Lady in the Water' => 2.5,
				'Snakes on a Plane' => 3.0,
				'Superman Returns' => 3.5,
				'The Night Listener' => 4.0,
			],
			'Claudia Puig' => [
				'Snakes on a Plane' => 3.5,
				'Just My Luck' => 3.0,
				'The Night Listener' => 4.5,
				'Superman Returns' => 4.0,
				'You, Me and Dupree' => 2.5
			],
			'Mick LaSalle' => [
				'Lady in the Water' => 3.0,
				'Snakes on a Plane' => 4.0,
				'Just My Luck' => 2.0,
				'Superman Returns' => 3.0,
				'The Night Listener' => 3.0,
				'You, Me and Dupree' => 2.0
			],
			'Jack Matthews' => [
				'Lady in the Water' => 3.0,
				'Snakes on a Plane' => 4.0,
				'The Night Listener' => 3.0,
				'Superman Returns' => 5.0,
				'You, Me and Dupree' => 3.5
			],
			'Toby' => [
				'Snakes on a Plane' => 4.5,
				'You, Me and Dupree' => 1.0,
				'Superman Returns' =>4.0,
			],
			'Versh' => [
				'Lady in the Water' => 3.0,
				'Just My Luck' => 1.5,
				'The Night Listener' => 3.0,
			],
		];

		$movies = $distanceHelper->transformPrefs($critics);

		//var_dump($distanceHelper->topMatches($movies,'Superman Returns'));
		var_dump($distanceHelper->getRecommendations($movies,'Just My Luck'));

		//echo $distanceHelper->sim_pearson($critics, 'Toby', 'Versh').' - '.$distanceHelper->sim_distance($critics, 'Toby', 'Versh').'<br>';

		//var_dump($distanceHelper->getRecommendations($critics, 'Toby', 'sim_pearson'));

		//var_dump($distanceHelper->topMatches($critics, 'Toby', 9, 'sim_pearson'));

		/*
		var_dump($distanceHelper->sim_pearson($critics, 'Toby', 'Versh'));
		var_dump($distanceHelper->sim_pearson($critics, 'Toby', 'Jack Matthews'));
		var_dump($distanceHelper->sim_pearson($critics, 'Toby', 'Toby'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Gene Seymour'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Michael Phillips'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Claudia Puig'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Mick LaSalle'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Jack Matthews'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Toby'));
		var_dump($distanceHelper->sim_pearson($critics, 'Lisa Rose', 'Versh'));
		var_dump($distanceHelper->sim_pearson($critics, 'Gene Seymour', 'Versh'));

		echo "<hr>";

		var_dump($distanceHelper->sim_distance($critics, 'Toby', 'Versh'));
		var_dump($distanceHelper->sim_distance($critics, 'Toby', 'Jack Matthews'));
		var_dump($distanceHelper->sim_distance($critics, 'Toby', 'Toby'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Gene Seymour'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Michael Phillips'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Claudia Puig'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Mick LaSalle'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Jack Matthews'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Toby'));
		var_dump($distanceHelper->sim_distance($critics, 'Lisa Rose', 'Versh'));
		*/

		return view('home');
	}

}
