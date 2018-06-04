<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-bar">
                <div class="left-section">
                    Wars
                    <h5>Pick your favourite</h5>
                </div> 
                <div class="right-section">
                    <a class="btn btn-primary" href="/highscore">Highscore</a>
                </div>
            </div>
            @foreach ($votables as $value)
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header">{{$value->type}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{$value->name}}</h5>
                    <p class="card-text">
                        @if(!empty($value->img))
                            <img src="{{$value->img}}" />
                        @else
                            <img src="http://www.a1delidelights.com.au/wp-content/uploads/2017/08/noimagefound.png" />
                        @endif
                    </p>
                    <a href="#" class="btn btn-primary votable" data-url="{{$value->url}}">Vote</a>
                </div>
            </div>
            @endforeach
        </div>
        @if(!empty($successArray))
            <div class="alert alert-success">
                You have successfully added a plus vote for {{ $successArray['upVoteObject']->name}} it's rating is now {{ $successArray['upVoteObject']->rating}}
            </div>
            <div class="alert alert-danger">
                You have successfully added a minus vote for {{ $successArray['downVoteObject']->name}} it's rating is now {{ $successArray['downVoteObject']->rating}}
            </div>
        @endif
        <script type="text/JavaScript" src="/js/app.js"></script>
    </body>
</html>