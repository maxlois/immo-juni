<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908154607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD mois VARCHAR(255) NOT NULL, ADD annee INT NOT NULL, ADD mois_avance VARCHAR(255) NOT NULL, DROP date_l, CHANGE delais_paiem delais_paiem VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE loyer CHANGE statut_loy statut_loy TINYINT(1) NOT NULL, CHANGE appli_penal appli_penal TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD date_l DATE NOT NULL, DROP mois, DROP annee, DROP mois_avance, CHANGE delais_paiem delais_paiem DATE NOT NULL');
        $this->addSql('ALTER TABLE loyer CHANGE statut_loy statut_loy VARCHAR(255) NOT NULL, CHANGE appli_penal appli_penal INT NOT NULL');
    }
}
