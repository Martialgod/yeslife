<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; //responsible for DB

use Carbon\Carbon;

use App\Post;
use App\PostMstrView;

use App\User;


class PublicBlogController extends Controller
{
    //
    	
	public $posttype = 'Blog';


    public function setActiveTab(){
        session()->flash('active_tab', 'Blog');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
 
        $blogs = PostMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        /*if( $search ){

            $blogs->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });

        }*/

        $blogs->where('type', $this->posttype);

        $blogs = $blogs->orderBy('sourcedate', 'DESC')
        		->where('stat', 'Posted')
        		->orderBy('name', 'ASC')->paginate(10);

        return view('landingpage.blog', compact('blogs', 'search'));

    }//END index


     /**
     * Show the form for listing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
   
        $blogs = Post::where('slug', $slug)
        		->where('type', $this->posttype)
        		->where('stat', 'Posted')
        		->first();


        if( !$blogs ){
            return redirect('/404');
        }


        return view('landingpage.blog-details', compact('blogs'));

    }//END show




}//END class
