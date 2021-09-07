<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('groups.index', [
            'title' => 'Golongan',
            'groups' => Group::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'job_class' => ['required', 'max:255', 'unique:groups'],
            'basic_salary' => ['required']
        ]);

        $validatedData['basic_salary'] = implode(explode(',', $request->basic_salary));
        Group::create($validatedData);
        return redirect('/groups')->with('messageSuccess', 'Data golongan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return response()->json([
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $rules = [
            'job_class' => ['required', 'max:255'],
            'basic_salary' => ['required']
        ];

        if ($request->job_class != $group->job_class) {
            $rules['job_class'] = ['required', 'max:255', 'unique:groups'];
        }

        $validatedData = $request->validate($rules);

        $validatedData['basic_salary'] = implode(explode(',', $request->basic_salary));

        Group::where('id', $group->id)->update($validatedData);
        return redirect('/groups')->with('messageSuccess', 'Data golongan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        // Group::where('id', $group->id)->update([
        //     'is_delete' => 1,
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        Group::destroy($group->id);
        return redirect('/groups')->with('messageSuccess', 'Data golongan berhasil dihapus');
    }
}
