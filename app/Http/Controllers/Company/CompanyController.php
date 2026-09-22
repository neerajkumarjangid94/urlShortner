<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //fetch all listing of companies.
    public function fetchCompanyListings()
    {
        $companies = Company::latest()->get();

        return view('company.companylistings', compact('companies'));
    }
}
