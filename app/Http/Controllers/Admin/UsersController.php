<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        $citys = [0 => '--select city--', 1 => 'Mohali', 2 => 'Chandigarh', 3 => 'Kharar'];
        return view('admin.users.create', compact('citys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users',
                'mobile' => 'required|unique:users',
                'city' => 'required',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpg,jpeg,png',
            ],[
                // Custom error messages for validation
                'images.required' => 'At least one image is required.',
                'images.array' => 'The images must be an array.',
                'images.*.image' => 'Each file must be an image.',
                'images.*.mimes' => 'Each file must be of type: jpg, jpeg, png.',
                // 'images.*.max' => 'Each file must not exceed 2MB in size.',
            ]
        );
        
        $data = $request->except('password');
        // $data['password'] = bcrypt($request->password);
        $data['password'] = bcrypt('12345678'); // default set all user password is 12345678
        $user = User::create($data);
        $user->assignRole('user');
         // Process each uploaded image
        $images = $request->file('images');
        if(!empty($images)){
            foreach ($images as $image) {
                // Define the storage path
                $destinationPath = 'images'; // This is relative to the `public` directory
                // Generate a unique filename
                $filename = time() . '_' . $image->getClientOriginalName();
                // Move the uploaded image to the specified destination
                $image->move(public_path($destinationPath), $filename);
                // Store the filename and path in the database or perform other operations
                // Example:
                UserImages::create(['image_path' => $destinationPath . '/' . $filename, 'user_id' => $user->id]);
            }
        }   


        // foreach ($request->roles as $role) {
        //     $user->assignRole($role);
        // }

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::with('images')->findOrFail($id);
        $citys = [0 => '--select city--', 1 => 'Mohali', 2 => 'Chandigarh', 3 => 'Kharar'];
        return view('admin.users.show', compact('user','citys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        $user = User::with('roles')->select('id', 'name', 'email','mobile','city','description')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        $citys = [0 => '--select city--', 1 => 'Mohali', 2 => 'Chandigarh', 3 => 'Kharar'];
        return view('admin.users.edit', compact('user', 'roles', 'user_roles','citys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users,email,' . $id,
                'city' => 'required',
                'mobile' => 'required|unique:users,mobile,' . $id,
                'images.*' => 'image|mimes:jpg,jpeg,png',
            ],[
                // Custom error messages for validation
                'images.required' => 'At least one image is required.',
                'images.array' => 'The images must be an array.',
                'images.*.image' => 'Each file must be an image.',
                'images.*.mimes' => 'Each file must be of type: jpg, jpeg, png.',
                // 'images.*.max' => 'Each file must not exceed 2MB in size.',
            ]
        );

        $data = $request->except('password');
        // if ($request->has('password')) {
        //     $data['password'] = bcrypt($request->password);
        // }
        $user = User::findOrFail($id);
        $user->update($data);
        $images = $request->file('images');
        if(!empty($images)){
            UserImages::where('user_id',$user->id)->delete();
            foreach ($images as $image) {
                // Define the storage path
                $destinationPath = 'images'; // This is relative to the `public` directory
                // Generate a unique filename
                $filename = time() . '_' . $image->getClientOriginalName();
                // Move the uploaded image to the specified destination
                $image->move(public_path($destinationPath), $filename);
                // Store the filename and path in the database or perform other operations
                // Example:
                UserImages::create(['image_path' => $destinationPath . '/' . $filename, 'user_id' => $user->id]);
            }
        }   

        // $user->roles()->detach();
        // foreach ($request->roles as $role) {
        //     $user->assignRole($role);
        // }

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
