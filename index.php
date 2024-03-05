<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">

        <input type="text" name="num1" placeholder="Number 1">
        <input type="text" name="num2" placeholder="Number 2">
        <select name="operator" id="">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="multiply">Multiply</option>
            <option value="divide">Divide</option>
        </select>
        <button type="submit" name="submit" value="submit">Calculate</button>
    </form>
</body>
</html>