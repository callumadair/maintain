<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
                    'title' => $issue->title,
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
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Issues/Create', [
            'originator' => Auth::user(),
            'item' => User::all()->random(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated_data = $request->validate([
            'issue_title' => 'required',
            'issue_description' => 'required',
            'item_id' => 'required',
            'originator_id' => 'required|numeric',
        ]);

        $issue = new Issue;
        $issue->title = $validated_data['issue_title'];
        $issue->description = $validated_data['issue_description'];
        $issue->item_id = $validated_data['item_id'];
        $issue->originator_id = $validated_data['originator_id'];
        //temporarily set the assignee id to just be the originator id.
        $issue->assignee_id = $validated_data['originator_id'];
        $issue->save();

        return redirect()->route('issues.show', ['issue' => $issue]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show(int $id): \Inertia\Response
    {
        $issue = Issue::all()->find($id);
        return Inertia::render('Issues/Show', [
            'issue' => [
                'id' => $issue->id,
                'title' => $issue->title,
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
    public function edit(int $id): Response
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
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Issue::all()->find($id)->delete();

        return redirect()->route('issues.index')->with('status', 'Issue deleted!');
    }
}
