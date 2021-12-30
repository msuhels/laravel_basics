<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

/**
 * Class SchoolController
 * @package App\Http\Controllers
 */
class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $searchParameters = array();
        if (isset($request->s)) {
            $searchParameters['s']    = $request->s;
            $searchParameters['created_at']    = $request->createdat; 
        }
        $sort = array();
        if (isset($request->sortby)) {
                $sort['sortColumn']   = $request->sortby;
                $sort['sortValue']    = $request->orderby;
        }else{
            $sort['sortColumn']   = 'id';
            $sort['sortValue']    = 'desc';
        }

        $schools = School::
                                        where(function($query) use ($searchParameters)
                                        {           
                                            if( isset($searchParameters['s']) && ($searchParameters['s'] != '' )) {
                                                $query->where('id',$searchParameters['s']);
                                            }
                                            if( isset($searchParameters['created_at']) && ($searchParameters['created_at'] != '' )) {
                                                $query->where('created_at','Like', "%".$searchParameters['created_at']."%");
                                            }
                                        })
                                        ->orderBy($sort['sortColumn'],$sort['sortValue'])
                                        ->paginate()
                                        ->appends(request()->except('page'));

        return view('school.index', compact('schools'))
            ->with('i', (request()->input('page', 1) - 1) * $schools->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = new School();
        return view('school.create', compact('school'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(School::$rules);

        $school = School::create($request->all());

        return redirect()->route('schools.index')
            ->with('success', 'School created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school = School::find($id);

        return view('school.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = School::find($id);

        return view('school.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  School $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        request()->validate(School::$rules);

        $school->update($request->all());

        return redirect()->route('schools.index')
            ->with('success', 'School updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $school = School::find($id)->delete();

        return redirect()->route('schools.index')
            ->with('success', 'School deleted successfully');
    }
}
