
<?php
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\AdminAuth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\FoundItems;
use App\Models\LostItems;

Route::prefix('admin')->group(function(){
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('admin-login',[LoginController::class,'login'])->name('admin.post.login');
    Route::post('logout',[LoginController::class,'logout'])->name('admin.logout');

    Route::get('/register',[RegisterController::class,'showRegisterForm'])->name('admin.register');
    Route::post('admin-register',[RegisterController::class, 'register'])->middleware('admin.check')->name('admin.post.register');

    Route::get('dashboard', function () {
        if (Auth::guard('admin')->check())
        {
            $categories = Category::all();
            $founditems = FoundItems::all();
            $lostitems = LostItems::all();
            return view('admin.layout.dashboard',['categories'=>$categories,'founditems'=>$founditems,'lostitems'=>$lostitems]);
        }
        return redirect(route('user.login'));
    })->name('admin.mainpage');

});