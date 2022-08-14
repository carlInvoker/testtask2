@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Client data</h1>
@stop

@section('content')
<div class="alert alert-danger d-none" id="ErrorsBlock">
    <ul>
      <li id="Errors"></li>
    </ul>
</div>
<p id="Message" style="color: green; font-weight: 600;"></p>
@if ($client ?? false)
  <form id="ClientForm" action="{{ route('updateClient', ['client' => $client->id]) }}" onsubmit="submitForm(event)">
  <input type="hidden" name="_method" value="PUT" id="Method">
@else
  <form id="ClientForm" action="{{ route('addClient') }}" onsubmit="submitForm(event)">
  <input type="hidden" name="" value="POST" id="Method">
@endif
  @csrf
  <label for="Fullname">Fullname</label>
  <input type="text" id="Fullname" name="fullname" value="{{ $client->fullname ?? '' }}" class="form-control form-control-border border-width-2" placeholder="Fullname">
  <label for="Adress">Adress</label>
  <input type="text" id="Adress" name="adress" value="{{ $client->adress ?? '' }}" class="form-control form-control-border border-width-2" placeholder="Adress">
  <label for="Company">Client's Company:</label>
  <select style="width:100%; min-height: 20px;" class="custom-select form-control-border border-width-2 client-select" value="" id="Company" name="company_id">
      @foreach ($companies as $company)
        <option value="{{ $company->id }}">{{ $company->name }}</option>
      @endforeach
  </select>
  <button type="submit" class="btn btn-primary submit-btn">Submit</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      $(document).ready(function() {
        document.getElementById("Company").value = "{{ $client->company_id ?? '' }}"
        console.log('works')
      })
    </script>
    <script>


      function submitForm(event) {
        event.preventDefault()
        let form = document.getElementById('ClientForm')
        const formData = new FormData(form)
        let url = form.action
        const message = document.getElementById('Message')
        const errors = document.getElementById("Errors")
        const errorsBlock = document.getElementById("ErrorsBlock")
        if(document.getElementById('Method').value === "PUT") {
          axios.post(url, formData)
           .then(() => {
             message.innerHTML = "Client updated"
             errors.innerHTML = ''
             errorsBlock.classList.add('d-none')
           })
           .catch(err => {
              errors.innerHTML = JSON.stringify(err.response.data.errors)
              errorsBlock.classList.toggle('d-none')
           })
        }
        else {
          axios.post(url, formData)
           .then(() => {
             message.innerHTML = "New Client Added"
             errors.innerHTML = ''
             errorsBlock.classList.add('d-none')
           })
           .catch(err => {
              errorsBlock.classList.toggle('d-none')
              errors.innerHTML = JSON.stringify(err.response.data.errors)
           })
         }
      }
    </script>
@stop
