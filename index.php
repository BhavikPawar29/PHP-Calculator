<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

    <input type="text" id="num1" name="number1" required placeholder="Enter First Number"><br>

    <select name="operator">

        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">x</option>
        <option value="divide">/</option>

    </select><br>

    <input type="text" id="num2" name="number2" required placeholder="Enter Second Number"><br>

    <button type="submit">Calculate</button>
</form>

            <?php
            // Check if the form has been submitted
            if($_SERVER["REQUEST_METHOD"] == "POST"){

                //Grab data from the inputs

                $num_1 = filter_input(INPUT_POST, "number1", FILTER_SANITIZE_NUMBER_FLOAT);
                $num_2 = filter_input(INPUT_POST, "number2", FILTER_SANITIZE_NUMBER_FLOAT);
                $operator = htmlspecialchars($_POST["operator"]);

                //Error Handlers

                $errors = false;

                if(empty($num_1) || empty($num_2) || empty($operator)){
                    echo "<p class='calc-error'> Fill in the fields!!";
                    $errors = true;
                }

                if(!is_numeric($num_1) || !is_numeric($num_2)){
                    echo "<p class='calc-error'> Only numbers are allowed!";
                    $errors = true;
                }

                // Calculate the numbers

                if(!$errors){
                    $value = 0;
                    switch ($operator){
                        case 'add':
                            $value = $num_1 + $num_2;
                            break;
                        case 'subtract':
                            $value = $num_1 - $num_2;
                            break;
                        case 'multiply':
                            $value = $num_1 * $num_2;
                            break;
                        case 'divide':
                            // Check if the second number is not zero before division
                            if ($num_2 != 0) {
                                $value = $num_1 / $num_2;
                            } else {
                                echo "<p class='calc-error'> Cannot divide by zero!";
                                $errors = true;
                            }
                            break;
                        default:
                            echo "<p class='calc-error'> Something went HORRIBLY wrong!";
                    }
                }

                // Display the result only if there are no errors
                if(!$errors){
                    echo "<p class='calc-result'>Result = ". $value ."</p>";
                }

            }

?>
</body>
</html>
