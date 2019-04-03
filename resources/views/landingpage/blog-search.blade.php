<div class="sidebar">
    {{--<h4 class="sidebar-title">Search</h4> --}}
    <div class="sidebar-search">
        <form action="{{url('/blog')}}">
            <input type="text" name="search" value="{{isset($search) ? $search : ''}}" placeholder="Enter key words">
            <input type="submit" value="search">
        </form>
    </div>
</div><!--END sidebar-->
