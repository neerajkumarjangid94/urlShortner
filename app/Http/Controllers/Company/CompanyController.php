<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use App\Models\ShortUrls;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //fetch all listing of companies.
    public function fetchCompanyListings(Request $request)
    {
        $companies = Company::latest()->paginate(5);


        $shortUrls = ShortUrls::with(['user', 'company'])
            ->when($request->company, function ($query) use ($request) {

                $query->whereHas('company', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->company . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view('company.companylistings', compact('companies',  'shortUrls'));
    }

    //create company form view.
    public function create()
    {
        return view('company.create');
    }


    //create new-company data.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Company::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('company.companylistings')
            ->with('success', 'Company created successfully.');
    }
}
