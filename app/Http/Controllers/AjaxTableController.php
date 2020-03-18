<?php

namespace App\Http\Controllers;

use App\AjaxTable;
use Illuminate\Http\Request;

class AjaxTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajaxtable');
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
        if($request->ajax())
        {
            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone
            );

            $id = AjaxTable::insert($data);

            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Insert Succesfully</div>';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AjaxTable  $ajaxTable
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax())
        {
            $data = AjaxTable::orderBy('id','desc')->get();
            echo json_encode($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AjaxTable  $ajaxTable
     * @return \Illuminate\Http\Response
     */
    public function edit(AjaxTable $ajaxTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AjaxTable  $ajaxTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjaxTable $ajaxTable)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name       =>  $request->column_value
            );
            AjaxTable::where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AjaxTable  $ajaxTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            AjaxTable::where('id',$request->id)
            ->delete();

            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }
}
