<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //fetch all listing of companies.
    public function fetchCompanyListings()
    {
        $companies = Company::latest()->paginate(8);
        $users = User::where('role_id','!=', Role::SUPER_ADMIN_ID)->latest()->paginate(8);

        return view('company.companylistings', compact('companies', 'users'));
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
