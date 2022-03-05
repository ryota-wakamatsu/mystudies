<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\YesRequest;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;
use Validator;


class ProfileController extends Controller
{
    //以下を追記
     public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
    
       $validator = Validator::make($request->all(),[
       'name' => 'required',
       'gender' => 'required',
       'hobby' => 'required',
      
       ]);
       if ($validator->fails()) {
         return redirect('admin/profile/create')
                       ->withErrors($validator)
                       ->withInput();
       }
       
       $profile = new Profile;
       $form = $request->all();


       unset($form['_token']);
       unset($form['image']);
       // データベースに保存する
       $profile->fill($form);
       $profile->save();

       return redirect('admin/profile/');
    }
    
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
       return view('admin.profile.edit', ['profile_form' => $profile]);

        
     
    }

    public function update(Request $request)
    {
         $validator = Validator::make($request->all(),[
       'name' => 'required',
       'gender' => 'required',
       'hobby' => 'required',
       'introduction' => 'required',
       ]);
       if ($validator->fails()) {
         return redirect('admin/profile/create')
                       ->withErrors($validator)
                       ->withInput();
       }
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      if ($request->remove == 'true') {
          $profile_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $profile_form['image_path'] = basename($path);
      } else {
          $profile_form['image_path'] = $profile->image_path;
      }

      unset($profile_form['image']);
      unset($profile_form['remove']);
      unset($profile_form['_token']);
      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
      // 以下を追記
      $history = new ProfileHistory;
      $history->profile_id = $profile->id;
      $history->edited_at = Carbon::now();
      $history->save();


      return redirect('admin/profile');
        
    }
    
      // 以下を追記
     public function delete(Request $request)
    {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }  
   
}