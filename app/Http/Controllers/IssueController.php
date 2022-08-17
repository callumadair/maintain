<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Issue;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class IssueController extends Controller
{
    const IMAGES_ROOT = '/storage/images/issues/';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
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
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Issues/Create', [
            'originator' => Auth::user(),
            'item' => Item::all()->random(),
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
            'issue_images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'item_id' => 'required',
            'originator_id' => 'required|numeric',
            'assignee_id' => 'required|numeric',
        ]);

        $issue = new Issue;
        $issue->title = $validated_data['issue_title'];
        $issue->description = $validated_data['issue_description'];
        $issue->item_id = $validated_data['item_id'];
        $issue->originator_id = $validated_data['originator_id'];
        $issue->assignee_id = $validated_data['assignee_id'];
        $issue->save();

        if ($request->hasFile('issue_images')) {
            $issue_images = $request->file('issue_images');
            $image_path_prefix = self::IMAGES_ROOT
                . $issue->id . '-'
                . $issue->title . '-';

            foreach ($issue_images as $issue_image) {
                $new_image = new Image;
                $new_image->name = $issue_image->getClientOriginalName();
                $new_image->issue_id = $issue->id;
                $new_image->image_path = $image_path_prefix
                    . $issue_image->getClientOriginalName();
                $new_image->save();

                Storage::disk('public')->putFileAs('/images/issues/',
                    $issue_image
                    , $issue->id
                    . '-' . $issue->title
                    . '-' . $new_image->name);
            }
        }
        return redirect()->route('issues.show', ['issue' => $issue]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
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
                'images' => $issue->images,
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
        $issue = Issue::all()->find($id);
        return Inertia::render('Issues/Edit', [
            'issue' => [
                'id' => $issue->id,
                'title' => $issue->title,
                'description' => $issue->description,
                'item_id' => $issue->item_id,
                'originator_id' => $issue->originator_id,
                'assignee_id' => $issue->assignee_id,
                'images' => $issue->images,
            ],
            'originator' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated_data = $request->validate([
            'issue_title' => 'required',
            'issue_description' => 'required',
            'item_id' => 'required',
            'originator_id' => 'required',
        ]);

        $issue = Issue::all()->find($id);
        $issue->title = $validated_data['issue_title'];
        $issue->description = $validated_data['issue_description'];
        $issue->item_id = $validated_data['item_id'];
        $issue->originator_id = $validated_data['originator_id'];
        //temporarily set the assignee id to be the originator id.
        $issue->assignee_id = $validated_data['originator_id'];
        $issue->save();

        return redirect()->route('issues.show', ['issue' => $issue]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $issue = Issue::all()->find($id);

        foreach ($issue->images as $image) {
            //remove 'storage' from the image path to make it relative to the public folder
            $relative_path = substr($image->image_path, 8);
            Storage::disk('public')->delete($relative_path);
        }

        $issue->delete();

        return redirect()->route('issues.index')->with('status', 'Issue deleted!');
    }
}
