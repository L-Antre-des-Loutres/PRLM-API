<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214033200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moves (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, in_game_description VARCHAR(100) NOT NULL, website_description LONGTEXT NOT NULL, base_power INT DEFAULT NULL, base_accuracy INT DEFAULT NULL, base_pp INT NOT NULL, move_range VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, type_id_id INT NOT NULL, INDEX IDX_453F0832714819A0 (type_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE moves ADD CONSTRAINT FK_453F0832714819A0 FOREIGN KEY (type_id_id) REFERENCES pkmn_types (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moves DROP FOREIGN KEY FK_453F0832714819A0');
        $this->addSql('DROP TABLE moves');
    }
}
