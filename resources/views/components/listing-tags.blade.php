@props(['listingTags'])

@php
    $tags = explode(", ", $listingTags);
@endphp

<ul class = "unordered-tags-list">
    @foreach($tags as $tag)
        <li class="tags-list-item">
            <a href="/tag/?tag={{$tag}}">
                {{$tag}}
            </a>
        </li>
    @endforeach
</ul> 