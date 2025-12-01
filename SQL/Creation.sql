DROP DATABASE IF EXISTS Payment_WebApp;
CREATE DATABASE Payment_WebApp;
USE Payment_WebApp;

-- Création de la table Users
CREATE TABLE Users (
                       id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
                       psd_user VARCHAR(50) NOT NULL UNIQUE,
                       mdp_user VARCHAR(255) NOT NULL,
                       email_user VARCHAR(100) NOT NULL UNIQUE,
                       role_user BOOLEAN NOT NULL DEFAULT 0,
                       is_active BOOLEAN NOT NULL DEFAULT 1,
                       PRIMARY KEY (id_user)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

-- Création de la table Debit_Cards
CREATE TABLE Debit_Cards (
                             id_card INT UNSIGNED NOT NULL AUTO_INCREMENT,
                             id_user_card INT UNSIGNED,
                             num_card CHAR(4) NOT NULL,
                             first_digits CHAR(4) NOT NULL,
                             pan_encrypted VARBINARY(255) NOT NULL,
                             pan_iv VARBINARY(255) NOT NULL,
                             expiration_date CHAR(4) NOT NULL,
                             PRIMARY KEY (id_card),
                             FOREIGN KEY (id_user_card) REFERENCES Users(id_user)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

-- Création de la table Transac
CREATE TABLE Transac (
                         id_transac INT UNSIGNED NOT NULL AUTO_INCREMENT,
                         id_sender INT UNSIGNED,
                         id_receiver INT UNSIGNED,
                         sum_transac INT UNSIGNED,
                         refund_transac BOOLEAN DEFAULT 0,
                         id_card_used INT UNSIGNED NULL,
                         msg_transac LONGTEXT,
                         date_transac DATETIME DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (id_transac),
                         FOREIGN KEY (id_sender) REFERENCES Users(id_user),
                         FOREIGN KEY (id_card_used) REFERENCES Debit_Cards(id_card),
                         FOREIGN KEY (id_receiver) REFERENCES Users(id_user)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;
