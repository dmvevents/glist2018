@extends('app')

@section('title', '404')

@section('content')

<div class="container">
  @include('dashboard.parts.navbar')

  <div id="wrapper">
    @include('dashboard.parts.sidebar')
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Dashboard Modules -->
        @include('dashboard.parts.breadcrumbs')
        @include('dashboard.parts.404')

      </div> <!-- /.container-fluid -->
    </div> <!-- /.content-wrapper -->
  </div> <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  @include('dashboard.parts.scrolltobtm')

  <!-- Logout Modal-->
  @include('dashboard.parts.logout')
</div>

@endsection
