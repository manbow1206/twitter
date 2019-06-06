@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" id="infinite-scroll">


            @if ($userDate != null)
            <div class="card">
                <div class="card-header" style="font-size: 25px">Friends</div>
                @foreach ($userDate as $user)
                    <div class="card-body">

                        {{$user->name}}

                        <div style="float:right">
                                @if (Auth::user()->FollowingCheck($user->id))
                                {!! Form::open(['id' => 'formTweet', 'url' => '/follow/delete', 'enctype' => 'multipart/form-data']) !!}
                                    {{Form::hidden('followId', $user->id, ['id' => 'followId','name' => 'follow'])}}
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Following!') }}
                                    </button>
                                {!! Form::close() !!}

                                @else

                                {!! Form::open(['id' => 'formTweet', 'url' => '/follow/create', 'enctype' => 'multipart/form-data']) !!}
                                    {{Form::hidden('followId', $user->id, ['id' => 'followId','name' => 'follow'])}}
                                    <button type="submit" class="btn btn-light">
                                        {{ __('Follow!') }}
                                    </button>
                                {!! Form::close() !!}

                                @endif
                        </div>

                  </div>

                    <hr>

                @endforeach

                {{ $userDate->links() }}

            </div>

            @else

            <div class="card">
              <div class="card-body">
                <h1>ユーザーはいません</h1>
              </div>
            </div>

            @endif

        </div>
    </div>
</div>
@endsection
