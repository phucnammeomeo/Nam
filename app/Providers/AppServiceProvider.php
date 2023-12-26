<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Laravel\Passport\Passport;
use View;
use App\Models\Menu;
use App\Models\MenuItem;
use Cache;
use Session;

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
    public function boot()
    {
        Paginator::useBootstrap();
        Passport::routes();
        View::composer(['homepage.*', 'cart.*', 'product.*'], function ($view) {
            $cart = [];
            $cart['cart'] = Session::get('cart');
            $total = $quantity = 0;
            if (isset($cart['cart']) && is_array($cart['cart']) && count($cart['cart']) > 0) {
                foreach ($cart['cart'] as $k => $item) {
                    $total += $item['quantity'] * $item['price'];
                    $quantity += $item['quantity'];
                }
            }
            $cart['total'] = $total;
            $cart['quantity'] = $quantity;
            $view->with('cart', $cart);
        });
        $settingEmail = \App\Models\ConfigEmail::select('data')->where('id', 1)->first();
        $settingSocialLogin = \App\Models\CustomerSocial::select('config')->where('id', 1)->first();
        //cấu hình email ứng dụng
        if ($settingEmail) {
            $emailJson = json_decode($settingEmail->data, true);
            config(['mail.mailers.smtp.username' => !empty($emailJson) ? (!empty($emailJson[0]) ? $emailJson[0] : env('MAIL_USERNAME')) : env('MAIL_USERNAME'), 'mail.mailers.smtp.password' => !empty($emailJson) ? (!empty($emailJson[1]) ? $emailJson[1] : env('MAIL_USERNAME')) : env('MAIL_PASSWORD')]);
        }
        //cấu hình login facebook,google
        if ($settingSocialLogin) {
            $socialConfig = json_decode($settingSocialLogin->config, true);
            config([
                'services.facebook.client_id' => !empty($socialConfig['facebook']) ? (!empty($socialConfig['facebook']['client_id_facebook']) ? $socialConfig['facebook']['client_id_facebook'] : '') : '',
                'services.facebook.client_secret' => !empty($socialConfig['facebook']) ? (!empty($socialConfig['facebook']['client_secret_facebook']) ? $socialConfig['facebook']['client_secret_facebook'] : '') : '',
                'services.facebook.redirect' => !empty($socialConfig['facebook']) ? (!empty($socialConfig['facebook']['redirect_facebook']) ? url($socialConfig['facebook']['redirect_facebook']) : '') : '',
            ]);
            config([
                'services.google.client_id' => !empty($socialConfig['google']) ? (!empty($socialConfig['google']['client_id_google']) ? $socialConfig['google']['client_id_google'] : '') : '',
                'services.google.client_secret' => !empty($socialConfig['google']) ? (!empty($socialConfig['google']['client_secret_google']) ? $socialConfig['google']['client_secret_google'] : '') : '',
                'services.google.redirect' => !empty($socialConfig['google']) ? (!empty($socialConfig['google']['redirect_google']) ? url($socialConfig['google']['redirect_google']) : '') : '',
            ]);
        }
    }
}
