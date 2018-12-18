@extends('app')

@section('title', 'Home')

@section('content')

  @if(\Session::has('error'))
  <div class=”alert alert-danger”>
  {{\Session::get('error')}}
  </div>
  @endif

  @include('front.parts.homeslider')
  @include('front.parts.body')
@endsection
