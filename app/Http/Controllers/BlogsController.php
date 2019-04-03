<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\AppStorage;

use Carbon\Carbon;

use App\Post;
use App\PostTag;
use App\PostMstrView;

use App\Tag;

use App\User;



class BlogsController extends Controller
{
    //
    
    public $menu_group = 'blogs.index';

    public $posttype = 'Blog';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Posts');
        session()->flash('child_tab', $this->menu_group);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(3001)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $blogs = PostMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $blogs->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });

        }

        $blogs->where('type', 'Blog');

        $blogs = $blogs->orderBy('sourcedate', 'DESC')->orderBy('name', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.blogs.index', compact('sub_menu', 'blogs', 'search'));

    }//END index


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(3002)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $msctags = Tag::getActiveTags();
        return view('admin.blogs.create', compact('msctags'));

    }//END create



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(3002)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        //dd($request->tags);
        
        $request['type'] = $this->posttype;

        $validator = Post::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

            	$isexists = Post::where('type', $this->posttype)
                            ->where('slug', $request->slug)
                            ->first();

                if( $isexists ){
                    return redirect()->back()->withInput()->withErrors(['Slug already exists']);
                }

                $isexists = Post::where('type', $this->posttype)
                            ->where('name', $request->name)
                            ->first();

                if( $isexists ){
                    return redirect()->back()->withInput()->withErrors(['Blog name already exists']);
                }


                $request['fk_createdby'] = Auth::id();

                //create will return the newly created object
                $blogs = Post::create($request->all()); //insert all $request

                //if request uploaded picture
                if( $request->pictx ){

                    //update DB for correct filename @pictx
                    $blogs->update([
                        'pictx'=> AppStorage::store('blogs', $request->pictx)
                    ]);

                }//END check if request uploaded picture


                //insert new tags
                if( $request->tags ){

                    foreach($request->tags as $key=> $v){

                        PostTag::create([
                            'fk_posts'=> $blogs->pk_posts,
                            'fk_tags'=> $v,
                            'created_at'=> Carbon::now(),
                            'fk_createdby'=> Auth::id()
                        ]);

                    }

                }//END $request->tags


                session()->flash('success', "$request->name has been created!");
                return redirect()->back();



            });//END transaction

            return $transaction;

          
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);
        }

    }//END store



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/admin/blogs');
   
    }//END show


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(3003)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $blogs = Post::where('pk_posts', $id)->where('type', $this->posttype)->first();


        if( !$blogs ){
            return redirect('/admin/404');
        }

        $msctags = PostTag::getActiveTags($id);

        //dd($msctags);

        return view('admin.blogs.edit', compact('blogs', 'msctags'));

    }//END edit


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());

        //check if user has access
        if(!User::isUserHasAccess(3003)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $blogs = Post::findOrFail($id);

        $request['pk_posts'] = $blogs->pk_posts;
        $request['type'] = $this->posttype;


        $validator = Post::custom_validation($request, 'update');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $blogs, $id) {

               
                $isexists = Post::where('type', $this->posttype)
                            ->where('slug', $request->slug)
                            ->where('pk_posts', '<>', $id)
                            ->first();

                if( $isexists ){
                    return redirect()->back()->withInput()->withErrors(['Slug already exists']);
                }

                $isexists = Post::where('type', $this->posttype)
                            ->where('name', $request->name)
                            ->where('pk_posts', '<>', $id)
                            ->first();

                if( $isexists ){
                    return redirect()->back()->withInput()->withErrors(['Blog name already exists']);
                }


                //dd($request->all());

                $request['fk_updatedby'] = Auth::id();
                $blogs->update($request->all());

                //if request uploaded picture
                if( $request->pictx ){

                    //update DB for correct filename @pictx
                    $blogs->update([
                        'pictx'=> AppStorage::store('blogs', $request->pictx)
                    ]);

                }//END check if request uploaded picture

                //delete old tags
                PostTag::where('fk_posts', $id)->delete();
                //insert new tags
                if( $request->tags ){

                    foreach($request->tags as $key=> $v){

                        PostTag::create([
                            'fk_posts'=> $id,
                            'fk_tags'=> $v,
                            'created_at'=> Carbon::now(),
                            'fk_createdby'=> Auth::id()
                        ]);

                    }

                }//END $request->tags


                session()->flash('success', "$request->name has been updated!");
                return redirect()->back();




            });//END transaction

            return $transaction;


        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);

        }

    }//END update



}//END class
