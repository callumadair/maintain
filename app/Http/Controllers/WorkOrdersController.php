<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorkOrdersController extends Controller
{
    /**
     * @param string $status
     * @return Response
     */
    public function index(string $status = 'all')
    {
        $work_orders = null;

        switch ($status) {
            case 'all':
                $work_orders = WorkOrder::all();
                break;
            case 'requested':
                $work_orders = WorkOrder::query()->where('status', '=', 'Requested')->get();
                break;
            case 'approved':
                $work_orders = WorkOrder::query()->where('status', '=', 'Approved')->get();
                break;
            case 'completed':
                $work_orders = WorkOrder::query()->where('status', '=', 'Completed')->get();
                break;
        }

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
