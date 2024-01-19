<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskSummaryResource;

class SummaryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tasks = $request->user()->tasksSummary($request->period);

        return $tasks->mapToGroups(function ($item, $key) {
            return [
                ($item->is_completed ? 'completed' : 'uncompleted') => TaskSummaryResource::make($item)
            ];
        });
    }
}
