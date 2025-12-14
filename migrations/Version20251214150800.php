<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214150800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_or_region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, link VARCHAR(100) NOT NULL, game VARCHAR(20) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn (id INT AUTO_INCREMENT NOT NULL, regional_dex_id INT NOT NULL, name VARCHAR(20) NOT NULL, website_description LONGTEXT NOT NULL, category_name VARCHAR(30) NOT NULL, height INT NOT NULL, weight INT NOT NULL, ev_yield_stat INT NOT NULL, ev_yield_quantity INT NOT NULL, base_exp_yield INT NOT NULL, base_friendship INT NOT NULL, hatch_time_in_cycle INT NOT NULL, cry_file LONGTEXT DEFAULT NULL, first_type_id INT NOT NULL, second_type_id INT DEFAULT NULL, first_ability_id INT NOT NULL, second_ability_id INT DEFAULT NULL, hidden_ability_id INT DEFAULT NULL, leveling_rate_id INT NOT NULL, first_egg_group_id INT NOT NULL, second_egg_group_id INT DEFAULT NULL, INDEX IDX_74A002F4D6C0E06F (first_type_id), INDEX IDX_74A002F4D20E0CFE (second_type_id), INDEX IDX_74A002F4118EB9B5 (first_ability_id), INDEX IDX_74A002F463483821 (second_ability_id), INDEX IDX_74A002F4BF7605BB (hidden_ability_id), INDEX IDX_74A002F45E0E8FDD (leveling_rate_id), INDEX IDX_74A002F4C2999FDD (first_egg_group_id), INDEX IDX_74A002F44D0B11B3 (second_egg_group_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F4D6C0E06F FOREIGN KEY (first_type_id) REFERENCES pkmn_types (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F4D20E0CFE FOREIGN KEY (second_type_id) REFERENCES pkmn_types (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F4118EB9B5 FOREIGN KEY (first_ability_id) REFERENCES abilities (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F463483821 FOREIGN KEY (second_ability_id) REFERENCES abilities (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F4BF7605BB FOREIGN KEY (hidden_ability_id) REFERENCES abilities (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F45E0E8FDD FOREIGN KEY (leveling_rate_id) REFERENCES leveling_rate (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F4C2999FDD FOREIGN KEY (first_egg_group_id) REFERENCES egg_groups (id)');
        $this->addSql('ALTER TABLE pkmn ADD CONSTRAINT FK_74A002F44D0B11B3 FOREIGN KEY (second_egg_group_id) REFERENCES egg_groups (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F4D6C0E06F');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F4D20E0CFE');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F4118EB9B5');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F463483821');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F4BF7605BB');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F45E0E8FDD');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F4C2999FDD');
        $this->addSql('ALTER TABLE pkmn DROP FOREIGN KEY FK_74A002F44D0B11B3');
        $this->addSql('DROP TABLE game_or_region');
        $this->addSql('DROP TABLE pkmn');
    }
}
