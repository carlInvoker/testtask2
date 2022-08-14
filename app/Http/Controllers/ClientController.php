<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\IdRequest;

use App\Http\Controllers\Services\ClientDBService;
use App\Http\Controllers\Services\CompanyDBService;

class ClientController extends Controller
{
    protected $ClientDBService;
    protected $CompanyDBService;

    public function __construct(
      ClientDBService $ClientDBService,
      CompanyDBService $CompanyDBService
    ) {
      $this->ClientDBService = $ClientDBService;
      $this->CompanyDBService= $CompanyDBService;
    }


    public function getClients(Request $request) {
      $clients = $this->ClientDBService->getClients();
      return view('admin.clients', ['clients' => $clients]);
    }

    public function getApiClients(Request $request, int $id) {
      $clients = $this->ClientDBService->getApiClients($id);
      return response()->json($clients, 200);
    }

    public function getApiClientsCompanies(Request $request, int $id) {
      $companies = $this->ClientDBService->getApiClientsCompanies($id);
      return response()->json($companies, 200);
    }

    public function getClient(Client $client) {
      $companies = $this->CompanyDBService->companiesNames();
      return view('admin.client', ['client' => $client, 'companies' => $companies]);
    }

    public function clientPage(Request $request) {
      $companies = $this->CompanyDBService->companiesNames();
      return view('admin.client', ['companies' => $companies]);
    }

    public function addClient(StoreClientRequest $request) {
      $data = $request->validated();
      $client = $this->ClientDBService->createClient($data);
      return response()->json($client, 200);
    }

    public function updateClient(StoreClientRequest $request, Client $client) {
      $validated = $request->validated();
      $client = $this->ClientDBService->updateClient($validated, $client);
      return response()->json($client, 200);
    }

    public function deleteClient(Client $client) {
      $this->ClientDBService->deleteClient($client);
      return response()->json(['message' => ['Article deleted !']], 200);
    }
}
