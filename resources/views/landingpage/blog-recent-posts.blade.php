  
<div class="sidebar">

    <h4 class="sidebar-title" style="text-align: center;" >Recent Post</h4>

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