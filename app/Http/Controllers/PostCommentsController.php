<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\Post;
use App\PostTag;
use App\PostMstrView;

use App\PostComment;

use App\Http\Resources\PostCommentResource;

use App\User;


class PostCommentsController extends Controller
{
    //
    


    //call through api
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apireviews(Request $request, $id)
    {
        //

        //active tab
        $posts = Post::find($id);

        if( !$posts ){

        	return response()->json('post not found!', 404);

        }

        $reviews = PostComment::where('fk_posts', $posts->pk_posts)
                    ->orderBy('created_at', 'DESC')->paginate(10);

        return PostCommentResource::collection($reviews);

   
    }//END apisearch



    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post_reviews(Request $request, $id)
    {
        //
        //return $request->all();
    	$posts = Post::findOrFail($id);


        if( !$posts ){

        	return response()->json('post not found!', 404);

        }

        //request sent via ajax using serializeArray()
        //need to convert array into valid laravel request object
        foreach($request->all() as $v){
            $request[ $v['name'] ] = $v['value'];
        }

        $request['fk_posts'] = $id;

        //dd($request->all());
        $validator = PostComment::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $id) {

                //insert new review
                $reviews = PostComment::create($request->all());

                return $this->apireviews($request, $id);


            });//END transaction

            return $transaction;

          
        }
        else{

            return response()->json($validator->errors(), 404);
        }

    }//END post_reviews




}//END class
