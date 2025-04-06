<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TypeRequest;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Script untuk Datatables Ajax
        if(request()->ajax()){
            $query = Type::query();
            return DataTables::of($query)
            -> addColumn('action',function($type){
                return '
                    <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                        href="' . route('admin.types.edit', $type->id) . '">
                        Sunting
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.types.destroy', $type->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'] . '-' . Str::lower(Str::random(5)));
        Type::create($data);
        return redirect()->route('admin.types.index')->with('success', 'Type berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', [
        'type' => $type,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $type->update($data);
        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}
