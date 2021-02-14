<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return auth()->user()->Permissions;
        //return auth()->user()->getDirectPermissions();      //direct permission
        //return auth()->user()->getPermissionsViaRoles();      //permission via roles
        //return auth()->user()->getAllPermissions();      //get all permission

        //return User::role('writer')->get();      //get user who has role of writer 
        //return User::permission('write post')->get();      //get user who has permission of write post 


        //auth()->user()->givePermissionTo('edit post');
        //auth()->user()->assignRole('writer');
        //Role::create(['name'=>'admin']);
        //$permission = Permission::create(['name'=>'publish post']);
        //$role = Role::findById(1);
        //$permission = Permission::findById(1);
        //$role->givePermissionTo($permission);
        //$role->revokePermissionTo($permission);
        //$permission->removeRole($role);

        //return auth()->user()->revokePermissionTo('edit post');      //revoke this permission
        //return auth()->user()->removeRole('writer');      //revoke this role

        return view('home');
    }

    public function showPosts(){
        //auth()->user()->givePermissionTo('publish post');
        $posts = DB::select('SELECT * FROM posts');
        return view('post')->with('posts',$posts);
    }

    public function addPosts(Request $request_body){
        $title = $request_body->title;
        $body = $request_body->body;
        DB::insert('INSERT INTO posts (title,body) VALUES (?,?)',[$title, $body]);
        return redirect('/posts');
    }

    public function editPostsFrom($id){
        $edit_posts = DB::select('SELECT * FROM posts WHERE id=?',[$id]);
        return view('post')->with('editPosts',$edit_posts);        
    }

    public function editPosts(Request $request_body){
        $title = $request_body->title;
        $body = $request_body->body;
        $id = $request_body->id;
        DB::update('UPDATE posts SET title=?,body=? WHERE id=?',[$title, $body, $id]);
        return redirect('/posts');
    }

    public function deletePosts($id = ""){
        DB::delete('DELETE FROM posts WHERE id=?',[$id]);
        return redirect('/posts');
    }

    public function changeData(){
        DB::update('UPDATE model_has_roles SET role_id=? WHERE model_id=?',[3, 3]);
        return redirect('/posts');
    }
    
}
