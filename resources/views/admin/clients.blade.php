@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="top-header">
  <h1>Clients list</h1>
  <a href="{{ route('newClient') }}" class="btn btn-block btn-success">Add client</a>
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
  <p id="Message" style="color: green; padding: 15px 15px 0 15px;"></p>
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
      <thead>
        <tr>
        <th>ID</th>
        <th>Fullname</th>
        <th>Adress</th>
        <th>Company</th>
        <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($clients as $client)
          <tr id="{{ $client->id }}">
          <td>{{ $client->id }}</td>
          <td>{{ $client->fullname }}</td>
          <td>{{ $client->adress }}</td>
          <td>{{ $client->company->name }}</td>
          <td>
            <a href="{{ route('client', ['client' => $client->id]) }}" class="btn btn-block btn-warning">Edit</a>
            <form style="margin-top: 2px;" class="" action="{{ route('deleteClient', ['client' => $client->id]) }}" method="post" onsubmit="deleteClient(event, {{ $client->id }})">
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
{{ $clients->links() }}
</div>
</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
      function deleteClient(event, id) {
        event.preventDefault()
        const comfirmation = window.confirm("Are you sure you want to delete ?")
        if(comfirmation) {
          let url = event.target.action
          const formData = new FormData(event.target)
          const message = document.getElementById('Message')
          axios.post(url, formData)
           .then(() => {
             document.getElementById(id).remove()
             message.innerHTML = "Deleted"
           })
           .catch(err => {
             message.innerHTML = "Something went wrong"
           })
        }
      }
    </script>

    <script> console.log('Hi!'); </script>
@stop
