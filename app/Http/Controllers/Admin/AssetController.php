<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::paginate(20);
        return view('admin.assets.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'symbol' => 'required|string|max:10|unique:assets',
            'name' => 'required|string|max:255',
        ]);

        Asset::create($request->only(['symbol', 'name']));

        return redirect()->route('admin.assets.index')->with('status', 'Asset created.');
    }

    public function edit(Asset $asset)
    {
        return view('admin.assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'symbol' => 'required|string|max:10|unique:assets,symbol,' . $asset->id,
            'name' => 'required|string|max:255',
        ]);

        $asset->update($request->only(['symbol', 'name']));

        return redirect()->route('admin.assets.index')->with('status', 'Asset updated.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('admin.assets.index')->with('status', 'Asset deleted.');
    }
}