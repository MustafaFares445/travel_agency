<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new User';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $user['name'] = $this->ask('Name of new user');
        $user['email'] = $this->ask('Email of new user');
        $user['password'] = $this->secret('Password of new user');

        $roleName =  $this->choice('Role of new the user' , ['admin' , 'editor'] , 1);
        $role = Role::where('name' , $roleName)->first();

        if (! $role){
            $this->error('Role not found');

            return -1;
        }

        $validator = Validator::make($user , [
           'name' => ['required' , 'string'],
           'email' => ['required' ,  'string' ,'email' , 'max:255' , 'unique:' . User::class],
            'password' => ['required' , Password::defaults()]
        ]);

        if ($validator->fails()){
            foreach($validator->errors()->all() as $error){
                $this->error($error);
            }
            return -1;
        }
        DB::transaction(function() use ($user ,  $role){
            $newUser =  User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $newUser->roles()->attach($role->id);
        });

        $this->info('User created successfully!');
        return 0;
    }
}
