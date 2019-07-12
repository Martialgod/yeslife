  
<div class="sidebar">

    <h4 class="sidebar-title" style="text-align: center;" >Recent Post</h4>

    <ul class="sidebar-post-list">

        @foreach($recentposts as $key=> $v)

            <li class="sidebar-post">

                {{--<a href="blog-details.html" class="images">
                    <img src="{{asset('/storagelink/'.$v->pictx)}}" alt="">
                </a>

                <div class="content">
                    <h4 class="title">
                        <a href="{{url('/blog/'.$v->slug)}}"> {{$v->name}} </a>
                    </h4>


                    <p> {{$v->summary}} </p>
                </div> --}}

                <div class="row">
                    

                    <div class="col-md-4">
                        <a href="{{url('/blog/'.$v->slug)}}">
                            <img src="{{asset('/storagelink/'.$v->pictx)}}" alt="">
                        </a>
                    </div>

                    <div class="col-md-8">

                        <h4 class="title">
                            <a href="{{url('/blog/'.$v->slug)}}"> {{$v->name}} </a>
                        </h4>


                        <p> {{$v->summary}} </p>

                        
                    </div>


                </div>


            </li><!--END sidebar-post-->

        @endforeach

    </ul><!--END sidebar-post-list-->

</div><!--END sidebar-->