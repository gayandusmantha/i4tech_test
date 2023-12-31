<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        try {
            $this->registerPolicies();
            $prmission = Permission::get()
                ->pluck('id', 'name')->toArray();
            Passport::tokensCan(
                $prmission
            );
            Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(24));
            Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        } catch (\Exception $e) {
           // dd($e);
          //  return $e;
        }
    }
}
