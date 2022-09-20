<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $organization = Organization::with('user')->get();

        return response([
            'organizations' => ApiResource::collection($organization),
            'message'       => 'Organization list',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'    => 'required|max:255',
            'email'   => 'required|email:rfc,dns|max:255',
            'phone'   => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error',
            ]);
        }

        $organization = Organization::create($data);

        return response([
            'organization' => new ApiResource($organization),
            'message'      => 'Organization Created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Organization $organization
     *
     * @return Response
     */
    public function show(Organization $organization)
    {
        return response([
            'organization' => new ApiResource($organization),
            'message'      => 'Organization Retrieved successfully',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Organization $organization
     *
     * @return Response
     */
    public function update(Request $request, Organization $organization)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'    => 'required|max:255',
            'email'   => 'required|email:rfc,dns|max:255',
            'phone'   => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error',
            ]);
        }

        $organization->update($data);

        return response([
            'organization' => new ApiResource($organization),
            'message'      => 'Organization Update successfully',
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Organization $organization
     *
     * @return Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return response([
            'message' => 'Organization Deleted',
        ]);
    }
}
