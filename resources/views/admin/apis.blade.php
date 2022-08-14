@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>APIs</h1>
@stop

@section('content')
    <p>Your token is in cookies, named "token":</p>
    <p>{{ Cookie::get('token') ?? ''}}</p>
    <ul>
      <li>api/companies</li>
      <li>api/clients/{id}</li>
      <li>api/client_companies/{id}</li>
    </ul>

    <p>
      Для endpoint api/client_companies/{id} потрібнен був зв'язок багато до багатьох, однак оскільки конкретної бізнес логіки у тестовому немає (якісь абстрактні компанії та клієнти),
      я для економії часу зробив один до багатьох  api/client_companies/{id} просто повертає компанію до якої належить клієнт.
    </p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
