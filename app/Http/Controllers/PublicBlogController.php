<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; //responsible for DB

use Carbon\Carbon;

use App\Post;
use App\PostMstrView;

use App\PostTag;
use App\Tag;

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

        $tags = ( request()->tags ) ? request()->tags : null;

        if( $search ){

            $blogs->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });

        }


        if( $tags ){

            $blogs->where(function ($query) use ($tags) {
                $query->where('tags', 'like', "%$tags%");
            });

        }

        $blogs->where('type', $this->posttype);

        $blogs = $blogs->orderBy('sourcedate', 'DESC')
        		->where('stat', 'Posted')
        		->paginate(10);


        $posttags = Tag::where('stat',1)->orderBy('name', 'ASC')->pluck('name')->toArray();
        $hreftags = [];
        foreach($posttags as $key=> $v){
            $hreftags [] = "<a href='/blog?tags=$v'> $v </a>";
        }

        $stringtags = implode(', &nbsp;', $hreftags);

        return view('landingpage.blog', compact('blogs', 'search', 'tags', 'stringtags'));

    }//END index


     /**
     * Show the form for listing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
   
        $blogs = PostMstrView::where('slug', $slug)
        		->where('type', $this->posttype)
        		->where('stat', 'Posted')
        		->first();

       	if( !$blogs ){
            return redirect('/404');
        }

        $search = ( request()->search ) ? request()->search : null;


        $tagsarray = explode(',', $blogs->tags);
        $tags = [];
        foreach($tagsarray as $key => $v){
            $tags[] = "<a href='/blog?tags=$v'> $v </a>";
        }

        $recentposts = PostMstrView::recentPosts($this->posttype, $blogs->pk_posts);

        $cursor = PostMstrView::cursor($this->posttype, $blogs, 'prev');
        //dd($cursor);

        return view('landingpage.blog-details', compact('blogs', 'search', 'tags', 'recentposts', 'cursor'));

    }//END show




}//END class
