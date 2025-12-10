<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies.
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Companies/Index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        return Inertia::render('Companies/Form');
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by_id'] = auth()->id();
        $validated['updated_by_id'] = auth()->id();

        Company::create($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit(Company $company)
    {
        return Inertia::render('Companies/Form', [
            'company' => $company->only('id', 'type', 'name', 'notes'),
        ]);
    }

    /**
     * Update the specified company in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();
        $validated['updated_by_id'] = auth()->id();

        $company->update($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        $company->deleted_by_id = auth()->id();
        $company->save();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}

