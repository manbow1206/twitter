@extends('layouts.app')

@section('content')

</div>
    <div class="container mt-4">
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $post->title }}
                </div>
                <div class="card-body">

                    <p class="card-text">
                      <!--NOTE: "nl2br(e..."は改行。str_limit()は第二引数で指定した長さに文字を切り詰める-->
                        {!! nl2br(e(str_limit($post->body, 200))) !!}
                    </p>

                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                      More!
                    </a>

                </div>
                <div class="card-footer">
                    <span class="mr-2">
                    <!--NOTE: postテーブルのcreated_atカラムを年、月、日を表示させる-->
                        Post Time {{ $post->created_at->format('Y.m.d') }}
                    </span>


                    <!--NOTE: commentが複数形か単数形かの判断-->
                    @if ($post->comments->count() < 2)
                    <span class="badge badge-pill badge-primary">
                            Comment {{ $post->comments->count() }}
                        </span>
                    @else
                    <span class="badge badge-pill badge-primary">
                            Comments {{ $post->comments->count() }}
                        </span>
                    @endif

                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mb-5">
          <!--NOTE: pagenateを表示するの為-->
          {{ $posts->links() }}
        </div>
    </div>
@endsection
