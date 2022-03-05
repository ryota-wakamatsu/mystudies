@extends('layouts.profile')
@section('title', 'Profileの編集')

@section('content')
   <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Profile編集</h2>
                     <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                            <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                            </ul>
                    @endif
                      <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-md-4">Gender</label>
                        <div class="col-md-10">
                            <select name='gender' value="{{ $profile_form->gender }}">
                              <option value='male'>男性</option>
                              <option value='female'>女性</option>
                              <option value='other'>その他</option>
                             </select>
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="hobby" rows="1">{{ $profile_form->hobby }}</textarea>
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-md-2">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="15">{{ $profile_form->introduction }}</textarea>
                        </div>
                    </div>
                     <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                     </div>
                </form>
                 <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->profilehistories != NULL)
                                @foreach ($profile_form->profilehistories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
              
            </div>
        </div>
    </div>

@endsection