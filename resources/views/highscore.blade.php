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
                    <h5>Highscore</h5>
                </div> 
                <div class="right-section">
                    <a class="btn btn-primary" href="/">Play</a>
                </div>
            </div>
            <div class="list-group">
                @foreach ($highscoreArray as $value)
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex justify-content-between">
                          <div class="mb-1">
                              <h5>{{$value->name}}</h5>
                              <p class="mb-1">{{$value->type}}</p>
                              <small>Votes {{$value->votes_count}}</small><br>
                              <small>Rating {{$value->rating}}</small>
                          </div>
                          @if(!empty($value->img))
                              <img src="{{$value->img}}" />
                          @else
                              <img src="http://www.a1delidelights.com.au/wp-content/uploads/2017/08/noimagefound.png" />
                          @endif
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar" role="progressbar" style="width: {{$value->votes_count/30*100}}%;" aria-valuenow="{{$value->votes_count}}" aria-valuemin="0" aria-valuemax="30"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
        <script type="text/JavaScript" src="/js/app.js"></script>
    </body>
</html>