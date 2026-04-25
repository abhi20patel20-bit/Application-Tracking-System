<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\StoreApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    const STATUS_APPLIED = 'applied';
    const STATUS_INTERVIEW = 'interview';
    const STATUS_OFFER = 'offer';
    const STATUS_REJECTED = 'rejected';

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $query = Application::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->company_name) {
            $query->where('company_name', 'like', "%{$request->company_name}%");
        }

        return $query->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param StoreApplicationRequest $request
     * @return void
     */
    public function store(StoreApplicationRequest $request)
    {
        return Application::create($request->all());
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Application $application
     * @return void
     */
    public function update(Request $request, Application $application)
    {
        $application->update($request->all());
        return $application;
    }

    /**
     * Undocumented function
     *
     * @param Application $application
     * @return void
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return response()->noContent();
    }
}
