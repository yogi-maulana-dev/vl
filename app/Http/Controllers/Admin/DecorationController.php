<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Decoration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Uuid;
use Illuminate\Support\Facades\Storage;
use File;

class DecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //te
        return view('backend/project/decoration/index', [
            'decoration' => Decoration::all(),
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $validation = Validator::make(request()->all(), [
            'name'=>'required',
            //  'banner_image' => 'required|image|file|dimensions:min_width=1920,min_height=1080|max:3073',
            'image_decoration' => 'required|image|file',
         ]);
 
         if ($validation->fails()) {
             return response()->json(
                 [
                     'status' => false,
                     'error' => false,
                     'message' => 'Error',
                     'data' => null,
                 ],
                 200
             );
         }
        //  if ($request->file('image_decoration')) {
        //      $path = $request->file('image_decoration')->store('image_decoration');
        //  }
         
         if($request->file('image_decoration')){
       $image = $request->file('image_decoration');
       $extension=$image->getClientOriginalExtension();
       $file_name = 'File-image_decoration-'.date('Y-m-d-h-i-s').'.'.$extension;
       $destination_path = public_path('/core/uploads/image_decoration/');
       $result=$image->move($destination_path,$file_name);
       
         $decoration = Decoration::create([
             'name'=>request('name'),
             'image_decoration' => $file_name,
             'id_staff' => auth()->guard('staff')->user()->id, 
         ]);
 
         if ($decoration) {
             return redirect()->route('decoration_cms.index')->with(['success' => 'Data Berhasil Disimpan!']);
             return response()->json(
                 [
                     'status' => true,
                     'error' => false,
                     'message' => 'success',
                     'data' => $decoration,
                 ],
                 200
             );
         } else {
             return response()->json([
                 'status' => false,
                 'error' => false,
                 'message' => 'success',
                 'data' => $decoration,
             ]);
         }
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
        $decoration = Decoration::select('*')
            ->where('id', $id)
            ->get();
        return view('backend/project/decoration/edit', ['id' => $decoration]);
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
        //
        $validator = Validator::make(request()->all(), [
            'name'=>'required',
            'image_decoration' => 'required|image|file',
        ]);
        if ($validator->fails()) {
            // return response()->json($validator->messages());

            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200
            );
        }
        $updatedecoration = Decoration::find($id);
         $path = public_path().'/core/uploads/image_decoration/';
        if ($request->file('image_decoration')) {
            if ($request->image_decoration) {
                 $file_old = $path.$updatedecoration->image_decoration;
                 unlink($file_old);
            }
           
        }
        
          $image = $request->file('image_decoration');
       $extension=$image->getClientOriginalExtension();
       $file_name = 'File-image_decoration-'.date('Y-m-d-h-i-s').'.'.$extension;
       $destination_path = public_path('/core/uploads/image_decoration/');
       $result=$image->move($destination_path,$file_name);

        $decoration = $updatedecoration->update([
            'name'=>request('name'),
            'image_decoration' => $file_name,
            'id_staff' => auth()->guard('staff')->user()->id, 
        ]);

        if ($decoration) {
            // return response()->json(['message' => 'Pendaftaran']);
            return redirect()->route('decoration_cms.index')->with(['success' => 'Data Berhasil Disimpan!']);
           
            return response()->json(
                [
                    'status' => true,
                    'error' => false,
                    'message' => 'success',
                    'data' => $decoration,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'error' => false,
                    'message' => 'Error',
                    'data' => null,
                ],
                200
            );
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
         $deletedecoration = Decoration::find($id);
          $path = public_path().'/core/uploads/image_decoration/';
         if ($deletedecoration->image_decoration) {
             $file_old = $path.$deletedecoration->image_decoration;
                 unlink($file_old);
         }
     $decoration = $deletedecoration->delete();
 
     if ($decoration) {
         // return response()->json(['message' => 'Pendaftaran']);
         return redirect()->route('decoration_cms.index')->with(['success' => 'Data Berhasil Disimpan!']);
            
         return response()->json(
             [
                 'status' => true,
                 'error' => false,
                 'message' => 'success',
                 'data' => $decoration,
             ],
             200,
         );
     } else {
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
    }
}
