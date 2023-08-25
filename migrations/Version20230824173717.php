<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824173717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete ADD image2_file VARCHAR(255) NOT NULL, ADD image3_file VARCHAR(255) NOT NULL, ADD image4_file VARCHAR(255) NOT NULL, ADD image5_file VARCHAR(255) NOT NULL, DROP photo2, DROP photo3, DROP photo4, DROP photo5');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete ADD photo2 VARCHAR(1) NOT NULL, ADD photo3 VARCHAR(1) NOT NULL, ADD photo4 VARCHAR(1) NOT NULL, ADD photo5 VARCHAR(1) NOT NULL, DROP image2_file, DROP image3_file, DROP image4_file, DROP image5_file');
    }
}
