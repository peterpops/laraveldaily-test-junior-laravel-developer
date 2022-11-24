<?php

namespace App\Http\Controllers\Companies;

use Spatie\Image\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\storeRequest;
use App\Http\Requests\Companies\updateRequest;
use App\Models\Companies;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function index()
    {
        // return inertia
        return Inertia::render('Companies/index', [
            'companies' => function () {
                return Companies::latest()->paginate(10);
            }
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Inertia
     */
    public function create()
    {
        // return inertia
        return Inertia::render(
            'Companies/create',
            []
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(storeRequest $storeRequest)
    {
        // validated inputs
        $validated = $storeRequest->validated();
        $validated = $validated['addForm'];

        // store logo
        if ($storeRequest->hasFile('addForm.logo')) {
            $logoFile = $storeRequest->file('addForm.logo');

            $validated['logo'] = $this->saveLogo($logoFile);
        } else {
            unset($validated['logo']);
        }

        // create new company
        Companies::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Inertia\Inertia
     */
    public function show($company_id)
    {
        return Inertia::render(
            'Companies/show',
            [
                // in first render, then on request only
                'company' => (function () use ($company_id) {
                    // get company
                    return Companies::with('employees')->findOrFail($company_id);
                }),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Int $company_id
     * @return \Inertia\Inertia
     */
    public function edit($company_id)
    {
        return Inertia::render(
            'Companies/edit',
            [
                // in first render, then on request only
                'company' => (function () use ($company_id) {
                    // get company
                    return Companies::findOrFail($company_id);
                }),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Int $company_id
     * @param  \App\Http\Requests\Companies\updateRequest $updateRequest
     * @return void
     */
    public function update($company_id, updateRequest $updateRequest)
    {
        // inputs
        $validated = $updateRequest->validated();
        $validated = $validated['editForm'];

        // get model
        $company = Companies::findOrFail($company_id);

        // store logo
        if ($updateRequest->hasFile('editForm.logo')) {
            $logoFile = $updateRequest->file('editForm.logo');

            $validated['logo'] = $this->saveLogo($logoFile);

            // destroy old logo
            $this->deleteLogo($company->logo);
        } else {
            unset($validated['logo']);
        }

        // update
        $company->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int $company_id
     * @return void
     */
    public function destroy($company_id)
    {
        $company = Companies::findOrFail($company_id);

        $company->delete();
    }


    private function deleteLogo($logofile): void
    {
        Storage::delete('public/logos/' . $logofile);
    }


    private function saveLogo($logoFile): mixed
    {
        $image = Image::load($logoFile->getRealPath());

        if (($image->getHeight() < 100) || ($image->getWidth() < 100)) {
            return back()->withErrors(['addForm.logo' => 'Logo must be bigger than 100 x 100px']);
        }

        $name = time() . '.' . $logoFile->extension();
        $image->width(100)->height(100)->save(Storage::path('public/logos/' . $name));

        return $name;
    }
}
