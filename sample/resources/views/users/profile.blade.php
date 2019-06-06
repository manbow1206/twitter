@extends('layouts.app')

@section('content')
<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-mb-8">
        <div class="card">
          <div class="card-header " style="font-size: 25px">Profile</div>
          <div class="card-body">
            <dl style="border-color:#808080">
              <dt style="font-size: 20px">Name</dt>
              <dd>
                <div class="profbox border-bottom">{{ Auth::user()->name }}</div>
              </dd>
              <dt style="font-size: 20px">E-Mail Address</dt>
              <dd>
                <div class="profbox border-bottom">{{ Auth::user()->email }}</div>
              </dd>
              <dt style="font-size: 20px">Password</dt>
              <dd>
                <div class="profbox border-bottom">{{ Auth::user()->password }}</div>
              </dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>



@endsection
