<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Gowun Dodum", sans-serif;
            background-color: #EAEDF8;
            margin: 0;
        }
        .main {
            display: flex;
        }
        .menu {
            width: 20%;
            background-color: #746CF5;
            margin-right: 32px;
            padding-top: 150px;
            height: 100vh
        }
        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 8px;
            display: flex;
            align-items: center;
        }
        .menu img {
           margin-right: 8px;
        }
        .menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .content {
            width: 80%;
            margin-top: 120px;
            margin-right: 32px;
            background-color: white;
            border-radius: 8px;
            padding: 16px;
        }
        .menubar {
          background-color: white;
          position: absolute;
          left: 0;
          right: 0;
          top: 0; 
          height: 80px;
          box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
          padding-left: 50px;
          display: flex;
          justify-content: space-between;
        }
        .avatar {
            border-radius: 100%;
            background-color: yellowgreen;
            padding: 16px;
            width: 16px;
            height: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 8px;
        }
        .myname{
            display: flex;
            align-items: center;
            margin-right: 50px;
        }
        .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            position: absolute;
            left: 8px
    
        }
        .card {
            background-color: rgba(0, 0, 0, 0.05);
            margin-bottom: 16px;
            border-radius: 8px;
            padding: 8px;
            padding-left: 64px;
            position: relative;
        } .phonebtn{
            background-color: #999900;
            padding: 4px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            position: absolute;
            top: 0;
            right: 0;
        }
         .phonebtn:hover{
            background-color: #26d026;
        }
    </style>
</head>
<body>
    <div class="menubar">
        <h1>My Contact Book</h1>
        <div class="myname">
            <div class="avatar">A</div>
            Adrian Speer
        </div>
    </div>
    <div class="main"> 
        <div class="menu">
        <a href="index.php?page=start"><img src="img/house_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="Haus Icon">Start</a> 
        <a href="index.php?page=contacts"><img src="img/menu_book_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="">Kontakt</a> 
        <a href="index.php?page=addcontact"><img src="img/add_circle_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="">Kontakt hinzufügen</a> 
        <a href="index.php?page=legal"><img src="img/policy_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="">Impressum</a>
        </div>
        <div class="content">
        <?php
        $headline = "Herzlich Willkommen";
        $contacts = [

        ];

        if(file_exists('contacts.txt')) {
          $text =  file_get_contents('contacts.txt', true);
          $contacts = json_decode($text, true);
        }

        if(isset($_POST['name']) && isset($_POST['phone'])) {
            echo 'Kontakt <b>' . $_POST['name'] . '</b> wurde hinzugefügt';
            $newContact = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone']
            ];
            array_push($contacts, $newContact);
            file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
        }


                 if($_GET['page'] == 'contacts') {
        $headline = "Deine Kontakte";
    }

    if($_GET['page'] == 'addcontact') {
        $headline = "Kontakt hinzufügen";
    }

    if($_GET['page'] == 'legal') {
        $headline = "Impressum";
    }

    echo '<h1>' . $headline . '</h1>';

    if($_GET['page'] == 'contacts') {
      
        echo "
        <p>
        Auf dieser seite hast du einen Überblick über deine <b>Kontakte</b> 
        </p>
        ";
        foreach ($contacts as $row) {
            $name = $row['name'];
            $phone = $row['phone'];
            echo "
            <div class='card'> 
            <img class='profile-picture' src='img/blank-profile-picture-973460_1280.png'>
            <b> $name</b> <br>
             $phone
             <a class='phonebtn' href='tel:$phone'>Anrufen</a>
            </div>
            ";
        }
    } else if ($_GET['page'] == 'legal') {
        echo "
        <p>
         Hier kommt das Impressum hin
        </p>
        ";
    }  else if ($_GET['page'] == 'addcontact') {
        echo "
        <div>
        Auf dieser Seite kannst du einen neuen Kontakt hinzufügen
        </div>
        <form action='?page=contacts' method='POST'>
            <div> <input placeholder='Namen eingeben' name='name'></div>
            <div> <input placeholder='Telefonnumer eingeben' name='phone'></div>
        <button tpye='submit'>Absenden</button>
        </form>
        ";
    } else {
        echo 'Du bist auf der Start Seite';
    }
    ?>
</div>
</div>
</body>
</html>