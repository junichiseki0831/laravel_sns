@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">

    @include('users.user')

    <!-- includeメソッドでは第二引数に変数名とその値を連想配列形式で渡すことができる。show.blade.phpが呼ばれれば'hasArticles' => trueとなり記事一覧を表示 -->
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])

    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
  </div>
@endsection
