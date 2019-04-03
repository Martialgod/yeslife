<div class="col-lg-4 col-12 order-2 pl-30 pl-sm-15 pl-md-15 pl-xs-15">

    <div class="sidebar">

        <div class="sidebar">
            {{--<h4 class="sidebar-title">Search</h4> --}}
            <div class="sidebar-search">
                <form action="{{url('/blog')}}">
                    <input type="text" name="search" value="{{isset($search) ? $search : ''}}" placeholder="Enter key words">
                    <input type="submit" value="search">
                </form>
            </div>
        </div><!--END sidebar-->
        
        <div class="sidebar">

            <h4 class="sidebar-title">Recent Post</h4>

                <ul class="sidebar-post-list">

                    @foreach($recentposts as $key=> $v)

                        <li class="sidebar-post">
                       
                            <a href="blog-details.html" class="image">
                                <img src="{{asset('/storagelink/'.$v->pictx)}}" alt="">
                            </a>

                            
                            <div class="content">
                                <h4 class="title">
                                    <a href="{{url('/blog/'.$v->slug)}}"> {{$v->name}} </a>
                                </h4>
                                <p> {{$v->summary}} </p>

                                {{--<p style="font-size:12px;">
                                    By - {{$v->sourcename}}
                                    <br>{{ date_format( date_create($v->sourcedate), 'd M, Y' ) }}
                                </p> --}}
                            </div>



                        </li><!--END sidebar-post-->

                    @endforeach

                </ul><!--END sidebar-post-list-->
            
        </div><!--END sidebar-->
       
    
    </div><!--END sidebar-->

</div><!--END col-lg-4 col-12 order-2 pl-30 pl-sm-15 pl-md-15 pl-xs-15-->

