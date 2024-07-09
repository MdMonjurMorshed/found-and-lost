<?php

namespace App\Http\Controllers\AdminView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Admin;
use App\Models\FoundItems;
use App\Models\LostItems;
use App\Models\ReturnItems;

class AdminViewController extends Controller
{
   public function admin_profile(Request $request)
   {
      if (Auth::guard('admin')->check())
      {
        $categories = Category::all();

        return view('admin.layout.profile',['categories'=>$categories]);
      }
      return redirect(route('user.login'));
   }

   public function found_items(Request $request)
    {
        if (Auth::guard('admin')->check() )
        {
            $categories = Category::all();
            $founditems = FoundItems::where('return',false)->get();
            return view('admin.layout.found',['categories'=>$categories,'founditems'=>$founditems]);
        }
        return redirect(route('user.login'));
    }

    public function lost_items(Request $request)
    {
        if (Auth::guard('admin')->check() )
        {
            $categories = Category::all();
            $lostitems = LostItems::where('return',false)->get();
            return view('admin.layout.lost',['categories'=>$categories,'lostitems'=>$lostitems]);
        }
        return redirect(route('user.login'));
    }

    public function returned_items(Request $request)
    {
        if (Auth::guard('admin')->check() )
        {
            $returneditems = ReturnItems::all();
            $item_count = $returneditems->count();
            $categories = Category::all();
            return view('admin.layout.returned',['returneditems'=>$returneditems,'item_count'=>$item_count,'categories'=>$categories]);
        }
        return redirect(route('user.login'));
    }

    public function create_category(Request $request)
    {
            
        try {
            

            Category::create([
                'name' => $request->category
                
            ]);
    
            return redirect(route('admin.mainpage'));
        } catch (\Exception $e) {
            return redirect()->back()->withError(['error'=>$e]);
        }
            
        
        
    }

    public function get_profile_form($id){
        $user = Admin::find($id);
        $categories = Category::all();
        return view('admin.layout.profileEdit',['user'=>$user,'categories'=>$categories]);
    }

    public function user_profile_update(Request $request,$id)
    {
        // dd($request);
        $image_name = null;
        if ($request->has('image')){
            
            $file = $request->file('image');
            $image_name = time().'.'.$file->extension();
            $file->move(public_path('images/admin/'),$image_name); 
        }

        try {
            $user = Admin::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_numner;
            $user->about = $request->about;
            $user->image = $image_name ? 'images/admin/' .$image_name : null;
            $user->update();

            return redirect(route('admin.mainpage'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
            
        }
        
        
        
    }

    public function category_delete($id){
        $category = Category::find($id);
        $category->delete();
        return ['message'=>'successfully deleted'];
    }

    public function found_item_details($id){
        $founditem = FoundItems::find($id);
        $categories = Category::all();
        return view('admin.layout.foundDetails',['founditem'=>$founditem,'categories'=>$categories]);
    }

    public function lost_item_details($id){
        $lostitem = LostItems::find($id);
        $categories = Category::all();
        return view('admin.layout.lostDetails',['lostitem'=>$lostitem,'categories'=>$categories]);
    }

    public function manage_found(){
        $founditems = FoundItems::all();
        $categories = Category::all();
        return view('admin.layout.manageFound',['categories'=>$categories,'founditems'=>$founditems]);

    }
    public function edit_found_item($id){
        $founditem = FoundItems::find($id);
        $categories = Category::all();
        return view('admin.layout.foundEdit',['categories'=>$categories,'founditem'=>$founditem]);
    }

    public function found_item_update(Request $request,$id){
        $image_name = null;
        if ($request->has('image')){
            $file = $request->file('image');
            $image_name = time().'.'.$file->extension();
            $file->move(public_path('images/found-items/'),$image_name);
            
        }
        $founditem = FoundItems::find($id);
        $founditem->title = $request->title;
        $founditem->found_date = $request->date;
        $founditem->location = $request->location;
        $founditem->description = $request->description;
        $founditem->image = $image_name? "images/found-items/" .$image_name : $founditem->image;
        $founditem->save();
        
        return redirect(route('admin.found.details',['id'=>$founditem->id]));

    }

    public function found_delete($id){
        $founditem = FoundItems::find($id);
        $founditem->delete();
        return ['message'=>'found item deleted successfully'];
    }

    public function manage_lost(){
        $lostitems = LostItems::all();
        $categories = Category::all();
        return view('admin.layout.manageLost',['categories'=>$categories,'lostitems'=>$lostitems]);


    }
    public function edit_lost_item($id){
        $lostitem = LostItems::find($id);
        $categories = Category::all();
        return view('admin.layout.lostEdit',['lostitem'=>$lostitem,'categories'=>$categories]);
    }
    
    public function lost_item_update(Request $request,$id){
        $image_name = null;
        if($request->has('image')){
            $file = $request->file('image');
            $image_name = time().".".$file->extension();
            $file->move(public_path('images/lost-items/'),$image_name);
        }

        $lostitem = LostItems::find($id);
        $lostitem->title = $request->title;
        $lostitem->found_date = $request->date;
        $lostitem->location = $request->location;
        $lostitem->description = $request->description;
        $lostitem->image = $image_name? "images/lost-items/" .$image_name : $lostitem->image;
        $lostitem->save();

        return redirect(route('admin.lost.details',['id'=>$lostitem->id]));

        
    }

    public function delete_lostitem($id){
        $lostitem = LostItems::find($id);
        $lostitem->delete();
        return ['message'=> 'lost item deleted successfully'];
    }

    public function return_items(){
        $returneditems = ReturnItems::all();
        $item_count = $returneditems->count();
        $categories = Category::all();

        return view('admin.layout.returned',['returneditems'=>$returneditems,'item_count'=>$item_count,'categories'=>$categories]);
        

    }


    public function return_item_details($id){
        $returnitem = ReturnItems::find($id);
        $categories = Category::all();
        $return_to = json_decode($returnitem->return_to,true);
        $return_by = json_decode($returnitem->return_by,true);
        return view('admin.layout.returnedDetails',['returnitem'=>$returnitem,'categories'=>$categories,'return_to'=>$return_to,'return_by'=>$return_by]);
    }

    public function return_delete($id){
        $returnitem = ReturnItems::find($id);
        $returnitem->delete();
        return ['message'=>'returned item deleted successfully'];
    }

    public function box_search(Request $request){
        $value = $request->input('search');
        $founditems = FoundItems::where('return',false)->get();
        $lostitems = LostItems::where('return',false)->get();
        $returnitems = ReturnItems::all();
        if ($value){
            $founditems = FoundItems::where('return', false)
            ->where(function ($query) use ($value) {
                $query->where('title', 'Like', "%{$value}%")
                    ->orWhere('location', 'Like', "%{$value}%")
                    ->orWhere('found_date', 'Like', "%{$value}%")
                    ->orWhere('category', 'Like', "%{$value}%");
            })
            ->get();

        $lostitems = LostItems::where('return', false)
        ->where(function ($query) use ($value){

        $query-> where('title','Like',"%{$value}%")
        ->orWhere('location','Like',"%{$value}%")
        ->orWhere('found_date','Like',"%{$value}%")
        ->orWhere('category','Like',"%{$value}%");
        })
       
        ->get();

        $returnitems = ReturnItems::where('title','Like',"%{$value}%")
        ->orWhere('place','Like',"%{$value}%")
        ->orWhere('date','Like',"%{$value}%")
        ->orWhere('category','Like',"%{$value}%")
        ->get();

        }
        

        return ['founditems'=>$founditems,'lostitems'=>$lostitems,'returnitems'=>$returnitems];
    }

    public function cat_search($cat_name){
        $founditems = FoundItems::where('category',$cat_name)->where('return',false)->get(); 
        $lostitems = LostItems::where('category',$cat_name)->where('return',false)->get();
        $returnitems = ReturnItems::where('category',$cat_name)->get();

        return ['founditems'=>$founditems,'lostitems'=>$lostitems,'returnitems'=>$returnitems];

    }



}
