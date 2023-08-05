<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Url::where('user_id',auth()->id())->latest();
        //we get the function to the urls when we make a relation betwee tables
        // return auth()->user()->urls;
        // it is like moving the relation to the model ,we can also move latest function to the model
        // return auth()->user()->urls()->latest()->get();
        return auth()->user()->urls()->paginate(2);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        // $data=$request->validated();

        // return response(Url::create($request->all()),Response::HTTP_CREATED);
        return response(auth()->user()->urls()->create($request->all()),Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        $url->increment('visits');
        return redirect($url->original_url);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }
}
