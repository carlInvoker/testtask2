<?php

namespace App\Http\Controllers\Services;

use App\Models\Client;
// use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

class ClientDBService
{
  public function getClients() : Paginator
  {
      $clients =  Client::orderBy('updated_at', 'desc')->with('company:id,name')->simplePaginate(Config::get('pagination.mainPagination'));
      return $clients;
  }

  public function getApiClients(int $id) : Paginator
  {
      $clients = Client::select('*')->where('company_id', $id)->simplePaginate(Config::get('pagination.mainPagination'));
      return $clients;
  }

  public function getApiClientsCompanies(int $id) : Paginator {
    $companies =  Client::orderBy('updated_at', 'desc')->where('id', $id)->with('company')->simplePaginate(Config::get('pagination.mainPagination'));
    return $companies;
  }

  public function createClient(array $data)
  {
      $client = Client::create($data);
      $client->save();
      return $client;
  }

  public function updateClient(array $validated, Client $client)
  {
      $client->update($validated);
      return $client;
  }

  public function deleteClient(Client $client) : void
  {
      $client->delete();
      return;
  }

}
