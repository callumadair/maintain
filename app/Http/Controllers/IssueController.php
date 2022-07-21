<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Issues/Index', [
            'issues' => Issue::all()->map(function ($issue) {
                return [
                    'id' => $issue->id,
                    'description' => $issue->description,
                    'item_id' => $issue->item_id,
                    'originator_id' => $issue->originator_id,
                    'assignee_id' => $issue->originator_id,
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Inertia\Response
     */
    public function show($id): \Inertia\Response
    {
        $issue = Issue::all()->find($id);
        return Inertia::render('Issues/Show', [
            'issue' => [
                'id' => $issue->id,
                'description' => $issue->description,
                'item_id' => $issue->item_id,
                'originator_id' => $issue->originator_id,
                'assignee_id' => $issue->assignee_id,
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id): Response
    {
        //
    }
}
