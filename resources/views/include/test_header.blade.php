<ul>

@isset($links)    @foreach($links as $link)
        <li><a href="{{$link['href']}}">{{$link['text']}}</a></li>
    @endforeach
    @endif
</ul>
