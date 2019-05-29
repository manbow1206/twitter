@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" id="infinite-scroll">

            @if ($userDate != null)

            <div class="card">
                <div class="card-header">ユーザ一覧</div>

                @foreach ($userDate as $user)

                    <div class="card-body">
                        {{$user->name}}
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
