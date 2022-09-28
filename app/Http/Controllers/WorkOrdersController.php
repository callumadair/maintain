<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkOrdersController extends Controller
{
    public function index()
    {
        $work_orders = WorkOrder::all();

        return Inertia::render('WorkOrders/Index', [
            'work_orders' => $work_orders->map(function ($work_order) {
                return [
                    'id' => $work_order->id,
                    'requestee_id' => $work_order->requestee_id,
                    'approvee_id' => $work_order->approvee_id,
                    'description' => $work_order->description,
                    'date_wanted' => $work_order->date_wanted,
                    'total_materials' => $work_order->total_materials,
                    'total_labour' => $work_order->total_labour,
                    'total_cost' => $work_order->total_cost,
                ];
            }),
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(WorkOrder $workOrder)
    {
    }

    public function edit(WorkOrder $workOrder)
    {
    }

    public function update(Request $request, WorkOrder $workOrder)
    {
    }

    public function destroy(WorkOrder $workOrder)
    {
    }
}
