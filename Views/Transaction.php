<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effectuer une transaction</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script src="../Views/assets/js/Transaction.js" defer></script>
</head>
<body>

<?php include 'connect_navbar.php'; ?>

<div class="body-container">
    <div class="container">
        <h2>Nouvelle Transaction</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert error">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="alert success">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <div id="jsErrorContainer" class="alert error" style="display: none;"></div>

        <form action="" method="post" id="transactionForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="form-group">
                <label for="receiver">Destinataire (Pseudo ou Email)</label>
                <input type="text" name="receiver" id="receiver" placeholder="Ex: JeanDupont" value="<?= htmlspecialchars($_POST['receiver'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="amount">Montant (€)</label>
                <input type="text" name="amount" id="amount" placeholder="0.00" value="<?= htmlspecialchars($_POST['amount'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="id_card">Carte de paiement</label>
                <select name="id_card" id="id_card">
                    <option value="">-- Choisir une carte --</option>
                    <?php if (!empty($userCards)): ?>
                        <?php foreach ($userCards as $card): ?>
                            <?php
                            $postedId = isset($_POST['id_card']) ? (int)$_POST['id_card'] : null;
                            $dbId = (int)$card['id_card'];
                            $selected = ($postedId === $dbId) ? 'selected' : '';
                            ?>
                            <option value="<?= htmlspecialchars($card['id_card']) ?>" <?= $selected ?>>
                                **** **** **** <?= htmlspecialchars($card['num_card']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Aucune carte enregistrée</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="cvv">Code CVV</label>
                <input type="password" name="cvv" id="cvv" placeholder="***">
            </div>

            <div class="form-group">
                <label>Message</label>

                <div class="toolbar" id="richTextToolbar" style="margin-bottom: 5px; display: flex; gap: 4px; flex-wrap: wrap;">
                    <button type="button" class="btn-format" data-cmd="bold" title="Gras"><b>G</b></button>
                    <button type="button" class="btn-format" data-cmd="italic" title="Italique"><i>I</i></button>

                    <span style="border-left: 1px solid #ccc; margin: 0 5px;"></span>

                    <button type="button" class="btn-format" data-cmd="foreColor" data-val="#000000" style="color:black; font-weight:bold;" title="Noir">A</button>

                    <button type="button" class="btn-format" data-cmd="foreColor" data-val="#e90000" style="color:#e90000; font-weight:bold;" title="Rouge">A</button>
                    <button type="button" class="btn-format" data-cmd="foreColor" data-val="#ff8c00" style="color:#ff8c00; font-weight:bold;" title="Orange">A</button>
                    <button type="button" class="btn-format" data-cmd="foreColor" data-val="#229d24" style="color:#229d24; font-weight:bold;" title="Vert">A</button>
                    <button type="button" class="btn-format" data-cmd="foreColor" data-val="#2277eb" style="color:#2277eb; font-weight:bold;" title="Bleu">A</button>
                    <button type="button" class="btn-format" data-cmd="foreColor" data-val="#800080" style="color:#800080; font-weight:bold;" title="Violet">A</button>

                    <span style="border-left: 1px solid #ccc; margin: 0 5px;"></span>

                    <button type="button" class="btn-format" data-cmd="removeFormat" title="Tout effacer (Retour à la normale)">✕</button>
                </div>

                <div id="message_transact" contenteditable="true"></div>

                <input type="hidden" name="message_transact" id="message_input">
            </div>

            <button type="submit" id="submitBtn">Valider le paiement</button>
        </form>
    </div>
</div>

<script>
    <?php if(isset($_POST['message_transact'])): ?>
    document.addEventListener('DOMContentLoaded', () => {
        const editorRef = document.getElementById('message_transact');
        const hiddenRef = document.getElementById('message_input');

        if (editorRef) {
            <?php
            $rawContent = strip_tags($_POST['message_transact'], '<b><i><em><strong><br><p><span><div>');

            $safeJson = '""';

            try {
                $safeJson = json_encode(
                    $rawContent,
                    JSON_THROW_ON_ERROR | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
                );
            } catch (JsonException $e) {

            }
            ?>

            let safeContent = <?= $safeJson ?>;

            editorRef.innerHTML = safeContent;

            if (hiddenRef) {
                hiddenRef.value = safeContent;
            }
        }
    });
    <?php endif; ?>
</script>

</body>
</html>