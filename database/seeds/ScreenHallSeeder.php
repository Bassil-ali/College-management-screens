<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreenHallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $halls = DB::table('schedules')->distinct()->select('hall')->get();
		if($halls->count() > 0) {
			foreach(App\Screen::all() as $screen) {
				$screen->hall = $halls[$screen->id]->hall; $screen->save();
			}	
		}        
    }
}
