<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\OrganizationUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OrganizationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $organizationUser = Cache::remember('organizationsUser', 60, function () {
            return OrganizationUser::with('organizations')->get();
        });


        return response([
            'organizationsUser' => ApiResource::collection($organizationUser),
            'message'           => 'OrganizationUser list',
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
            'name'     => 'required|max:255',
            'email'    => 'required|email:rfc,dns|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error',
            ]);
        }

        $data['password'] = Hash::make($data['password']);
        $organizationUser = OrganizationUser::create($data);

        return response([
            'organizationUser' => new ApiResource($organizationUser),
            'message'          => 'OrganizationUser Created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param OrganizationUser $organizationUser
     *
     * @return Response
     */
    public function show(OrganizationUser $organizationUser)
    {
        return response(
            [
                'organizationUser' => new ApiResource($organizationUser),
                'message'          => 'OrganizationUser Retrieved successfully',
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param OrganizationUser $organizationUser
     *
     * @return Response
     */
    public function update(Request $request, OrganizationUser $organizationUser)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email:rfc,dns|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error',
            ]);
        }

        $data['password'] = Hash::make($data['password']);
        $organizationUser->update($data);

        return response([
            'organizationUser' => new ApiResource($organizationUser),
            'message'          => 'OrganizationUser Update successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrganizationUser $organizationUser
     *
     * @return Response
     */
    public function destroy(OrganizationUser $organizationUser)
    {
        $organizationUser->delete();

        return response([
            'message' => 'OrganizationUser Deleted',
        ]);
    }
}
