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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Items/Index', [
            'items' => Item::all()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
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
            'user' => Auth::user(),
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

        if ($request->hasFile('item_images')) {
            $item_images = $request->file('item_images');

            foreach ($item_images as $item_image) {
                $new_image = new Image;
                $new_image->name = $item_image->getClientOriginalName();
                $new_image->item_id = $item->id;
                $new_image->image_path = 'storage/images/' . $item_image->hashName();
                $new_image->save();

                Storage::disk('public')->put('/images', $item_image);
            }
        }

        $item->user_id = $validated_data['user_id'];
        $item->save();

        return redirect()->route('items.show', ['item' => $item]);
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
            'user_id' => 'required|numeric',
        ]);

        $item = Item::all()->find($id);
        $item->name = $validated_data['item_name'];

        if ($request->has('item_description')) {
            $item->description = $validated_data['item_description'];
        }
        $item->save();

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
        Item::all()->find($id)->delete();

        return redirect()->route('items.index')->with('status', 'Item deleted!');
    }
}
