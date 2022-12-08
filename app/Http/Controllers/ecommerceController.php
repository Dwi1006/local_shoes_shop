<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ecommerce;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ecommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = ecommerce::get();

        return response()->json([
            'success' => true,
            'message' => 'List Semua sepatu',
            'data' => $admin
        ], 200);
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
        $store = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        if ($store->fails()){
            return response()->json([
                'success' => false,
                'CODE' => 400,
                'message' => 'Gagal Menambahkan Data sepatu',
                'data' => $store->errors()
            ], 400);
        } 

        $validated = $store->validated();

        $admin = ecommerce::create($validated);

        return response()->json([
            "message" => "Tambah Data sepatu Berhasil",
            "Code" => 200,
            "data" => $admin
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = ecommerce::find($id);
        
        if ($table) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data sepatu',
                'data' => $table
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data sepatu Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
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
        // $admin = ecommerce:find($id);

        $admin = ecommerce::find($id);

        if (!$admin) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $validator = validator::make($request->all(), [
            'nama_produk' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message' => $validator->errors()
            ], 402);
        }

        $validated = $validator->getData();

        $admin->update($validated);

        return response()->json([
            'code' => 202,
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $admin
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = ecommerce::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data',
            'data' => $transaction
        ], 200);
    }

}