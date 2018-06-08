@extends('layouts.frontend')

@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <article class="hentry post post-standard has-post-thumbnail sticky">

                    <div class="post-thumb">
                        <img src="{{$data['latest_post']->featured}}" alt="{{$data['latest_post']->title}}">
                        <div class="overlay"></div>
                        <a href="{{$data['latest_post']->featured}}" class="link-image js-zoom-image">
                            <i class="seoicon-zoom"></i>
                        </a>
                        <a href="#" class="link-post">
                            <i class="seoicon-link-bold"></i>
                        </a>
                    </div>

                    <div class="post__content">

                        <div class="post__content-info">

                            <h2 class="post__title entry-title ">
                                <a href="{{route('single.post', ['slug' => $data['latest_post']->slug])}}">{{$data['latest_post']->title}}</a>
                            </h2>

                            <div class="post-additional-info">

                                        <span class="post__date">

                                            <i class="seoicon-clock"></i>

                                            <time class="published" datetime="2016-04-17 12:00:00">
                                                {{$data['latest_post']->created_at->diffForHumans()}}
                                            </time>

                                        </span>

                                <span class="category">
                                            <i class="seoicon-tags"></i>
                                            <a href="{{route('single.category', ['id' => $data['latest_post']->category->id])}}">{{$data['latest_post']->category->name}}</a>
                                        </span>

                            </div>
                        </div>
                    </div>

                </article>
            </div>
            <div class="col-lg-2"></div>
        </div>

        <div class="row">
            @foreach($data['recent_posts'] as $recent_post)
                <div class="col-lg-6">
                    <article class="hentry post post-standard has-post-thumbnail sticky">

                        <div class="post-thumb">
                            <img src="{{$recent_post->featured}}" alt="{{$recent_post->title}}">
                            <div class="overlay"></div>
                            <a href="{{$recent_post->featured}}" class="link-image js-zoom-image">
                                <i class="seoicon-zoom"></i>
                            </a>
                            <a href="#" class="link-post">
                                <i class="seoicon-link-bold"></i>
                            </a>
                        </div>

                        <div class="post__content">

                            <div class="post__content-info">

                                <h2 class="post__title entry-title ">
                                    <a href="{{route('single.post', ['slug' => $recent_post->slug])}}">{{$recent_post->title}}</a>
                                </h2>

                                <div class="post-additional-info">

                                        <span class="post__date">

                                            <i class="seoicon-clock"></i>

                                            <time class="published" datetime="2016-04-17 12:00:00">
                                                {{$recent_post->created_at->toFormattedDateString()}}
                                            </time>

                                        </span>

                                    <span class="category">
                                            <i class="seoicon-tags"></i>
                                            <a href="{{route('single.category', ['id' => $recent_post->category->id])}}">{{$recent_post->category->name}}</a>
                                        </span>

                                </div>
                            </div>
                        </div>

                    </article>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid">
        <div class="row medium-padding80 bg-border-color">
            <div class="container">
                <div class="col-lg-12">

                    @for($i = 0; $i < sizeof($data['category']); $i++)
                        <div class="offers">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading">
                                        <h4 class="h1 heading-title">{{$data['category'][$i]->name}}</h4>
                                        <div class="heading-line">
                                            <span class="short-line"></span>
                                            <span class="long-line"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="case-item-wrap">
                                    @foreach($data['category_posts'][$i] as $post)
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="case-item">
                                                <div class="case-item__thumb">
                                                    <img src="{{$post->featured}}" alt="our case">
                                                </div>
                                                <h6 class="case-item__title"><a href="{{route('single.post', ['slug' => $post->slug])}}">{{$post->title}}</a></h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="padded-50"></div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

@stop