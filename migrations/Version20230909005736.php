<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230909005736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBBA518690 FOREIGN KEY (loyer_id) REFERENCES loyer (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBBA518690 ON location (loyer_id)');
        $this->addSql('ALTER TABLE loyer DROP FOREIGN KEY FK_404562964D218E');
        $this->addSql('DROP INDEX IDX_404562964D218E ON loyer');
        $this->addSql('ALTER TABLE loyer DROP location_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBBA518690');
        $this->addSql('DROP INDEX IDX_5E9E89CBBA518690 ON location');
        $this->addSql('ALTER TABLE loyer ADD location_id INT NOT NULL');
        $this->addSql('ALTER TABLE loyer ADD CONSTRAINT FK_404562964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_404562964D218E ON loyer (location_id)');
    }
}
