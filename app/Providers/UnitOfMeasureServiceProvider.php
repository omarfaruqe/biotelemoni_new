<?php namespace Sugar\Providers;

use Illuminate\Support\ServiceProvider;
use \Mass;
use \Volume;
use PhpUnitsOfMeasure\UnitOfMeasure;

class UnitOfMeasureServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 * @return void
	 */
	public function boot()
	{
		// $tbsp = UnitOfMeasure::linearUnitFactory('tbsp', '1.4787e-5');
		// $tbsp->addAlias('tablespoon');
		// $tbsp->addAlias('tablespoons');
		// Volume::addUnit($tbsp);

		// $tsp = UnitOfMeasure::linearUnitFactory('tsp', '4.9289e-6');
		// $tsp->addAlias('teaspoon');
		// $tsp->addAlias('teaspoons');
		// Volume::addUnit($tsp);
	}

	public function register(){}
}
