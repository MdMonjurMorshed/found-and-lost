<?php

namespace App\Http\Controllers\UserView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\FoundItems;
use App\Models\LostItems;
use App\Models\User;
use App\Models\Claim;
use App\Models\Report;
use App\Models\MessageSent;
use App\Models\ReturnItems;
use Carbon\Carbon;
use App\Events\MessageSentEvent;

class UserViewController extends Controller
{

    public function user_dashboard(Request $request)
    {
        
        $categories = Category::all();
        return view('user.dashboard',['categories'=>$categories]);
        
    }
    public function select_item(Request $request,$route)
    {
        session(['selected_item' => $route]);
        return redirect(route($route));
      
    }
    public function user_profile(Request $request)
    {
        if (Auth::guard('web')->check())
        {
            $categories = Category::all();
            return view('user.layout.profile',['categories'=>$categories]);
        }
        return redirect(route('user.login'));
        
      
    }

    public function found_items(Request $request)
    {
        if (Auth::guard('web')->check() )
        {
            $founditems = FoundItems::all();
            $categories = Category::all();
            return view('user.layout.found',['categories'=>$categories,'founditems'=>$founditems]);
        }
        return redirect(route('user.login'));
    }

    public function lost_items(Request $request)
    {
        if (Auth::guard('web')->check() )
        {
            $categories = Category::all();
            $lostitems = LostItems::all();
            return view('user.layout.lost',['lostitems'=>$lostitems,'categories'=>$categories]);
        }
        return redirect(route('user.login'));
    }

    public function returned_items(Request $request)
    {
        if (Auth::guard('web')->check() )
        {
            $categories = Category::all();
            $items_return =ReturnItems::all();
            $returned_item_count = $items_return->count();
            return view('user.layout.returned',['categories'=>$categories,'return_items'=>$items_return,'item_count'=>$returned_item_count]);
        }
        return redirect(route('user.login'));
    }

    public function post_found_items(Request $request)
    {
        if (Auth::guard('web')->check() )

        {
            $categories = Category::all();
            return view('user.layout.postFound',['categories'=>$categories]);
        }
        return redirect(route('user.login'));
    }
    public function lost_item_form(Request $request)
    {
        if (Auth::guard('web')->check() )

        {
            $categories = Category::all();
            return view('user.layout.postLost',['categories'=>$categories]);
        }
        return redirect(route('user.login'));

    }

    public function post_found_item(Request $request)
    {
        
        // $request->validate([
        //     'image'=>'required|mimes:jpg,jpeg,png,gif|max:2048'
        // ]);
        if ($request->has('image')){
            $file = $request->file('image');
            $image_name = time().'.'.$file->extension();
            $file->move(public_path('images/found-items/'),$image_name);
            
        }
        ;
        

        try{
            FoundItems::create([
                'user_id'=>Auth::id(),
                'title'=> $request->title,
                'found_date'=> $request->date,
                'location'=>$request->location,
                'description'=>$request->description,
                'image'=>$image_name ? "images/found-items/".$image_name : null,
                'category'=>$request->category


            ]);
            
            return redirect(route('user.mainpage'));

        }catch(\Exceprion $e){
            dd($e);
            return redirect()->back()->with('error',$e);
        }
    }


    public function lost_item_add(Request $request)
    {
        if ($request->has('image')){

            $file = $request->file('image');
            $image_name = time().'.'.$file->extension();   
            $file->move(public_path('images/lost-items/'),$image_name);
            

        }
        
        

        try {
            LostItems::create([
                'user_id'=> Auth::id(),
                'title'=> $request->title,
                'found_date'=> $request->date,
                'location'=>$request->location,
                'description'=>$request->description,
                'image'=>$image_name ? "images/lost-items/" . $image_name : null,
                'category'=>$request->category

            ]);
            
            
            return redirect(route('user.mainpage'));

            
        } catch (\Throwable $e) {
            return redirect()->back()->with('error',$e);
            
        }
    }


    public function found_item_details($id)
    {
        $founditem = FoundItems::find($id);
        $categories = Category::all();

        return view('user.layout.foundDetails',['founditem'=>$founditem,'categories'=>$categories]);
    }
    public function lost_item_details($id)
    {
        $lostitem = LostItems::find($id);
        $categories = Category::all();

        return view('user.layout.lostDetails',['lostitem'=>$lostitem,'categories'=>$categories]);
    }

    // return item details
    public function return_item_details($id){
        $returnitem = ReturnItems::find($id);
        $categories = Category::all();
        $return_to = json_decode($returnitem->return_to,true);
        $return_by = json_decode($returnitem->return_by,true);
        return view('user.layout.returnDetails',['returnitem'=>$returnitem,'categories'=>$categories,'return_to'=>$return_to,'return_by'=>$return_by]);
    }

    // user profile update

    public function user_porofile_edit_form($id)
    {
        $categories = Category::all();
        $user = User::find($id);
        
        return view('user.layout.profileEdit',['user'=>$user,'categories'=>$categories]);
    }


    public function user_profile_update(Request $request,$id)
    {
        // dd($request);
        if ($request->has('image')){
            
            $file = $request->file('image');
            $image_name = time().'.'.$file->extension();
            $file->move(public_path('images/user/'),$image_name); 
        }

        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_numner;
            $user->about = $request->about;
            $user->image = $image_name ? 'images/user/' .$image_name : null;
            $user->update();

            return redirect(route('user.mainpage'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
            
        }
        
        
        
    }

    // my listing

    public function my_listing(){
        $founditems = FoundItems::where('user_id',Auth::id())->get();
        $lostitems = LostItems::where('user_id',Auth::id())->get();
        $categories = Category::all();

        return view('user.layout.myListing',['founditems'=>$founditems,'lostitems'=>$lostitems,'categories'=>$categories]);
    }

    public function claim_item(Request $request, FoundItems $founditem)
    {
        // dd($founditem->found_date);
        $claim_item = Claim::where('user_id',Auth::id())->where('found_item_id',$founditem->id)->get();
        $categories = Category::all();

        if (!$claim_item->isEmpty()){
            return redirect(route('user.chatboxuser'));
        }
        

        
        
            $claim = Claim::create([
                    'claim_date'=> Carbon::today()->format('Y-m-d'),
                    'found_item_id'=> $founditem->id,
                    'found_item_date'=>$founditem->found_date,
                    'user_id'=>$request->user()->id
        
                ]);

            $message = MessageSent::create([
                          'sender_id' =>  $request->user()->id,
                          'receiver_id' => $founditem->user_id,
                          'topic' => json_encode([
                            'title'=>$founditem->title,
                            'image'=>$founditem->image,
                          ]),   
                          'claim_id' => $claim->id
            ]);
       
            return redirect(route('user.chatbox',['message_id'=>$message->id,'user_sender'=>$message->sender_id,'user_receiver'=>$message->receiver_id]));
        
        

    }


    // claim update

    public function update_claim_status($claim_id){
        $claim = Claim::find($claim_id);
        $claim->status = 1;
        $claim->save();

        return redirect()->back();
    }

    public function return_claimed_item(FoundItems $founditem){
       
       $claim = Claim::where('found_item_id',$founditem->id)->where('status',true)->first();
       $user_return_to = $claim->user;
       $user_return_by = $founditem->user;
       $return = ReturnItems::where('claim_id',$claim->id)->first();
       if ($return){
        return redirect()->back()->with('error',"You have already returned this item");
       }
       $create_return_item = ReturnItems::create([
            'title' => $founditem->title,
            'date' => $founditem->found_date,
            'image' => $founditem->image,
            'place' => $founditem->location,
            'category' => $founditem->category,
            'description' => $founditem->description, 
            'return_to' => json_encode([
                'user_name' => $user_return_to->name,
                'user_photo' => $user_return_to->image ? $user_return_to->image : null
            ]),
            'return_by' => json_encode([
                'user_name' => $user_return_by->name,
                'user_photo' => $user_return_by->image ? $user_return_by->image : null
            ]),
            'claim_id' => $claim->id
           ]);
           
           return redirect(route('user.returned'));
    
        
       
           }

    public function report_item(Request $request, LostItems $lostitem)
           {
               // dd($founditem->found_date);
               $report_item = Report::where('user_id',Auth::id())->where('lost_item_id',$lostitem->id)->get();
               $categories = Category::all();
       
               if (!$report_item->isEmpty()){
                   return redirect(route('user.chatboxuser'));
               }
               
       
               
               
                   $report = Report::create([
                           'report_date'=> Carbon::today()->format('Y-m-d'),
                           'lost_item_id'=> $lostitem->id,
                           'lost_item_date'=>$lostitem->found_date,
                           'user_id'=>$request->user()->id
               
                       ]);
       
                   $message = MessageSent::create([
                                 'sender_id' =>  $request->user()->id,
                                 'receiver_id' => $lostitem->user_id,
                                 'topic' => json_encode([
                                    'title'=>$lostitem->title,
                                    'image'=>$lostitem->image,
                                  ]),        
                                 'report_id' => $report->id
                   ]);
              
                   return redirect(route('user.chatbox',['message_id'=>$message->id,'user_sender'=>$message->sender_id,'user_receiver'=>$message->receiver_id]));
               
               
       
           } 
    
    public function verify_reporter($report_id){
        $report = Report::find($report_id);
        $report->status=1;
        $report->save();
        return redirect()->back();
    } 
    
    public function lost_item_returned(LostItems $lostitem){
        $report = Report::where('lost_item_id',$lostitem->id)->where('status',true)->first();
        $user_return_by = $report->user;
        $user_return_to = $lostitem->user;
        $return = ReturnItems::where('report_id',$report->id)->first();
        if ($return){
            return redirect()->back()->with('error'," You have already got this item back");
        }
        $return_lost_item = ReturnItems::create([
            'title' => $lostitem->title,
            'date' => $lostitem->found_date,
            'place' => $lostitem->location,
            'image' => $lostitem->image,
            'description' => $lostitem->description,
            'category' => $lostitem->category,
            'return_to' => json_encode([
                'user_name' => $user_return_to->name,
                'user_photo' => $user_return_to->image ? $user_return_to->image : null
            ]),
            'return_by' => json_encode([
                'user_name' => $user_return_by->name,
                'user_photo' => $user_return_by->image ? $user_return_by->image : null
            ]),
            'report_id' => $report->id
           

        ]);

        return redirect(route('user.returned'));

    }

    public function delete_mylisting($id){
        $founditem = FoundItems::find($id);
        $lostitem = LostItems::find($id);
        if ($founditem){
            $founditem->delete();
            return ['message'=>'item is deleted successfully '];
        }
        if ($lostitem){
            $lostitem->delete();
            return ['message'=>'item is deleted successfully '];
        }
    }

    public function cat_search($cat_name){
        $founditems = FoundItems::where('category',$cat_name)->get(); 
        $lostitems = LostItems::where('category',$cat_name)->get();
        $returnitems = ReturnItems::where('category',$cat_name)->get();

        return ['founditems'=>$founditems,'lostitems'=>$lostitems,'returnitems'=>$returnitems];

    }   
    
    public function box_search(Request $request){
        $value = $request->input('search');
        $founditems = FoundItems::all();
        $lostitems = LostItems::all();
        $returnitems = ReturnItems::all();
        if ($value){
            $founditems = FoundItems::where('title','Like',"%{$value}%")
        ->orWhere('location','Like',"%{$value}%")
        ->orWhere('found_date','Like',"%{$value}%")
        ->orWhere('category','Like',"%{$value}%")
        ->get();

        $lostitems = LostItems::where('title','Like',"%{$value}%")
        ->orWhere('location','Like',"%{$value}%")
        ->orWhere('found_date','Like',"%{$value}%")
        ->orWhere('category','Like',"%{$value}%")
        ->get();

        $returnitems = ReturnItems::where('title','Like',"%{$value}%")
        ->orWhere('place','Like',"%{$value}%")
        ->orWhere('date','Like',"%{$value}%")
        ->orWhere('category','Like',"%{$value}%")
        ->get();

        }
        

        return ['founditems'=>$founditems,'lostitems'=>$lostitems,'returnitems'=>$returnitems];
    }
    
}
