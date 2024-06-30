<?php
use Modules\Common\Controllers\Admin\{
    AdminController,
    LanguagesController,
    NotificationController,
    SettingsController,
};

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/', [AdminController::class,'home'])->name('home');
    Route::get('/loading', [AdminController::class,'load'])->name('load');

    Route::get('translations', [LanguagesController::class,'index'])->name('translations');
    Route::get('editWords/{slug}', [LanguagesController::class,'editWords'])->name('translations.editWords');
    Route::post('trans-lang', [LanguagesController::class,'transInput'])->name('translations.transInput');

    Route::any('notifications/{id?}', [NotificationController::class,'notifications'])->name('notifications');
    Route::delete('notifications/{id}/delete', [NotificationController::class,'notifications_delete'])->name('notifications.destroy');

    Route::match(['get', 'post'], 'home', [SettingsController::class,'home'])->name('settings.home');
    Route::match(['get', 'post'], 'settings', [SettingsController::class,'settings'])->name('settings.settings');
    Route::match(['get', 'post'], 'app_links', [SettingsController::class,'app_links'])->name('settings.app_links');
    Route::match(['get', 'post'], 'contacts', [SettingsController::class,'contacts'])->name('settings.contacts');
    Route::get('remove_contact', [SettingsController::class,'remove_contact'])->name('settings.remove_contact');
    Route::match(['get', 'post'], 'messages', [SettingsController::class,'messages'])->name('settings.messages');
});
