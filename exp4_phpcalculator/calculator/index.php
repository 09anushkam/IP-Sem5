<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #282c34;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #ffffff;
        }
        .calculator {
            background-color: #3b3f47;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            width: 320px;
            text-align: center;
        }
        .calculator input, .calculator select, .calculator button {
            margin: 15px 0;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            border: 1px solid #575c66;
            border-radius: 6px;
            background-color: #484c54;
            color: #fff;
            box-sizing: border-box;
        }
        .calculator button {
            background-color: #61dafb;
            color: #282c34;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .calculator button:hover {
            background-color: #21a1f1;
        }
        h2 {
            margin-top: 20px;
            color: #61dafb;
        }
    </style>
</head>
<body>

<div class="calculator">
    <form id="calculatorForm" method="post">
        <input type="number" name="num1" placeholder="Enter first number" required>
        <select name="operation" required>
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num2" placeholder="Enter second number" required>
        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = 0;

        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = "Division by zero is not allowed.";
                }
                break;
            default:
                $result = "Invalid operation selected.";
                break;
        }

        echo "<h2 id='result'>Result: $result</h2>";
    }
    ?>
</div>

</body>
</html>
