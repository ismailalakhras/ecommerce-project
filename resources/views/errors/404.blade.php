<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 | Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #2f3542;
        }

        .container {
            text-align: center;
        }

        .error-code {
            font-size: 150px;
            font-weight: bold;
            color: #ff4757;
            margin: 0;
        }

        .message {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .description {
            font-size: 16px;
            color: #57606f;
            margin-bottom: 30px;
        }

        .btn-home {
            padding: 12px 24px;
            background-color: #1e90ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #3742fa;
        }

        .illustration {
            width: 600px;
            margin: 20px auto;
        }

        @media (max-width: 600px) {
            .error-code {
                font-size: 90px;
            }
            .illustration {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <img class="illustration" src="{{asset('images/404-Error.svg')}}" alt="Page not found illustration">
     
        <div class="description">The page you are looking for might have been removed or is temporarily unavailable.</div>
        
        <br>
    </div>
</body>
</html>
