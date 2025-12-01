USE Payment_WebApp;

DELETE FROM Users;
DELETE FROM Debit_Cards;

-- 1. Création de l'Admin
-- Pseudo: admin / Mot de passe: Admin123!
INSERT INTO Users (psd_user, email_user, mdp_user, role_user, is_active)
VALUES ('admin', 'admin@bank.fr', '$2y$10$vsgXlhsoZHTcy41hOupEqODbXqGtx7JcSqWH2C2LbUjmxT1NLt3Ai', 1, 1);

-- 2. Création d'un utilisateur standard
-- Pseudo: user1 / Mot de passe: User123!
INSERT INTO Users (psd_user, email_user, mdp_user, role_user, is_active)
VALUES ('user1', 'user1@bank.fr', '$2y$10$sdMzg54C2ch/RhZfMhp98.NrKuRqbBNh9FrbX.SeT6x4355mVeumG', 0, 1);

-- 3. Création d'un utilisateur standard
-- Pseudo: user2 / Mot de passe: User123!
INSERT INTO Users (psd_user, email_user, mdp_user, role_user, is_active)
VALUES ('user2', 'user2@bank.fr', '$2y$10$dTaVgXLgVJjkwNVVz1.4T.WhNc.lu5cAbmY/9pqNf9WZt/nfIJNL.', 0, 1);

-- 4. Création d'une carte pour user1
INSERT INTO Users (id_user_card, num_card, first_digits, pan_encrypted, pan_iv, expiration_date)
VALUES (2, '1111', '1111', '0x36695769464E756770354B79475175377A6B794B64764E6735304C66317048416B4E71422F504F4F5151513D', '0x3563333838326631373437343163396431383132636634633063653661366437', '1111');

-- 5. Création d'une carte pour user2
INSERT INTO Users (id_user_card, num_card, first_digits, pan_encrypted, pan_iv, expiration_date)
VALUES (3, '2222', '2222', '0x4659324C454C4A366D484B42706F3779647A645456533637597A7762616151756747775250442F305A45343D', '0x3530303431646130623162336666663132643735336539663739656632353735', '2222');

