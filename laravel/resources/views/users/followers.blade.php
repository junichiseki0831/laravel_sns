@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])
    @foreach($followers as $person)
      <!-- フォワーの人数分person.bladeを表示 -->
      @include('users.person')
    @endforeach
  </div>
@endsection