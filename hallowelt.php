<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction</title>
</head>
<body>

    <?php
            
        $userName;
        $user_name;

        $century = 20;
        $name = "Jack $century";

        echo $name . '<br/>';
        echo 'Hello world! <br/>';
        echo 'Hello $name <br/>';
        echo "Hello $name <br/>";
        echo 'Сумма чисел: 3 + 2 = ' . 3 + 2 . "<br/>";
        echo "$name was born in the {$century}th century <br/>";
        var_dump($name);

    ?>
    
</body>
</html>