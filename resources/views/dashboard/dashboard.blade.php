@extends('dashboard.dash_app')

@section('title', 'Dashboard')

@section('content')


  @include('dashboard.parts.navbar')

  <div id="wrapper">
    @include('dashboard.parts.sidebar')
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Dashboard Modules -->
        @include('dashboard.parts.breadcrumbs')
        @include('dashboard.parts.iconcards')
        @include('dashboard.parts.areachart')
        @include('dashboard.parts.datatables')
      </div> <!-- /.container-fluid -->
      @include('dashboard.parts.footer')

    </div> <!-- /.content-wrapper -->
  </div> <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  @include('dashboard.parts.scrolltobtm')

  <!-- Logout Modal-->
  @include('dashboard.parts.logout')

@endsection
