<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b5fae6e147.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
    <link rel="stylesheet" href="{{ URL::asset('resources/css/style.css') }}">
</head>
<body>
<div class="login">
    <h1><i class="fab fa-gg" style="color:white"></i> Currency Converter</h1>
    <form method="POST">
    	{{ csrf_field() }}
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Amount" name="amount">
            </div>
            <div class="col">
                <select id="fromCode" name="fromCode" class="form-control">
                    <option selected>FROM</option>
                   		@foreach($currencyCodes as $code => $name)
						    <option value="{{$code}}">{{$name}} ({{$code}})</option>
						@endforeach
                </select>
            </div>
            <i class="fas fa-exchange-alt fa-2x" style="color:white"></i>
            <div class="col">
                <select id="toCode" name="toCode" class="form-control">
                    <option selected>TO</option>
                    @foreach($currencyCodes as $code => $name)
						    <option value="{{$code}}">{{$name}} ({{$code}})</option>
						@endforeach
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block btn-large"><i class="fas fa-angle-right"></i>
                </button>
            </div>
        </div>
    </form>

	@if (isset($action))
    <div class="result">
        <center>
            <h3>{{$convertedPrice}}</h3>
            {{$fromUnitPrice}}
            <i class="fas fa-exchange-alt"></i>
            {{$toUnitPrice}}
        </center>
    </div>
    @endif
</div>

</body>
</html>