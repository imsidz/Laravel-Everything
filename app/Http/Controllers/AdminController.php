<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Auth;

//Model's Only
use App\User;
use App\Slider;
use App\Blog;
use App\Tagblog as Tag;
use App\Portfolio;
use App\Video;

//Third Party Aliases
use Alaouy\Youtube\Facades\Youtube;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class AdminController extends Controller
{	

	public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index(){
    	return view('admin.index');
    }

    public function userindex(){
    	$users = User::all(); 
    	return view('admin.user.index', compact('users'));
    }

    public function useredit($user){
    	$user = User::findOrFail($user); //Get user with specified id
        $roles = Role::get();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function userupdate(Request $request, $id){
    	$user = User::findOrFail($id); //Get role specified by id

    //Validate name, email and password fields  
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);
        $input = $request->only(['name', 'email', 'password']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('admin.user.index')
            ->with('flash_message',
             'User successfully edited.');
    }

    public function roleindex(){

    	$roles = Role::all();//Get all roles
    	return view('admin.role.index', compact('roles'));
    }

    public function rolecreate(){

    	$permissions = Permission::all();//Get all permissions
    	return view('admin.role.create', compact('permissions'));
    }

    public function rolestore(Request $request){
    	//Validate name and permissions field
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();
    	
    	//Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 
         //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first(); 
            $role->givePermissionTo($p);
        }

        return redirect()->route('admin.roles.index')
            ->with('flash_message',
             'Role'. $role->name.' added!'); 
    }

    public function roledelete($role){

    	$role = Role::findOrFail($role);
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('flash_message',
             'Role deleted!');
    }

    public function permissionindex(){

    	$permissions = Permission::all(); //Get all permissions
    	return view('admin.permission.index', compact('permissions'));
    }

    public function permissioncreate(){
    	$roles = Role::get(); //Get all roles
    	
    	return view('admin.permission.create')->with('roles', $roles);

    }

    public function permissionstore(Request $request){
    	$this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.permission.index')
            ->with('flash_message',
             'Permission'. $permission->name.' added!');
    }

    public function permissiondelete($permission){
    	$permission = Permission::findOrFail($permission);

    //Make it impossible to delete this specific permission 
    if ($permission->name == "Administrator") {
            return redirect()->route('admin.permission.index')
            ->with('flash_message',
             'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('admin.permission.index')
            ->with('flash_message',
             'Permission deleted!');

    }

    public function sliderindex(){
        $sliders = Slider::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.slider.index', compact('sliders'));
    }

    public function sliderpost(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255|unique:sliders',
            'content'   =>  'required',
            'image' => 'image|required',
        ]);
        
        $slider = new Slider;
        $slider->title = $request->title;
        $slider->content = $request->content;
        $slider->published_at = Carbon::now();
        $slider->user_id = Auth::user()->id;
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/images/slider/', $name);
            $slider->image = $name;
            $thumb = Image::make(public_path().'/images/slider/' . $name)->resize(1920,1080)->save(public_path().'/images/slider/thumb/' . $name, 90);
        }
        
        $slider->save();
        return Redirect::back()->with('status', 'Post Success');
    }

    public function slideredit($slider){
        $slider = Slider::where('title', $slider)->firstorfail();
        return view('admin.slider.edit', compact('slider'));
    }

    public function sliderupdate($slider, Request $request){
        $slider = Slider::where('title', $slider)->firstorfail();
        $slider->title = $request->title;
        $slider->content = $request->content;
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/images/slider/', $name);
            $slider->image = $name;
            $thumb = Image::make(public_path().'/images/slider/' . $name)->resize(1920,1080)->save(public_path().'/images/slider/thumb/' . $name, 90);
        }
        
        $slider->save();
        return redirect()->route('admin.slider.edit', $slider->title)->with('status', 'Update Success');
    }

    public function sliderdelete($slider){
        $slider = Slider::where('title', $slider)->firstorfail();
        $slider->delete();

        return Redirect::back()->with('status', 'Deleted Success');
    }

    public function slidertrashindex(){
        $sliders = Slider::onlyTrashed()
                ->paginate(25);
        return view('admin.trash.slider', compact('sliders'));
    }

    public function sliderrestore($slider){
        $slider = Slider::withTrashed()
        ->where('title', $slider)
        ->restore();
        return Redirect::back()->with('status', 'Restore Success');
    }

    public function sliderpermadelete($slider){
        $slider = Slider::withTrashed()
        ->where('image', $slider)
        ->forceDelete();
        
        return redirect()->route('admin.slider.trash.index')->with('warning', 'Deleted Success');
    }

    public function blogindex(){
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(25);
        $tags = Tag::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.blog.index', compact('blogs', 'tags'));
    }

    public function blogpost(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255|unique:blogs',
            'content' => 'required',
            'image' => 'image|required',
            'tag.*' => 'required|string',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = str_slug($blog->title, '-');
        $blog->user_id = Auth::user()->id;
        $blog->published_at = $request->published_at;
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/images/blog/', $name);
            $blog->image = $name;
            $thumb = Image::make(public_path().'/images/blog/' . $name)->resize(640,420)->save(public_path().'/images/blog/thumb/' . $name, 90);
        }
        $blog->save();
        $blog_id = $blog->id;
        $tags = $request->tag;
        if($request->has('tag')){
                foreach ($tags as $tag) {
                $tag = Tag::firstOrNew(['name' => $tag]);
                $tag->save();
                $tag->blogs()->attach($blog_id);
            }
        }
        else {
            $tag = Tag::firstOrNew(['name' => 'Uncategory']);
            $tag->slug = 'uncategory';
            $tag->save();
            $tag->blogs()->attach($blog_id);
        }
        return Redirect::back()->with('status', 'Post Success');
    }

    public function blogdelete($blog){
        $blog = Blog::where('slug', $blog)->firstorfail();
        $blog->delete();
        return Redirect::back()->with('warning', 'Post Deleted');
    }

    public function tagblogindex(){
        $tags = Tag::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.tag.blog', compact('tags'));
    }

    public function tagblogpost(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255|unique:tagblogs',
        ]);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = str_slug($tag->name, '-');
        $tag->save();
        return Redirect::back()->with('status', 'Post Success');
    }

    public function tagblogedit($tag, Request $request){
        $this->validate($request, [
            'name' => 'required|max:255|unique:tagblogs',
        ]);

        $tag = Tag::where('name', $tag)->firstorfail();
        $tag->name = $request->name;
        $tag->slug = str_slug($tag->name, '-');
        $tag->save();
        return Redirect::back()->with('status', 'Edit Success');
    }

    public function tagblogdelete($tag){
        $tag = Tag::where('name', $tag)->firstorfail();
        $tag->delete();
        return Redirect::back()->with('warning', 'Delete Success');
    }

    public function portfolioindex(){
        $portfolios = Portfolio::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function portfoliopost(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255|unique:portfolios',
            'image' => 'required|image'
        ]);

        $portfolio = new Portfolio;
        $portfolio->title = $request->title;
        $portfolio->slug = str_slug($portfolio->title, '-');
        $portfolio->user_id = Auth::user()->id;
        $portfolio->published_at = Carbon::now();
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/images/portfolio/', $name);
            $portfolio->image = $name;
            $thumb = Image::make(public_path().'/images/portfolio/' . $name)->resize(1920,1080)->save(public_path().'/images/portfolio/thumb/' . $name, 90);
        }
        $portfolio->save();
        return Redirect::back()->with('status', 'Portfolio Added Success');
    }

    public function portfolioupdate($image, Request $request){
        $portfolio = Portfolio::where('slug', $image)->firstorfail();
        $portfolio->title = $request->title;
        $portfolio->slug = str_slug($portfolio->title, '-');
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/images/portfolio/', $name);
            $portfolio->image = $name;
            $thumb = Image::make(public_path().'/images/portfolio/' . $name)->resize(1920,1080)->save(public_path().'/images/portfolio/thumb/' . $name, 90);
        }
        $portfolio->save();
        return Redirect::back()->with('status', 'Portfolio Updated Success');
    }

    public function portfoliodelete($image){
        $portfolio = Portfolio::where('slug', $image)->firstorfail();
        $portfolio->delete();
        return Redirect::back()->with('warning', 'Portfolio Deleted Success');

    }

    public function portfoliotrashindex(){
         $portfolios = Portfolio::onlyTrashed()
                ->paginate(25);
        return view('admin.trash.portfolio', compact('portfolios'));

    }

    public function portfoliorestore($portfolio){
        $portfolio = Portfolio::withTrashed()
        ->where('slug', $portfolio)
        ->restore();
        return Redirect::back()->with('status', 'Restore Success');
    }

    public function portfolioparmadelete($portfolio){
         $portfolio = Portfolio::withTrashed()
        ->where('slug', $portfolio)
        ->forceDelete();
        
        return Redirect::back()->with('warning', 'Deleted Success');
    }

    public function blogtrashindex(){
        $blogs = Blog::onlyTrashed()
                ->paginate(25);
        return view('admin.trash.blog', compact('blogs'));
    }

    public function blogtrashrestore($blog){
        $blog = Blog::withTrashed()
        ->where('slug', $blog)
        ->restore();
        return Redirect::back()->with('status', 'Restore Success');
    }

    public function blogtrashpermadelete($blog){
        $blog = Blog::withTrashed()
        ->where('slug', $blog)
        ->forceDelete();
        
        return redirect()->route('admin.blog.trash.index')->with('warning', 'Deleted Success');
    }

    public function blogedit($blog){
        $blog = Blog::where('slug', $blog)->firstorfail();
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return view('admin.blog.edit', compact('blog', 'tags'));
    }

    public function blogeditupdate($blog, Request $request){
        $blog = Blog::where('slug', $blog)->firstorfail();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = str_slug($blog->title, '-');
        $blog->user_id = Auth::user()->id;
        $blog->published_at = Carbon::now();
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/images/blog/', $name);
            $blog->image = $name;
            $thumb = Image::make(public_path().'/images/blog/' . $name)->resize(640,420)->save(public_path().'/images/blog/thumb/' . $name, 90);
        }
        $blog->save();
        $blog_id = $blog->id;
        $tags = $request['tag'];
        
        $blog->tags()->detach(); //If no tags is selected remove exisiting role associated to a blogs
        

        if($request->has('tag')){
                foreach ($tags as $tag) {
                $tag = Tag::firstOrNew(['name' => $tag]);
                $tag->save();
                $tag->blogs()->attach($blog_id);
            }
        }
        else {
            $tag = Tag::firstOrNew(['name' => 'Uncategory']);
            $tag->slug = 'uncategory';
            $tag->save();
            $tag->blogs()->attach($blog_id);
        }

                                 
        return redirect()->route('admin.blog.index')->with('status', 'Edit Success');
    }

    /**
     * video's index
     *
     * @return     view resources
     */
    public function videoindex(){
        $videos = Video::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.video.index', compact('videos'));
    }

    public function videopost(Request $request){
        $this->validate($request, [
            'videoid' => 'required|max:255|min:35|unique:videos',
        ]);

        $youtubeid = Youtube::parseVidFromURL($request->videoid);
        $video = new Video;
        $video->videoid = $youtubeid;
        $video->user_id = Auth::user()->id;
        $video->save();
        return Redirect::back()->with('status', 'Video Posted Success');

    }

    public function videodelete($videoid){
        $video = Video::where('videoid', $videoid)->firstorfail();
        $video->delete();
        return Redirect::back()->with('warning', 'Video Delete Success');
    }

    public function videotrashindex(){
        $videos = Video::onlyTrashed()
                ->paginate(25);
        return view('admin.trash.video', compact('videos'));
    }
}