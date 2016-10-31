<?php

namespace SET\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
use SET\Http\Requests\InstallationRequest;
use SET\User;

class InstallController extends Controller
{

    public function createUser()
    {
        $response = (new DatabaseManager)->migrateAndSeed();

        return view('vendor.installer.user')
            ->with(['message' => $response]);
    }

    /**
     * Replaces RachidLaasri\LaravelInstaller\Controllers\FinalController
     * so that we can also create the admin user.
     *
     * @param InstallationRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public function storeUser(InstallationRequest $request)
    {
        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $user->role = 'edit';
        $user->save();

        (new InstalledFileManager)->update();

        return view('vendor.installer.finished');
    }
}