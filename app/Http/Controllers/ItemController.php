<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return Inertia::render('Items/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
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
    public function edit($id): \Inertia\Response
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
