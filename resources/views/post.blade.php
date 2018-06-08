@extends('layouts.frontend')

@section('content')
    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">{{$data['post']->title}}</h1>
        </div>
    </div>

    <div class="container">
        <div class="row medium-padding120">
            <main class="main">
                <div class="col-lg-10 col-lg-offset-1">
                    <article class="hentry post post-standard-details">

                        <div class="post-thumb">
                            <img src="{{$data['post']->featured}}" alt="{{$data['post']->title}}">
                        </div>

                        <div class="post__content">


                            <div class="post-additional-info">
                                <div class="post__author author vcard">
                                    Posted by

                                    <div class="post__author-name fn">
                                        <a href="#" class="post__author-link">Admin</a>
                                    </div>

                                </div>

                                <span class="post__date">

                                    <i class="seoicon-clock"></i>

                                    <time class="published" datetime="2016-03-20 12:00:00">
                                        {{$data['post']->created_at->toFormattedDateString()}}
                                    </time>

                                </span>

                                <span class="category">
                                    <i class="seoicon-tags"></i>
                                    <a href="{{route('single.category', ['id' => $data['post']->category->id])}}">{{$data['post']->category->name}}</a>
                                </span>

                            </div>

                            <div class="post__content-info">

                                {!! $data['post']->content !!}

                                <div class="widget w-tags" style="margin-top: 40px;">
                                    <div class="tags-wrap">
                                        @foreach($data['post']->tags as $tag)
                                            <a href="{{route('single.tag', ['id' => $tag->id])}}" class="w-tags-item">{{$tag->tag}}</a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="socials">
                            <div class="addthis_inline_share_toolbox_z5f8"></div>
                        </div>

                    </article>

                    <div class="blog-details-author">

                        <div class="blog-details-author-thumb post-user-avatar">
                            <img src="{{asset($data['user']->profile->avatar)}}" alt="Author">
                        </div>

                        <div class="blog-details-author-content">
                            <div class="author-info">
                                <h5 class="author-name">{{$data['user']->name}}</h5>
                                <p class="author-info">
                                    @if ($data['user']->admin)
                                        Admin
                                    @else
                                        User
                                    @endif
                                </p>
                            </div>
                            <p class="text">
                                @if ($data['user']->profile != null)
                                    {{$data['user']->profile->about}}
                                @endif
                            </p>
                            <div class="socials">

                                <a href="{{$data['user']->profile->facebook}}" class="social__item" target="_blank">
                                    <img src="{{asset("app/svg/circle-facebook.svg")}}" alt="facebook">
                                </a>

                                <a href="{{$data['user']->profile->youtube}}" class="social__item" target="_blank">
                                    <img src="{{asset("app/svg/youtube.svg")}}" alt="youtube">
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="pagination-arrow">

                        @if ($data['prev_post'])
                            <a href="{{route('single.post', ['slug' => $data['prev_post']->slug])}}" class="btn-prev-wrap">
                                <svg class="btn-prev">
                                    <use xlink:href="#arrow-left"></use>
                                </svg>
                                <div class="btn-content">
                                    <div class="btn-content-title">Previous Post</div>
                                    <p class="btn-content-subtitle">{{$data['prev_post']->title}}</p>
                                </div>
                            </a>
                        @endif

                        @if ($data['next_post'])
                            <a href="{{route('single.post', ['slug' => $data['next_post']->slug])}}" class="btn-next-wrap">
                                <div class="btn-content">
                                    <div class="btn-content-title">Next Post</div>
                                    <p class="btn-content-subtitle">{{$data['next_post']->title}}</p>
                                </div>
                                <svg class="btn-next">
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </a>
                        @endif

                    </div>

                    <div class="comments">
                        <div class="heading text-center">
                            <h4 class="h1 heading-title">Comments</h4>
                            <div class="heading-line">
                                <span class="short-line"></span>
                                <span class="long-line"></span>
                            </div>
                        </div>
                    </div>

                    @include('inc.disqus')

                </div>

                <!-- End Post Details -->

                <!-- Sidebar-->
                <div class="col-lg-12" style="margin-top: 50px;">
                    <aside aria-label="sidebar" class="sidebar sidebar-right">
                        <div  class="widget w-tags">
                            <div class="heading text-center">
                                <h4 class="heading-title">ALL BLOG TAGS</h4>
                                <div class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                </div>
                            </div>

                            <div class="tags-wrap">
                                @foreach($data['tags'] as $tag)
                                    <a href="{{route('single.tag', ['id' => $tag->id])}}" class="w-tags-item">{{$tag->tag}}</a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </div>
@endsection