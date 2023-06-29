<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    CampaignController,
    EmailController,
    HomeController,
    SubscriberController,
    TrackerController,
    UserController,
};
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


Auth::routes(['verify' => true]);
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'login')->name('index');
    Route::get('/home', 'index')->name('home');
    Route::get('/register', 'index')->name('register');
    Route::get('/logout', 'logout')->name('logout');
});
// User Routes
Route::middleware('user')->as('user.')->controller(UserController::class)->group(function(){
    Route::get('/user', 'dashboard')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/setting', 'setting')->name('setting');
    Route::get('/profile', 'profile')->name('profile');
    Route::post('change-pin','change_pin')->name('change_pin');
    Route::post('profile','update_profile')->name('profile.update');
    Route::post('password','update_password')->name('password.update');
});
Route::middleware('admin')->as('admin.')->prefix('admin')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/', 'dashboard')->name('index');
        Route::get('/profile', 'profile')->name('profile');
        Route::post('profile','update_profile')->name('profile.update');
        // Domains
        Route::prefix('domains')->group(function(){
            Route::get('/', 'domains')->name('domains');
            Route::get('/create', 'create_domain')->name('domains.create');
            Route::get('/edit/{id}', 'edit_domain')->name('domains.edit');
            Route::get('/delete/{id}', 'delete_domain')->name('domains.delete');
            Route::post('/store', 'store_domain')->name('domains.store');
            Route::post('/update/{id}', 'update_domain')->name('domains.update');
        });

    });
    // Campaigns
    Route::controller(CampaignController::class)->prefix('campaigns')->group(function(){
        Route::get('/', 'campaigns')->name('campaigns');
        Route::get('/reports', 'campaigns_report')->name('campaigns.report');
        Route::get('/create', 'create_campaign')->name('campaigns.create');
        Route::get('/{code}/template', 'create_campaign_template')->name('campaigns.template');
        Route::post('/{code}/template', 'store_campaign_template')->name('campaigns.template');
        Route::get('/{code}/design', 'campaign_design')->name('campaigns.design');
        Route::post('/{code}/design', 'store_campaign_design')->name('campaigns.design');
        Route::get('/{code}/audience', 'campaign_audience')->name('campaigns.audience');
        Route::post('/{code}/audience', 'store_campaign_audience')->name('campaigns.audience');
        Route::get('/{code}/confirm', 'campaign_confirm')->name('campaigns.confirm');
        Route::post('/{code}/confirm', 'store_campaign_audience')->name('campaigns.confirm');

        Route::post('/{code}/sendtest', 'campaign_sendtest')->name('campaigns.sendtest');
        Route::get('/{code}/send', 'campaign_send')->name('campaigns.send');
        Route::get('/edit/{code}', 'edit_campaign')->name('campaigns.edit');
        Route::get('/delete/{id}', 'delete_campaign')->name('campaigns.delete');
        Route::post('/store', 'store_campaign')->name('campaigns.store');
        Route::post('/update/{id}', 'update_campaign')->name('campaigns.update');
    });
    // Templates
    Route::controller(CampaignController::class)->prefix('templates')->as('templates.')->group(function(){
        Route::get('/', 'templates')->name('index');
        Route::get('/create', 'create_template')->name('create');
        Route::post('/create', 'store_template')->name('create');
        Route::get('/edit/{slug}', 'edit_template')->name('edit');
        Route::post('/edit/{slug}', 'update_template')->name('edit');
        Route::get('/delete/{slug}', 'delete_template')->name('delete');
        Route::get('/preview/{id}', 'preview_template')->name('preview');

    });
    // Subscribers
    Route::controller(SubscriberController::class)->prefix('subscribers')->as('subscriber.')->group(function(){
        Route::get('/', 'subscribers')->name('index');
        Route::post('/create/', 'create_subscriber')->name('create');
        Route::post('/edit/{id}', 'edit_subscriber')->name('edit');
        Route::get('/del/{id}', 'delete_subscriber')->name('del');
        // Group
        Route::get('/groups', 'subscriber_groups')->name('groups');
        Route::post('/group/create', 'create_group')->name('groups.create');
        Route::get('/group/del/{id}', 'delete_group')->name('groups.delete');
        Route::post('/group/update/{id}', 'edit_group')->name('groups.edit');
        Route::get('/group/{code}', 'view_group')->name('groups.view');
        Route::get('/group/{code}/subscriber', 'add_group_subscriber')->name('groups.subscriber');
        Route::post('/group/{code}/subscriber', 'group_store_subscriber')->name('groups.subscriber');
        Route::get('/group/{code}/delsub/{id}', 'del_group_subscriber')->name('groups.subscriber.del');

        Route::get('/edit/{id}', 'edit_campaign')->name('campaigns.edit');
        Route::get('/delete/{id}', 'delete_campaign')->name('campaigns.delete');
        Route::post('/store', 'store_campaign')->name('campaigns.store');
        Route::post('/update/{id}', 'update_campaign')->name('campaigns.update');
    });

    Route::post('/email-test' , [EmailController::class, 'test_email'])->name('email.test');
    // Settings
    Route::controller(AdminController::class)->as('setting.')->prefix('settings')->group(function(){
        Route::get('/email' , 'email_settings')->name('email');
        Route::get('/' , 'settings')->name('index');

        Route::post('/update', 'update_settings')->name('update');
        Route::post('/system', 'systemUpdate')->name('sys_settings');
        Route::post('/system/store', 'store_settings')->name('store_settings');
        Route::post('env_key', 'envkeyUpdate')->name('env_key');
    });
});

Route::get('/tracker/emails/store', [TrackerController::class, 'store'])->name('tracker.emails.store'); // img src tracker
// Unsubscribe Link
Route::get('/campaign/subscribers/unsubscribe/{campaign_id}/{subscriber_id}', [CampaignController::class, 'contactsUnsubscribe'])->name('campaign.unsubscribe');
