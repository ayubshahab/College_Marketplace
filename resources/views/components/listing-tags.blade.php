@props(['tags'])

<ul class = "unordered-tags-list">
    @foreach($tags as $tag)
        <li class="tags-list-item">
            <a href="/shop/listings?tag={{$tag}}">
                {{$tag}}
            </a>
        </li>
    @endforeach
</ul> 