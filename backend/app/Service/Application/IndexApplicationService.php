<?php

namespace App\Service\Application;

use App\Models\Application;
use Illuminate\Http\Request;

class IndexApplicationService
{
    public function execute(Request $request)
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
}
