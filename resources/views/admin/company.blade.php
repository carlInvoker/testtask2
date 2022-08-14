@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Company data</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($company ?? false)
  <form class="" action="{{ route('updateCompany', ['company' => $company->id]) }}" method="post">
  @method('PUT')
@else
  <form class="" action="{{ route('addCompany') }}" method="post">
  @method('POST')
@endif
@csrf
  <label for="Name">Name</label>
  <input type="text" id="Name" name="name"  value="{{ $company->name ?? '' }}"  class="form-control form-control-border border-width-2" placeholder="Name">
  <label for="Adress">Adress</label>
  <input type="text" id="Adress" name="adress" value="{{ $company->adress ?? '' }}" class="form-control form-control-border border-width-2" placeholder="Adress">
  <label for="Description">Description</label>
  <textarea class="form-control" rows="3" id="Description" name="description" placeholder="Company Description...">{{ $company->description ?? '' }}</textarea>
  <button type="submit" class="btn btn-primary submit-btn">Submit</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
