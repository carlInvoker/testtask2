<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;

use App\Http\Controllers\Services\CompanyDBService;

class CompanyController extends Controller
{
      protected $CompanyDBService;

      public function __construct(
        CompanyDBService $CompanyDBService
      ) {
        $this->CompanyDBService = $CompanyDBService;
      }


      public function getCompanies(Request $request) {
        $companies = $this->CompanyDBService->getCompanies();
        return view('admin.companies', ['companies' => $companies]);
      }

      public function getApiCompanies(Request $request) {
        $companies = $this->CompanyDBService->getCompanies();
        return response()->json($companies, 200);
      }

      public function getCompany(Company $company) {
        return view('admin.company', ['company' => $company]);
      }

      public function addCompany(StoreCompanyRequest $request) {
        $data = $request->validated();
        $company = $this->CompanyDBService->createCompany($data);
        return redirect()->route('companies')->with('message', "Company Has been added !");
      }

      public function updateCompany(StoreCompanyRequest $request, Company $company) {
        $validated = $request->validated();
        $this->CompanyDBService->updateCompany($validated, $company);
        return redirect()->route('companies')->with('message', "Company Has been modified !");
      }

      public function deleteCompany(Company $company) {
        $this->CompanyDBService->deleteCompany($company);
        return redirect()->route('companies')->with('message', "Company Has been deleted !");
      }
}
