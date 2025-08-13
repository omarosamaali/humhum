<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>مكونات الوصفة</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .back--btn {
            background: #000000;
            width: 50px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            border-radius: 50%;
        }

        .back--btn i {
            font-size: 23px;
            color: white;
        }

        .dz-card.list {
            margin-bottom: 0px;
        }

    </style>
    <style>
        :root {
            --primary: #dc3545;
            --secondary: #f8f9fa;
            --danger: #dc3545;
            --success: #28a745;
            --light: #fff;
            --dark: #333;
            --border: #e9ecef;
        }

        body {
            font-family: 'Cairo', sans-serif;
            font-size: 17px;
            line-height: 1.5;
            background-color: #f5f5f5;
            color: #4a4a4a;
            direction: rtl;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        .header {
            background-color: var(--light);
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 60px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            height: 100%;
        }

        .header .title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        .back-btn {
            color: var(--primary);
            text-decoration: none;
            font-size: 18px;
        }

        .page-content {
            padding-top: 80px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .ingredient-item {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .ingredient-item[data-type="heading"] h4 {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--primary);
            display: inline-block;
        }

        .ingredient-item[data-type="ingredient"] p {
            font-size: 1rem;
            margin: 0;
            color: #555;
            padding-right: 15px;
            position: relative;
        }

        .ingredient-item[data-type="ingredient"] p::before {
            content: "\2022";
            /* Bullet point */
            color: var(--primary);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-right: -1em;
        }

    </style>
</head>

<body class="bg-light">
    <div class="page-wrapper">
        <header class="header">
            <div class="header-content">
                <div class="mid-content">
                    <h4 class="title">مكونات الوصفة</h4>
                </div>
                <div class="left-content">
                    <a href="{{ url()->previous() }}" class="back--btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </div>
            </div>
        </header>

        <main class="page-content" style="margin-top: 15px;">
            @if(isset($recipe->ingredients) && !empty($recipe->ingredients))
            @php
            $lines = explode("\n", $recipe->ingredients);
            @endphp
            @foreach($lines as $line)
            @php
            $trimmedLine = trim($line);
            @endphp
            @if(!empty($trimmedLine))
            @if(\Illuminate\Support\Str::startsWith($trimmedLine, '##'))
            <div class="ingredient-item" data-type="heading">
                <h4>{{ \Illuminate\Support\Str::replaceFirst('##', '', $trimmedLine) }}</h4>
            </div>
            @else
            <div class="ingredient-item" data-type="ingredient">
                <p>{{ $trimmedLine }}</p>
            </div>
            @endif
            @endif
            @endforeach
            @else
            <p>لا توجد مكونات لهذه الوصفة.</p>
            @endif
        </main>
    </div>
</body>


</html>
