
@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => $isArabic ? 'معرض الفيديوهات' : 'Video Gallery'])
<div class="m-5 p-5 content-wrapper">
    <div class="row">
        @forelse($videos as $video)
{{--
            @php
                $videoUrl = $video->video_url;
                $videoId = null;
                $queryString = parse_url($videoUrl, PHP_URL_QUERY);

                if ($queryString) {
                    parse_str($queryString, $params);
                    if (isset($params['v'])) {
                        $videoId = $params['v'];
                    }
                }
            @endphp
            @if ($videoId)
                <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/{{$videoId}}"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                </iframe>
            @else
                <p>Video URL is invalid or video ID could not be extracted.</p>
            @endif --}}
            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm border-0">
                    <div class="ratio ratio-16x9">
                        <video controls>
                            <source src="{{ $video->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            {{ $isArabic ? $video->title_ar : $video->title_en }}
                        </h5>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4>{{ $isArabic ? 'لا توجد فيديوهات حالياً.' : 'No videos available.' }}</h4>
            </div>
        @endforelse
    </div>
</div>
@endsection
