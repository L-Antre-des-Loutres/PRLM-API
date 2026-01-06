<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260106094452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pkmn ADD stats JSON NOT NULL, ADD ev_yield JSON NOT NULL, DROP ev_yield_stat, DROP ev_yield_quantity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pkmn ADD ev_yield_stat INT NOT NULL, ADD ev_yield_quantity INT NOT NULL, DROP stats, DROP ev_yield');
    }
}
