<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
</head>

<body>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="text" name="num1" placeholder="Number 1">
        <input type="text" name="num2" placeholder="Number 2">
        <select name="operator" id="">
            <option selected value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="multiply">Multiply</option>
            <option value="divide">Divide</option>
        </select>
        <button type="submit" name="submit" value="submit">Calculate</button>
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // get the values from the form
        //sanitize data to prevent security threats
        //FILTER_SANITIZE_NUMBER_FLOAT only allows for whole numbers, not letter or other chars allowed, this caused an issue for me when trying to figure out why strings were returning an empty "" value, now we know.
        $num1 = filter_input(INPUT_POST, 'num1', FILTER_SANITIZE_NUMBER_FLOAT);
        $num2 = filter_input(INPUT_POST, 'num2', FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST['operator']);
        var_dump($num1);
        var_dump($num2);
        //var_dump($operator);

        // check if the input values are not empty
        $error = false;

        //This function returns true if input is 0 or input is any truthy value
        function notempty($var)
        {
            return ($var === "0" || $var);
        }

        $num1Valid = notempty($num1);
        $num2Valid = notempty($num2);

        if ($num1Valid === false || $num2Valid === false) {
            $error = true;
            echo "<p class= 'error-msg'>Please fill in all fields with whole numbers! Try again.</p>";
        }

        //check if values are numbers
        if (!is_numeric($num1) || !is_numeric($num2)) {
            $error = true;
            echo "<p class= 'error-msg'>Please use numbers! Try again.</p>";
        }


        // check if the input values for operator is valid
        $valid_operators = ["add", "subtract", "multiply", "divide"];

        if (!in_array($operator, $valid_operators)) {
            $error = true;
            echo "<p class= 'error-msg'>Error within the operator selector! Try again.</p>";
        }


        //divide by 0 not allowed
        if ($operator === "divide" && $num2 === "0") {
            $error = true;
            echo "Dividing by 0 not permitted! Try again.";
        }

        //adds received values if error === false

        if ($error === false) {
            switch ($operator) {
                case "add":
                    echo "<p class= 'total'>Number one (" . $num1 . ") + number two  (" . $num2 . ") = " . $num1 + $num2 . ".</p>";
                    break;
                case "subtract":
                    echo "<p class= 'total'>Number one - number two = " . $num1 - $num2 . ".</p>";
                    break;
                case "multiply":
                    echo "<p class= 'total'>Number one x number two = " . $num1 * $num2 . ".</p>";
                    break;
                case "divide":
                    echo "<p class= 'total'>Number one / number two = " . $num1 / $num2 . ".</p>";
                    break;
                default:
                    echo "Uh-oh, try again!";
                    break;
            }
        }
    }

    ?>

</body>

</html>