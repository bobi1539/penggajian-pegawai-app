<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('positions.index', [
            'title' => 'Jabatan',
            'positions' => Position::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grade' => ['required', 'max:255', 'unique:positions'],
            'positional_allowance' => ['required']
        ]);

        $validatedData['positional_allowance'] = implode(explode(',', $request->positional_allowance));
        Position::create($validatedData);
        return redirect('/positions')->with('messageSuccess', 'Data jabatan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return response()->json([
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $rules = [
            'grade' => ['required', 'max:255'],
            'positional_allowance' => ['required']
        ];

        if ($request->grade != $position->grade) {
            $rules['grade'] = ['required', 'unique:positions'];
        }

        $validatedData = $request->validate($rules);
        $validatedData['positional_allowance'] = implode(explode(',', $request->positional_allowance));
        Position::where('id', $position->id)->update($validatedData);
        return redirect('/positions')->with('messageSuccess', 'Data jabatan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        Position::destroy($position->id);
        return redirect('/positions')->with('messageSuccess', 'Data jabatan berhasil dihapus');
    }
}
