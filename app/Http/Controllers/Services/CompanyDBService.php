<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class CompanyDBService
{
    public function getCompanies() : Paginator
    {
        $companies =  Company::select('*')->orderBy('updated_at', 'desc')->simplePaginate(Config::get('pagination.mainPagination'));
        return $companies;
    }

    public function createCompany(array $data)
    {
        $company = Company::create($data);
        $company->save();
        return $company;
    }

    public function companiesNames() : Collection
    {
        $companies = Company::select("id", 'name')->get();
        return $companies;
    }


    public function updateCompany(array $validated, Company $company) : void
    {
        $company->update($validated);
        return;
    }

    public function deleteCompany(Company $company) : void
    {
        $company->delete();
        return;
    }
}
