<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

use App\MyHelperClass;

class PostCommentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    
        return [
            'pk_postcomments'=> $this->pk_postcomments,
            'fk_posts'=> $this->fk_posts,
            'name'=> $this->name,
            'email'=> $this->email,
            'comments'=> $this->comments,
            'created_at_formatted'=>  date_format( date_create($this->created_at), 'd M, Y' ),
            'timeago'=> MyHelperClass::timeago($this->created_at)
        ];

        //return parent::toArray($request);
    }

}//END class
