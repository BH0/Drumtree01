@extends('layouts.master')
@section('content')
    <h1>Items For Sale</h1> 
    <div class="sort"> 
        <select name="sort" id="sort-drowndown-options"> 
            <option value="newest" selected="yes">newest</option> 
            <option value="cheapest"><a href="{{ route('cheapest') }}">cheapest</a></option>
            <!-- <option>Nearest</option> --> 
        </select> 
        <button id="sort-button">Sort</button> 
    </div> 
    <div class="drums"> 
        @foreach($drums as $drum) 
            <article class="drum" data-drumId="{{ $drum->id }}"> 
                <h3>{{ $drum->drumname }}</h3> 
                @if(Storage::disk('local')->has($drum->drumname . '-' . $drum->drumname . '.jpg'))
                    <div class="drum-image"> 
                        <section>
                                <!-- increase image size on hover over image (with CSS/JS) --> 
                                <img src="{{ route('drum.image', ['filename' => $drum->drumname . '-' . $drum->drumname . '.jpg']) }}" alt="drum image" width="120" height="120"> 
                        </section>
                    </div> 
                @else 
                    <b>No image</b> 
                @endif 

                <b><h5>${{ $drum->cost}}</h5></b> 
                <p>Location [Settlement-name]: <b>{{ $drum->locaiton }}</b> </p>  
                <p>{{ $drum->body }}</p> 
                <!-- $drum->user_id  should  become $drum->user->username  -->  
                <p>Posted by <b>{{ $drum->user_id }}</b> on <b>{{ $drum->created_at }}</b></p> 
                <b>Contact: {{ $drum->contact }}</b> 
                    <a href="#" class="bookmark">{{ Auth::user()->bookmarks()->where('drum_id', $drum->id)->first() ? Auth::user()->bookmarks()->where('drum_id', $drum->id)->first()->bookmark == 1 ? 'bookmarked' : 'bookmark' : 'bookmark'  }}</a> |
                    <!-- @ if(Auth::user() == $drum->user)
                        <a href="#">Delete item [to do] </a> 
                    @ endif --> 
            </article>
        @endforeach
    </div> 

    <script> 
        let token = '{{ Session::token() }}';
        let urlBookmark = '{{ route('bookmark') }}'; 

        /// Sort [Drums] 
        let urlNewest = '{{ route('drums') }}'; 
        let urlCheapest = '{{ route('cheapest') }}'; 
    </script> 

 @endsection 
