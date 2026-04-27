<?php

namespace App\Http\Middleware;

use Closure;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\Redis;

class MetricsMiddleware
{
    public function handle($request, Closure $next)
    {
        $adapter = new Redis([
            'host' => 'redis',
            'port' => 6379,
        ]);

        $registry = new CollectorRegistry($adapter);

        $counter = $registry->getOrRegisterCounter(
            'app',
            'http_requests_total',
            'Total HTTP Requests',
            ['method', 'endpoint', 'status']
        );

        $start = microtime(true);

        $response = $next($request);

        $duration = microtime(true) - $start;

        $histogram = $registry->getOrRegisterHistogram(
            'app',
            'http_request_duration_seconds',
            'Request duration in seconds',
            ['endpoint'],
            [0.1, 0.3, 0.5, 1, 2, 5]
        );

        $histogram->observe($duration, [$request->path()]);

        $counter->inc([
            $request->method(),
            $request->path(),
            $response->getStatusCode()
        ]);

        return $response;
    }
}
