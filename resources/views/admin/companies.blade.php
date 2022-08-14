@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="top-header">
  <h1>Companies list</h1>
  <a href="{{ route('newCompany') }}" class="btn btn-block btn-success">Add company</a>
</div>
@stop

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Responsive Hover Table</h3>
    <div class="card-tools">

    </div>
  </div>
  <p style="color: green; padding: 15px 15px 0 15px;">{!! \Session::get('message') ?? '' !!}</p>
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
      <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Adress</th>
        <th>Description</th>
        <th>Actions</th>
        </tr>
      </thead>
      <tbody>

      @foreach ($companies as $company)
        <tr>
        <td>{{ $company->id }}</td>
        <td>{{ $company->name }}</td>
        <td class="adress">{{ $company->adress }}</td>
        <td class="description">{{ $company->description }}</td>
        <td>
          <a href="{{ route('company', ['company' => $company->id]) }}" class="btn btn-block btn-warning">Edit</a>
          <form style="margin-top: 2px;" class="" action="{{ route('deleteCompany', ['company' => $company->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-block btn-danger">Delete</button>
          </form>
        </td>
        </tr>
     @endforeach

      </tbody>
      </table>
  </div>
</div>
{{ $companies->links() }}
</div>
</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
