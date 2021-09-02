<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::orderBy('time', 'DESC')->get();

        $response = [
            'message' => 'List transaction oder by time',
            'data'      => $transaction
        ];

        return response()->json($response, Response::HTTP_OK);
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
        //
        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'amount' => ['required', 'numeric'],
            'type'  => ['required', 'in:expense,revenue']
        ]);

        if ($validation->fails()) {
            //
            return response()->json($validation->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            //code...
            /** u can call 1 or more data by using $request->title, request->amount etc */
            $transaction = Transaction::create(request()->all());
            $response = [
                'message' => 'Transaction has been created',
                'data' => $transaction
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
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
        $transaction = Transaction::findOrFail($id);
        $response = [
            'message' => 'Detail of transaction resource',
            'data' => $transaction
        ];

        return response()->json($response, Response::HTTP_OK);
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
        //
        $transaction = Transaction::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'amount' => ['required', 'numeric'],
            'type'  => ['required', 'in:expense,revenue']
        ]);

        if ($validation->fails()) {
            //
            return response()->json($validation->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            //code...
            /** you can call 1 or more data by using $request->title, request->amount etc */
            $transaction->update(request()->all());
            $response = [
                'message' => 'Transaction has been updated',
                'data' => $transaction
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $transaction = Transaction::findOrFail($id);

        try {
            //code...
            $transaction->delete(); 
            $response = [
                'message' => 'Transaction deleted'
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }
}
