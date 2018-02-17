@extends('proposal::template.html')

@section('title')
    Proposta #{{$proposal->id}} - {{$proposal->name}}
@stop
@section('extra_css')
    <link rel="stylesheet" type="text/css" href="http://www.electricprism.com/aeron/slideshow/css/slideshow.css" media="screen" />
    <style type="text/css">
        a { color: #404040; }
        a:hover { text-decoration: none; }
        code { color: #404040; font: normal 10px Monaco, monospace; }
        em { color: #808080; font-style: normal; }
        h1 { color: #000; font: normal 12px/16px Arial, sans-serif; padding: 0 20px 16px; text-transform: lowercase; }
        h1:before { content: '.'; }
        p { color: #404040; font: normal 12px/16px Arial, sans-serif; padding: 0 20px 16px; }

        /* Overriding the default Slideshow thumbnails for the vertical presentation */

        .slideshow-thumbnails {
            height: 300px;
            left: auto;
            right: -80px;
            top: 0;
            width: 70px;
        }
        .slideshow-thumbnails ul {
            height: 500px;
            width: 70px;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3>Proposta #{{$proposal->id}} - {{$proposal->name}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-sm-6">
                        <div id="show" class="slideshow col-sm-12">
                            <img src="/images/large/{{$proposal->pictures[0]->url}}" width="400" height="300" alt="Slideshow 2! Example 1: Basic fading show" />
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <p>
                            <strong>Nome:</strong> {{$proposal->name}}<br>
                            <strong>CPF:</strong> {{$proposal->name}}<br>
                            <strong>Profissão:</strong> {{$proposal->profession->name}}<br>
                            <strong>Lougradouro:</strong> {{$proposal->address}}<br>

                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('extra_js')
    <script type="text/javascript" src="http://www.electricprism.com/aeron/slideshow/js/mootools.js"></script>
    <script type="text/javascript" src="http://www.electricprism.com/aeron/slideshow/js/slideshow.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        window.addEvent('domready', function(){
            var data = {
                @foreach($proposal->pictures as $picture)
                '{{$picture->url}}': { caption: '{{$picture->title}}'},
                @endforeach
            };
            var myShow = new Slideshow('show', data, { captions: true, controller: false, height: 300, hu: '/images/large/', thumbnails: true, width: 400 });
        });
        //]]>
    </script>
@stop