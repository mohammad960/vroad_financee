<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use auth;
use DB;
use App\Models\role;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
		\Gate::define('manager', function () {
			$user=Auth::user();
			$r=role::find($user->role_id);
			if ($r->name != 'superAdmin') {
					return true;
			}
		return false;
		});
		
		
		\Gate::define('admin', function () {
			$user=Auth::user();
			$r=role::find($user->role_id);
			if ($r->name == 'superAdmin') {
					return true;
			}
		return false;
		});
		$events->listen(BuildingMenu::class, function (BuildingMenu $event) {
			
			$note = DB::select("SELECT * FROM messages where status ='not show' and to_user=".Auth::user()->id);
			$arr=array();
			$i=0;
			foreach($note as $n){
				
				  $arr[$i]=[
				  'text' => $n->text,
				 'url'=>'message/change/'.$n->id,
				 'icon' => 'fa fa-bell',
					
				  ];
				   $i=$i+1;
			}
			$event->menu->add([
				'text'=>'',
                'icon'        => 'fas fa-bell',
                'label'       => count($arr),
				
				 'topnav_right' => true,
                'label_color' => 'danger',
				
				'submenu' => $arr
		
				
            ]);
	});

        //
    }
}
