RENAME TABLE payicam_carte to cartes, payicam_accueil_slide to slides;

ALTER TABLE cartes CHANGE carte_id id INT(11);
ALTER TABLE cartes CHANGE carte_titre title VARCHAR(75);
ALTER TABLE cartes CHANGE carte_description description TEXT;
ALTER TABLE cartes CHANGE carte_activation_bouton active_button TINYINT(1);
ALTER TABLE cartes CHANGE carte_bouton button_title VARCHAR(45);
ALTER TABLE cartes ADD target VARCHAR(255) NOT NULL;
ALTER TABLE cartes ADD is_admin TINYINT(1) NOT NULL;
ALTER TABLE cartes ADD is_super_admin TINYINT(1) NOT NULL;

ALTER TABLE slides CHANGE slide_id id INT(11);
ALTER TABLE slides CHANGE slide_image url VARCHAR(255);
ALTER TABLE slides CHANGE slide_message alt VARCHAR(45);

CREATE TABLE IF NOT EXISTS `config` (
  `field` varchar(45) NOT NULL,
  `value` tinyint(1) NOT NULL
);
INSERT INTO `config` (`field`, `value`) VALUES
('slider', 1);