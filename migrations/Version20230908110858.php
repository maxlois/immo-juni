<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908110858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete ADD propriete_pere_id INT DEFAULT NULL, DROP propriete');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B93807FDFBE FOREIGN KEY (propriete_pere_id) REFERENCES propriete (id)');
        $this->addSql('CREATE INDEX IDX_73A85B93807FDFBE ON propriete (propriete_pere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B93807FDFBE');
        $this->addSql('DROP INDEX IDX_73A85B93807FDFBE ON propriete');
        $this->addSql('ALTER TABLE propriete ADD propriete VARCHAR(255) DEFAULT NULL, DROP propriete_pere_id');
    }
}
