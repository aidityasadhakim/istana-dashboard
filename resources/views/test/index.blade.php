<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                {{$sales->paymentmethods->name}}
                {{-- @foreach ($sales->paymentmethods as $method)
                    {{$method->name}}
                @endforeach --}}
                <p>
                    @foreach ($user->sales as $sale)
                    {{$sale->id}}
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</body>
</html>