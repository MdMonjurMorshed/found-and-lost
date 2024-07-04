
<?php
use App\Http\Controllers\UserAuth\UserLoginController;
use App\Http\Controllers\UserAuth\UserRegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\FoundItems;
use App\Models\LostItems;
Route::prefix('user')->group(function(){
    Route::get('/login',[UserLoginController::class,'showLoginForm'])->name('user.login');
    Route::post('user-login',[UserLoginController::class,'login'])->name('user.post.login');
    Route::post('logout',[UserLoginController::class, 'logout'])->name('user.logout');

    Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register');
    Route::post('user-register', [UserRegisterController::class, 'register'])->name('user.post.register');

    Route::get('dashboard', function () {
        if (Auth::guard('web')->check())
        {
            $founditems = FoundItems::where('return',false)->get();
            $lostitems = LostItems::where('return',false)->get();
            $categories = Category::all();
            
            return view('user.dashboard',['categories'=>$categories,'founditems'=>$founditems,'lostitems'=>$lostitems]);
                
        
            
        }
        return redirect(route('user.login'));
    })->name('user.mainpage');
});