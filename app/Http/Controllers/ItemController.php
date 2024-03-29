<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ItemController extends Controller
{
    const IMAGES_ROOT = '/storage/images/items/';

    /**
     * Display a listing of the resource.
     *
     * @param string $status
     * @return Response
     */
    public function index(string $status = 'all'): Response
    {
        $items = null;

        switch ($status) {
            case 'all':
                $items = Item::all();
                break;
            case 'functional':
                $items = Item::query()->where('status', '=', 'Functional')->get();
                break;
            case 'disabled':
                $items = Item::query()->where('status', '=', 'Disabled')->get();
                break;
        }

        return Inertia::render('Items/Index', [
            'items' => $items->map(function ($item) {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Items/Create', [
            'auth_user' => Auth::user(),
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
            'item_name' => 'required',
            'item_description' => 'nullable',
            'item_images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'user_id' => 'required|numeric',
        ]);

        $item = new Item;
        $item->name = $validated_data['item_name'];

        if ($request->has('item_description')) {
            $item->description = $validated_data['item_description'];
        }
        $item->user_id = $validated_data['user_id'];
        $item->save();

        $this->store_images($request, $item);

        return redirect()->route('items.show', ['item' => $item]);
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return void
     */
    private function store_images(Request $request, Item $item): void
    {
        if ($request->hasFile('item_images')) {
            $item_images = $request->file('item_images');
            $image_path_prefix = self::IMAGES_ROOT
                . $item->id . '-'
                . $item->name . '-';

            foreach ($item_images as $item_image) {
                $new_image = new Image;
                $new_image->name = $item_image->getClientOriginalName();
                $new_image->item_id = $item->id;
                $new_image->image_path = $image_path_prefix
                    . $item_image->getClientOriginalName();
                $new_image->save();

                Storage::disk('public')->putFileAs('/images/items/',
                    $item_image
                    , $item->id
                    . '-' . $item->name
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
        $item = Item::all()->find($id);
        return Inertia::render('Items/Show', [
            'item' => [
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
        $item = Item::all()->find($id);
        return Inertia::render('Items/Edit', [
            'item' => [
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
            ],
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
            'item_name' => 'required',
            'item_description' => 'nullable',
            'item_status' => 'required',
            'item_images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'user_id' => 'required|numeric',
            'images_deleted' => 'nullable',
        ]);

        $item = Item::all()->find($id);
        $item->name = $validated_data['item_name'];

        if ($request->has('item_description')) {
            $item->description = $validated_data['item_description'];
        }
        $item->status = $validated_data['item_status'];
        $item->save();

        if ($request->has('images_deleted')
            && $validated_data['images_deleted'] != null) {
            $image_ids = json_decode($validated_data['images_deleted']);
            foreach ($image_ids as $image_id) {
                $image = Image::all()->find($image_id);
                $image->delete();
            }
        }

        $this->store_images($request, $item);

        return redirect()->route('items.show', ['item' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $item = Item::all()->find($id);

        if ($item->images != null) {
            foreach ($item->images as $image) {
                //remove 'storage' from the image path to make it relative to the public folder
                $relative_path = substr($image->image_path, 8);
                Storage::disk('public')->delete($relative_path);
            }
        }
        $item->delete();

        return redirect()->route('items.index', 'all')->with('status', 'Item deleted!');
    }


}
