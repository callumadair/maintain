<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
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
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
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
            'user_id' => 'required|numeric',
        ]);

        $item = new Item;
        $item->name = $validated_data['item_name'];

        if ($request->has('item_description')) {
            $item->description = $validated_data['item_description'];
        }
        $item->user_id = $validated_data['user_id'];
        $item->save();

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show(int $id): \Inertia\Response
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
     * @return \Inertia\Response
     */
    public function edit(int $id): \Inertia\Response
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
