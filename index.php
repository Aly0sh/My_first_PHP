<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <title>My Site</title>

    <style>
        body {
            font-family: "Roboto Slab", serif;
            background-color: #EAEDF8;
            margin: 0;
        }

        .footer {
            text-align: center;
            padding: 100px;
            background-color: #343434;
            color: #f1f1f1;
        }

        .main {
            display: flex;
            align-items: start;
        }

        .menu {
            width: 20%;
            background-color: #746cf5;
            margin-right: 32px;
            padding-top: 150px;
            height: 100vh;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 8px;
            display: flex;
            align-items: center;
        }

        .menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu img {
            margin-right: 8px;
            fill: #f1f1f1;
            color: #f1f1f1;
        }

        .content {
            width: 80%;
            margin-top: 120px;
            margin-right: 32px;
            background-color: #f1f1f1;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
        }


        .menubar {
            background-color: #f1f1f1;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 80px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
            padding-left: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .avatar {
            border-radius: 100%;
            background-color: yellowgreen;
            padding: 16px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .myname {
            display: flex;
            margin-right: 50px;
            align-items: center;

        }

        .card {
            background-color: rgba(0, 0, 0, 0.05);
            margin-bottom: 16px;
            border-radius: 8px;
            padding: 8px;
            padding-left: 64px;
            position: relative;
        }

        .card-name {
            margin-bottom: 10px;
            display: block;
        }

        .profile-picture {
            position: absolute;
            left: 8px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid #ffffff;
        }

        .phonebtn {
            background-color: #999900;
            padding: 4px;
            color: #f1f1f1;
            text-decoration: none;
            border-radius: 4px;
            position: absolute;
            right: 0px;
            top: 0px;
        }

        .phonebtn:hover {
            background-color: #26D026;
        }
        
        .deletebtn {
            background-color: #CD5C5C;
            padding: 4px;
            color: #f1f1f1;
            text-decoration: none;
            border-radius: 4px;
            position: absolute;
            right: 0px;
            bottom: 0px;
            font-family: "Roboto Slab", serif;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .deletebtn:hover {
            background-color: #FA8072;
        }

        .form-input {
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 16px;
            width: 200px;
        }

        .form-btn {
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 16px;
            width: 216px;
            background-color: #229954;
            color: #f1f1f1;
            font-weight: bold;
            cursor: pointer;
        }

        
        .form-btn:hover {
            background-color: #148F77;
        }

    </style>    

</head>
<body>

    <div class="menubar">
        <h1>My Contact Book</h1>

        <div class="myname">
            <div class="avatar">KA</div>
            Alaken Kubatbekov
        </div>
    </div>

    <div class="main">
        <div class="menu">
            <a href="index.php?page=start"><img src="img/home.svg"/> Start</a>
            <a href="index.php?page=contacts"><img src="img/book.svg"/> Kontakte</a> 
            <a href="index.php?page=addcontact"><img src="img/add.svg"/> Kontakt hinzufügen</a> 
            <a href="index.php?page=legal"><img src="img/legal.svg"/> Impressum</a>
        </div>

        <div class="content">
            <?php
                $headline = 'Herzlich willkommen';
                $contacts = [];

                if (file_exists('./res/contacts.txt')) {
                    $contacts = json_decode(file_get_contents('./res/contacts.txt', true), true);
                }

                if (isset($_GET['delete'])) {
                    array_splice($contacts, $_GET['delete'], $_GET['delete']);
                    file_put_contents('./res/contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
                }

                if (isset($_POST['name']) && isset($_POST['phone'])) {
                    echo 'Kontakt <b>' . $_POST['name'] . '</b> wurde hinzugefügt!';
                    $newContact = [
                        'name' => $_POST['name'],
                        'phone' => $_POST['phone']
                    ];
                    array_push($contacts, $newContact);
                    file_put_contents('./res/contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
                }

                if ($_GET['page'] == 'contacts') {
                    $headline = 'Deine Kontakte';
                } else if ($_GET['page'] == 'addcontact') {
                    $headline = 'Kontakt hinzufügen';
                } else if ($_GET['page'] == 'legal') {
                    $headline = 'Impressum';
                } 
                echo "<h1> $headline </h1>";

                if ($_GET['page'] == 'contacts') {
                    echo "
                        <p>Auf dieser Seite hast du einen Überblick über deine <b>Kontakte</b></p>
                    ";

                    for ($i = 0; $i < count($contacts); $i++) {
                        echo "
                            <form action='?page=contacts&delete=$i' method='POST'>
                                <div class='card'>
                                    <img class='profile-picture' src='./img/profile.png'>
                                    <b class='card-name'>{$contacts[$i]['name']}</b>
                                    <span>{$contacts[$i]['phone']}</span>
                                    <a class='phonebtn' href='tel:{$contacts[$i]['phone']}'>Anrufen</a>
                                    <button type='submit' class='deletebtn'>Löschen</button>
                                </div>
                            </form>
                            ";
                    }

                } else if ($_GET['page'] == 'addcontact') {
                    echo "
                        <div>
                            <p>Auf dieser Seite kannst du einen weiteren <b>Kontakt</b> hinzufügen</p>
                        </div>

                        <form action='?page=contacts' method='POST'>
                            <div>
                                <input class='form-input' placeholder='Namen eingeben' name='name'>
                            </div>
                            <div>
                                <input class='form-input' placeholder='Telefonnummer eingeben' name='phone'>
                            </div>

                            <button class='form-btn' type='submit'>Absenden</button>
                        </form>
                    ";
                } else if ($_GET['page'] == 'legal') {
                    echo "
                        <p>Heir kommt das <b>Impressum</b> hin</p>
                    ";
                } else {
                    echo "
                        <p>Du bist gerade auf der <b>Startseite</b></p>
                    ";
                }
            ?>
        </div>
    </div>

    <div class="footer">
        (C) Developer Alaken Kubatbekov
    </div>
    
</body>
</html>