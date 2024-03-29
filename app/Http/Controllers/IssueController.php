<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Issue;
use App\Models\Item;
use App\Models\User;
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
     * @param string $status
     * @return Response
     */
    public function index(string $status = 'all'): Response
    {
        $issues = Issue::all();

        switch ($status) {
            case 'all':
                $issues = Issue::all();
                break;
            case 'assigned':
                $issues = Issue::query()->where('status', '=', 'Assigned')->get();
                break;
            case 'in-progress':
                $issues = Issue::query()->where('status', '=', 'In-Progress')->get();
                break;
            case 'actioned':
                $issues = Issue::query()->where('status', '=', 'Actioned')->get();
                break;
            case 'resolved':
                $issues = Issue::query()->where('status', '=', 'Resolved')->get();
                break;
        }

        return Inertia::render('Issues/Index', [
            'issues' => $issues->map(function ($issue) {
                return [
                    'id' => $issue->id,
                    'title' => $issue->title,
                    'description' => $issue->description,
                    'status' => $issue->status,
                    'item_id' => $issue->item_id,
                    'originator_id' => $issue->originator_id,
                    'assignee_id' => $issue->assignee_id,
                    'created_at' => $issue->created_at,
                    'updated_at' => $issue->updated_at,
                    'item' => $issue->item,
                    'originator' => $issue->originator,
                    'assignee' => $issue->assignee,
                    'images' => $issue->images,
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return Response
     */
    public function create(int $id): Response
    {
        return Inertia::render('Issues/Create', [
            'originator' => Auth::user(),
            'item' => Item::all()->find($id),
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'current_team_id' => $user->current_team_id,
                    'profile_photo_path' => $user->profile_photo_path,
                    'is_admin' => $user->is_admin,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ];
            }),
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
            'issue_description' => 'nullable',
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

        $this->store_images($request, $issue);

        return redirect()->route('issues.show', ['issue' => $issue]);
    }

    /**
     * @param Request $request
     * @param Issue $issue
     * @return void
     */
    private function store_images(Request $request, Issue $issue): void
    {
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
        $issue_item = Item::all()->find($issue->item_id);

        return Inertia::render('Issues/Show', [
            'issue' => [
                'id' => $issue->id,
                'title' => $issue->title,
                'description' => $issue->description,
                'status' => $issue->status,
                'item_id' => $issue->item_id,
                'originator_id' => $issue->originator_id,
                'assignee_id' => $issue->assignee_id,
                'created_at' => $issue->created_at,
                'updated_at' => $issue->updated_at,
                'item' => [
                    'id' => $issue_item->id,
                    'name' => $issue_item->name,
                    'description' => $issue_item->description,
                    'status' => $issue_item->status,
                    'user_id' => $issue_item->user_id,
                    'created_at' => $issue_item->created_at,
                    'updated_at' => $issue_item->updated_at,
                    'user' => $issue_item->user,
                    'issues' => $issue_item->issues,
                    'images' => $issue_item->images,
                ],
                'originator' => $issue->originator,
                'assignee' => $issue->assignee,
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
        $originator = User::query()->find($issue->originator_id);
        $assignee = User::query()->find($issue->assignee_id);

        return Inertia::render('Issues/Edit', [
            'issue' => [
                'id' => $issue->id,
                'title' => $issue->title,
                'description' => $issue->description,
                'status' => $issue->status,
                'item_id' => $issue->item_id,
                'originator_id' => $issue->originator_id,
                'assignee_id' => $issue->assignee_id,
                'created_at' => $issue->created_at,
                'updated_at' => $issue->updated_at,
                'item' => $issue->item,
                'originator' => [
                    'id' => $originator->id,
                    'name' => $originator->name,
                    'profile_photo_path' => $originator->profile_photo_path,
                    'is_admin' => $originator->is_admin,
                    'created_at' => $originator->created_at,
                    'updated_at' => $originator->updated_at,
                ],
                'assignee' => [
                    'id' => $assignee->id,
                    'name' => $assignee->name,
                    'profile_photo_path' => $assignee->profile_photo_path,
                    'is_admin' => $assignee->is_admin,
                    'created_at' => $assignee->created_at,
                    'updated_at' => $assignee->updated_at,
                ],
                'images' => $issue->images,
            ],
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'profile_photo_path' => $user->profile_photo_path,
                    'is_admin' => $user->is_admin,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ];
            }),
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
            'issue_description' => 'nullable',
            'issue_status' => 'required',
            'issue_images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'item_id' => 'required',
            'originator_id' => 'required|numeric',
            'assignee_id' => 'required|numeric',
            'images_deleted' => 'nullable',
        ]);

        $issue = Issue::all()->find($id);
        $issue->title = $validated_data['issue_title'];

        if ($request->has('issue_description')) {
            $issue->description = $validated_data['issue_description'];
        }
        
        $issue->status = $validated_data['issue_status'];
        $issue->item_id = $validated_data['item_id'];
        $issue->originator_id = $validated_data['originator_id'];
        $issue->assignee_id = $validated_data['assignee_id'];
        $issue->save();

        if ($request->has('images_deleted')
            && $validated_data['images_deleted'] != null) {
            $image_ids = json_decode($validated_data['images_deleted']);
            foreach ($image_ids as $image_id) {
                $image = Image::all()->find($image_id);
                $image->delete();
            }
        }

        $this->store_images($request, $issue);

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

        if ($issue->images != null) {
            foreach ($issue->images as $image) {
                //remove 'storage' from the image path to make it relative to the public folder
                $relative_path = substr($image->image_path, 8);
                Storage::disk('public')->delete($relative_path);
            }
        }

        $issue->delete();

        return redirect()->route('issues.index', 'all')->with('status', 'Issue deleted!');
    }

    /**
     * @return Response
     */
    public function item_select(): Response
    {
        return Inertia::render('Issues/ItemSelect', [
            'items' => Item::all()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'status' => $item->status,
                    'user_id' => $item->user_id,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'user' => $item->user,
                    'issues' => $item->issues,
                    'images' => $item->images,
                ];
            }),
        ]);
    }
}
