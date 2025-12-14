<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214033851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moves DROP FOREIGN KEY `FK_453F0832C54C8C93`');
        $this->addSql('DROP INDEX IDX_453F0832C54C8C93 ON moves');
        $this->addSql('ALTER TABLE moves CHANGE type_id type_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE moves ADD CONSTRAINT FK_453F0832714819A0 FOREIGN KEY (type_id_id) REFERENCES pkmn_types (id)');
        $this->addSql('CREATE INDEX IDX_453F0832714819A0 ON moves (type_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moves DROP FOREIGN KEY FK_453F0832714819A0');
        $this->addSql('DROP INDEX IDX_453F0832714819A0 ON moves');
        $this->addSql('ALTER TABLE moves CHANGE type_id_id type_id INT NOT NULL');
        $this->addSql('ALTER TABLE moves ADD CONSTRAINT `FK_453F0832C54C8C93` FOREIGN KEY (type_id) REFERENCES pkmn_types (id)');
        $this->addSql('CREATE INDEX IDX_453F0832C54C8C93 ON moves (type_id)');
    }
}
