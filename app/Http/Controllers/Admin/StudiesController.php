<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HelloRequest;
use Validator;
use App\Studies;
use App\History;
use Carbon\Carbon;

class StudiesController extends Controller
{
    // 
    public function add()
  {
      return view('admin.studies.create');
  }
    public function create(Request $request)
  {
    $validator = Validator::make($request->all(),[
       'title' => 'required',
       'body' => 'required',
       ]);
       if ($validator->fails()) {
         return redirect('admin/studies/create')
                       ->withErrors($validator)
                       ->withInput();
       }
      $studies = new Studies;
      $form = $request->all();

      // formに画像があれば、保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $studies->image_path = basename($path);
      } else {
          $studies->image_path = null;
      }

      unset($form['_token']);
      unset($form['image']);
      // データベースに保存する
      $studies->fill($form);
      $studies->save();
      
       
       return view('admin.studies.create');
  }
    public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Studies::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Studies::all();
      }
      return view('admin.studies.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

   // 以下を追記

  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $studies = Studies::find($request->id);
      if (empty($studies)) {
        abort(404);    
      }
      return view('admin.studies.edit', ['studies_form' => $studies]);
  }


  public function update(Request $request)
  {    
    
       $validator = Validator::make($request->all(),[
       'title' => 'required',
       'body' => 'required',
       ]);
       if ($validator->fails()) {
         return redirect('admin/studies/create')
                       ->withErrors($validator)
                       ->withInput();
       }
      // News Modelからデータを取得する
      $studies = Studies::find($request->id);
      // 送信されてきたフォームデータを格納する
      $studies_form = $request->all();
      if ($request->remove == 'true') {
          $studies_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $studies_form['image_path'] = basename($path);
      } else {
          $studies_form['image_path'] = $studies->image_path;
      }

      unset($studies_form['image']);
      unset($studies_form['remove']);
      unset($studies_form['_token']);
      // 該当するデータを上書きして保存する
      $studies->fill($studies_form)->save();
      
      // 以下を追記
      $history = new History;
      $history->studies_id = $studies->id;
      $history->edited_at = Carbon::now();
      $history->save();


      return redirect('admin/studies');
  }

  // 以下を追記　　
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $studies = Studies::find($request->id);
      // 削除する
      $studies->delete();
      return redirect('admin/studies/');
  }  


}

?>