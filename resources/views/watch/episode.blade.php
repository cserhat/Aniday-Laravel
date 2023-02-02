


@extends('layouts.app')
@section('content')
<div class="container">
<div class="Fansub">
            <select name="Fanbub" class="fansub_select">

                @foreach($list as $lists)          
                <option value="watch/{{$lists->episode_slug}}/{{$lists->anime_id}}" value="Next">{{ $lists->episode_title }}</option>
                @endforeach
                
            </select>
        </div>
        @foreach ($episode as $list)
        <div class="Episiode"><h2>{{ $list->anime_title }} - {{ $list->episode_title }}</h2></div>
        @break
        @endforeach
        <div id="Video">
        <iframe src="" id="video-iframe" class="video"></iframe>
        </div>

        </iframe></div>
        <div class="Info-area">
            @foreach($episode as $iframe)
            <button id="video-link" data-link="{{ $iframe->iframe_link }}">{{ $iframe->iframe_title}}</button>
            @endforeach
        </div>
        <div class="Status">
        <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://nextfansub.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </div>
    </div>
</div>
    <script>
    const buttons = document.querySelectorAll('.video-link');
    const iframe = document.querySelector('#video-iframe');

    buttons.forEach(button => {
        button.addEventListener('click', event => {
            iframe.src = event.target.dataset.link;
        });
    });
</script>
@endsection