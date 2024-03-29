<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Uuid;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource. create by https://github.com/yogi-maulana-dev
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->middleware('adminauth');
        return view('backend/master/staff/index', [
         'staffs' => Staff::all(),
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
        $validation = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:staff',
            'password' => '',
            'status' => '',
        ]);

        if ($validation->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200,
            );
        }
        $staff = Staff::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'status' => request('status'),
        ]);

        if ($staff) {
            return redirect()->route('staff.index')->with(['success' => 'Data Berhasil Disimpan!']);
        
            return response()->json(
                [
                    'status' => true,
                    'error' => false,
                    'message' => 'success',
                    'data' => $staff,
                ],
                200,
            );
        } else {
            return response()->json([
                'status' => false,
                'error' => false,
                'message' => 'success',
                'data' => $staff,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $staff = Staff::select('*')
            ->where('id', $id)
            ->get();

        return view('backend/master/staff/edit', ['id' => $staff]);
        // return view('backend/master/staff/edit/', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // return $id;
        
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:staff',
            'password' => '',
            'status' => '',
        ]);
        // if ($validation->fails()) {
        //     return response()->json(['status' => true, 'error' => false, 'message' => 'success', 'data' => null], 200);
        // }
        $updatedatastaff = Staff::find($id);
        $datastaff = $updatedatastaff->update([
            'name' =>request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'status' => request('status')
        ]);
        if ($datastaff) {
            return redirect()->route('staff.index')->with(['success' => 'Data Berhasil Disimpan!']);
        
            return response()->json([
                'status' => true,
                'error' => false,
                'message' => 'success',
                'data' => $datastaff,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => false,
                'message' => 'error',
                'data' => null,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $destroy=Staff::find($id);

        $datadestroy=$destroy->delete();

        if($datadestroy){
            return redirect()->route('staff.index')->with(['success' => 'Data Berhasil Disimpan!']);
        
            return response()->json([
                'status' => true,
                'error' => false,
                'message' => 'success',
                'data' => $datadestroy
            ]);
        } else {
            return response()->json(
                [
                    'status'=> false,
                    'error'=>false,
                    'message'=>'Error',
                    'data' => null
                ]
            );
        }
    }

    
}
