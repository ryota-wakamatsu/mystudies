{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')
@section('title', 'Profileの登録')

@section('content')
   <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Profile新規作成</h2>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Gender</label>
                        <div class="col-md-10">
                            <select type="text" class="form-control" name="gender" value="{{ old('gender') }}">
                              <option value='male'>男性</option>
                              <option value='female'>女性</option>
                              <option value='other'>その他</option>
                             </select>
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="hobby" rows="1">{{ old('hobby') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="15">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                </div>
                </div>
               
               
            </div>
        </div>
    </div>
    </main>
    
@endsection