<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214174418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pkmn_dex_entries (id INT AUTO_INCREMENT NOT NULL, entry VARCHAR(200) NOT NULL, pkmn_id INT NOT NULL, game_or_region_id INT NOT NULL, INDEX IDX_8EE03122306CDF22 (pkmn_id), INDEX IDX_8EE031225FBD2274 (game_or_region_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pkmn_dex_entries ADD CONSTRAINT FK_8EE03122306CDF22 FOREIGN KEY (pkmn_id) REFERENCES pkmn (id)');
        $this->addSql('ALTER TABLE pkmn_dex_entries ADD CONSTRAINT FK_8EE031225FBD2274 FOREIGN KEY (game_or_region_id) REFERENCES game_or_region (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pkmn_dex_entries DROP FOREIGN KEY FK_8EE03122306CDF22');
        $this->addSql('ALTER TABLE pkmn_dex_entries DROP FOREIGN KEY FK_8EE031225FBD2274');
        $this->addSql('DROP TABLE pkmn_dex_entries');
    }
}
