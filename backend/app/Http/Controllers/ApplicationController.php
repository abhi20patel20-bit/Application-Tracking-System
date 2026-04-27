<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\StoreApplicationRequest;
use App\Models\Application;
use App\Service\Application\IndexApplicationService;
use App\Service\Application\StoreApplicationService;
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
    public function index(Request $request, IndexApplicationService $service)
    {
        return $service->execute($request);
    }

    /**
     * Undocumented function
     *
     * @param StoreApplicationRequest $request
     * @return void
     */
    public function store(StoreApplicationRequest $request, StoreApplicationService $service)
    {
        return response()->json($service->execute($request->validated()), 201);
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
