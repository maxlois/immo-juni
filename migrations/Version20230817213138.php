<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817213138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete ADD type_propriete_id INT NOT NULL');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B939F15D6AA FOREIGN KEY (type_propriete_id) REFERENCES type_propriete (id)');
        $this->addSql('CREATE INDEX IDX_73A85B939F15D6AA ON propriete (type_propriete_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B939F15D6AA');
        $this->addSql('DROP INDEX IDX_73A85B939F15D6AA ON propriete');
        $this->addSql('ALTER TABLE propriete DROP type_propriete_id');
    }
}
