<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811131608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, propriete_id INT NOT NULL, locataire_id INT NOT NULL, date_d_location DATE NOT NULL, penalite INT DEFAULT NULL, delais_paiem INT NOT NULL, causion_ent INT NOT NULL, causion_sort INT NOT NULL, etat_lieu VARCHAR(255) NOT NULL, date_l DATE NOT NULL, INDEX IDX_5E9E89CB18566CAF (propriete_id), INDEX IDX_5E9E89CBD8A38199 (locataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loyer (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, prix_loyer DOUBLE PRECISION NOT NULL, cout_l DOUBLE PRECISION NOT NULL, date_loyer DATE NOT NULL, type_paie VARCHAR(255) NOT NULL, statut_loy VARCHAR(255) NOT NULL, mont_loy DOUBLE PRECISION NOT NULL, appli_penal INT NOT NULL, mois VARCHAR(25) NOT NULL, annee VARCHAR(255) NOT NULL, mode_paie VARCHAR(255) NOT NULL, ref_paie VARCHAR(255) NOT NULL, mont_paie DOUBLE PRECISION NOT NULL, INDEX IDX_404562964D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom_p VARCHAR(255) NOT NULL, langue VARCHAR(255) NOT NULL, identif_tel VARCHAR(25) NOT NULL, code_iso VARCHAR(2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propriete (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, gestionnaire_id INT NOT NULL, quartier_id INT NOT NULL, superficie DOUBLE PRECISION NOT NULL, statut TINYINT(1) NOT NULL, longeur INT NOT NULL, largeur INT NOT NULL, hauteur INT NOT NULL, photo VARCHAR(1) NOT NULL, photo2 VARCHAR(1) NOT NULL, photo3 VARCHAR(1) NOT NULL, photo4 VARCHAR(1) NOT NULL, photo5 VARCHAR(1) NOT NULL, prix_pro DOUBLE PRECISION NOT NULL, INDEX IDX_73A85B9376C50E4A (proprietaire_id), INDEX IDX_73A85B936885AC1B (gestionnaire_id), INDEX IDX_73A85B93DF1E57AB (quartier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartier (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, nom_quartier VARCHAR(255) NOT NULL, num_rue INT DEFAULT NULL, code_post VARCHAR(255) DEFAULT NULL, local_q VARCHAR(255) DEFAULT NULL, INDEX IDX_FEE8962DA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_propriete (id INT AUTO_INCREMENT NOT NULL, nomb_piece INT NOT NULL, type_base VARCHAR(255) NOT NULL, desc_typ LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_nais DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', tel VARCHAR(10) NOT NULL, genre VARCHAR(25) NOT NULL, nationalite VARCHAR(25) NOT NULL, profession VARCHAR(25) DEFAULT NULL, ty_piece VARCHAR(25) NOT NULL, num_piece VARCHAR(25) NOT NULL, act_compte VARCHAR(25) NOT NULL, verif_compte VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, nom_v VARCHAR(255) NOT NULL, code_post_v VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C3A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB18566CAF FOREIGN KEY (propriete_id) REFERENCES propriete (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBD8A38199 FOREIGN KEY (locataire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE loyer ADD CONSTRAINT FK_404562964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B9376C50E4A FOREIGN KEY (proprietaire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B936885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B93DF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962DA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB18566CAF');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBD8A38199');
        $this->addSql('ALTER TABLE loyer DROP FOREIGN KEY FK_404562964D218E');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B9376C50E4A');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B936885AC1B');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B93DF1E57AB');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962DA73F0036');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE loyer');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE propriete');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE type_propriete');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
