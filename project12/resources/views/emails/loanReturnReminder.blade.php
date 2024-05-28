<!DOCTYPE html>
<html>
<head>
    <title>Return Product Reminder</title>
</head>
<body>
    <p>Dear {{ $loan->user->name }},</p>
    <p>This is a reminder to return the product you borrowed: {{ $loan->product->name }}.</p>
    <p>The due date for return is {{ $loan->due_date->format('F j, Y') }}.</p>
    <p>Thank you!</p>
</body>
</html>
