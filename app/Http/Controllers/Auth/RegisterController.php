<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

   
    protected $redirectTo = RouteServiceProvider::HOME;

   
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:users','alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

  

/*   public function assignRoleToUser(User $user)
{
    if (User::count() === 1) {
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $adminRole = Role::create([
                'name' => 'admin',
            ]);
        }

        $user->assignRole($adminRole);
    }
}  */
    protected function create(array $data)
    {
      /*   Log::info('Creating new user: ' . $data['username']);  */
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    
         if ($user) {
           // Log::info('Assigning role to user: ' . $user->id);
       // $this->assignRoleToUser($user);
       if (User::count() === 1) {
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $adminRole = Role::create([
                'name' => 'admin',
            ]);
        }

        $user->assignRole($adminRole);
    }
        }
        //Log::info('User created: ' . $user->id);


    return $user; 
}
}
