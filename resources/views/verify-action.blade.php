<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-accept {
            background-color: #4CAF50;
            color: #fff;
        }
        .btn-reject {
            background-color: #f44336;
            color: #fff;
        }
        .btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Action Verification</h1>
        <p>Please verify your action before proceeding.</p>
        <div class="btn-container">
            <form action="{{ route('verify-action') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-accept" name="accept">Accept</button>
                <button type="submit" class="btn btn-reject" name="reject">Reject</button>
            </form>
        </div>
    </div>
</body>
</html>
