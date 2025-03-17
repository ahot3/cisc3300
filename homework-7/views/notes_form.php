<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Note</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { max-width: 400px; margin: auto; background: #f4f4f4; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: green; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        button:hover { background: darkgreen; }
    </style>
</head>
<body>
    <h1>Submit a New Note</h1>
    <form action="/submit" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit">Submit Note</button>
    </form>
</body>
</html>
