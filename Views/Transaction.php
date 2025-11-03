<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script defer src="../Views/assets/js/Transaction.js"></script>
</head>
<body>
<?php include 'connect_navbar.php'; ?>
<div class="body-container">
    <div class="container">
        <h2>Transaction</h2>
        <form action="../index.php" method="post">

            <div class="toolbar">
                <button name="btn_message" type="button" onclick="document.execCommand('bold')"><b>Gras</b></button>
                <button name="btn_message" type="button" onclick="document.execCommand('italic')"><i>Italique</i></button>
                <button name="btn_message" type="button" onclick="document.execCommand('foreColor', false, '#e90000')">Rouge</button>
                <button name="btn_message" type="button" onclick="document.execCommand('foreColor', false, '#2277eb')">Bleu</button>
                <button name="btn_message" type="button" onclick="document.execCommand('foreColor', false, '#229d24')">Vert</button>
                <button name="btn_message" type="button" onclick="document.execCommand('foreColor', false, '#000000')">Noir</button>
            </div>

            <div class="editable-container">
            <label for="message_transact">Ecrivez votre message</label>
            <div id="message_transact" contenteditable="true"></div>
            </div>


            <input type="hidden" name="message_transact" id="message_input">

            <button type="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>