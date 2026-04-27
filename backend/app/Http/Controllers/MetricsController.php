<?php

namespace App\Http\Controllers;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
// use Prometheus\Storage\InMemory;
use Prometheus\Storage\Redis;

class MetricsController extends Controller
{
    public function index()
    {
        $adapter = new Redis([
            'host' => 'redis',
            'port' => 6379,
        ]);

        $registry = new CollectorRegistry($adapter);

        $counter = $registry->getOrRegisterCounter(
            'app',
            'requests_total',
            'Total HTTP Requests',
            ['method', 'endpoint']
        );

        $counter->inc([request()->method(), request()->path()]);

        $renderer = new RenderTextFormat();
        $result = $renderer->render($registry->getMetricFamilySamples());

        return response($result, 200)
            ->header('Content-Type', RenderTextFormat::MIME_TYPE);
    }
}
