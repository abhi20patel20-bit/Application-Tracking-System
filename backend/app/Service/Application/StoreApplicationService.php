<?php

namespace App\Service\Application;

use App\Models\Application;

class StoreApplicationService
{
    public function execute(array $data)
    {
        $application = Application::create([
            ...$data,
            'user_id' => auth()->id(),
        ]);

        return $application;
    }
}
