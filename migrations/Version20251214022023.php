<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214022023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pkmn_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, website_description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn_types_immunities (pkmn_types_source INT NOT NULL, pkmn_types_target INT NOT NULL, INDEX IDX_C15259A742D9D085 (pkmn_types_source), INDEX IDX_C15259A75B3C800A (pkmn_types_target), PRIMARY KEY (pkmn_types_source, pkmn_types_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn_types_resistances (pkmn_types_source INT NOT NULL, pkmn_types_target INT NOT NULL, INDEX IDX_16E8108042D9D085 (pkmn_types_source), INDEX IDX_16E810805B3C800A (pkmn_types_target), PRIMARY KEY (pkmn_types_source, pkmn_types_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn_types_weaknesses (pkmn_types_source INT NOT NULL, pkmn_types_target INT NOT NULL, INDEX IDX_6A354B2642D9D085 (pkmn_types_source), INDEX IDX_6A354B265B3C800A (pkmn_types_target), PRIMARY KEY (pkmn_types_source, pkmn_types_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn_types_no_effect (pkmn_types_source INT NOT NULL, pkmn_types_target INT NOT NULL, INDEX IDX_C3E8FA9742D9D085 (pkmn_types_source), INDEX IDX_C3E8FA975B3C800A (pkmn_types_target), PRIMARY KEY (pkmn_types_source, pkmn_types_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn_types_super_effective (pkmn_types_source INT NOT NULL, pkmn_types_target INT NOT NULL, INDEX IDX_F8C5999142D9D085 (pkmn_types_source), INDEX IDX_F8C599915B3C800A (pkmn_types_target), PRIMARY KEY (pkmn_types_source, pkmn_types_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE pkmn_types_not_very_effective (pkmn_types_source INT NOT NULL, pkmn_types_target INT NOT NULL, INDEX IDX_B66E00B042D9D085 (pkmn_types_source), INDEX IDX_B66E00B05B3C800A (pkmn_types_target), PRIMARY KEY (pkmn_types_source, pkmn_types_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pkmn_types_immunities ADD CONSTRAINT FK_C15259A742D9D085 FOREIGN KEY (pkmn_types_source) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_immunities ADD CONSTRAINT FK_C15259A75B3C800A FOREIGN KEY (pkmn_types_target) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_resistances ADD CONSTRAINT FK_16E8108042D9D085 FOREIGN KEY (pkmn_types_source) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_resistances ADD CONSTRAINT FK_16E810805B3C800A FOREIGN KEY (pkmn_types_target) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_weaknesses ADD CONSTRAINT FK_6A354B2642D9D085 FOREIGN KEY (pkmn_types_source) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_weaknesses ADD CONSTRAINT FK_6A354B265B3C800A FOREIGN KEY (pkmn_types_target) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_no_effect ADD CONSTRAINT FK_C3E8FA9742D9D085 FOREIGN KEY (pkmn_types_source) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_no_effect ADD CONSTRAINT FK_C3E8FA975B3C800A FOREIGN KEY (pkmn_types_target) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_super_effective ADD CONSTRAINT FK_F8C5999142D9D085 FOREIGN KEY (pkmn_types_source) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_super_effective ADD CONSTRAINT FK_F8C599915B3C800A FOREIGN KEY (pkmn_types_target) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_not_very_effective ADD CONSTRAINT FK_B66E00B042D9D085 FOREIGN KEY (pkmn_types_source) REFERENCES pkmn_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pkmn_types_not_very_effective ADD CONSTRAINT FK_B66E00B05B3C800A FOREIGN KEY (pkmn_types_target) REFERENCES pkmn_types (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pkmn_types_immunities DROP FOREIGN KEY FK_C15259A742D9D085');
        $this->addSql('ALTER TABLE pkmn_types_immunities DROP FOREIGN KEY FK_C15259A75B3C800A');
        $this->addSql('ALTER TABLE pkmn_types_resistances DROP FOREIGN KEY FK_16E8108042D9D085');
        $this->addSql('ALTER TABLE pkmn_types_resistances DROP FOREIGN KEY FK_16E810805B3C800A');
        $this->addSql('ALTER TABLE pkmn_types_weaknesses DROP FOREIGN KEY FK_6A354B2642D9D085');
        $this->addSql('ALTER TABLE pkmn_types_weaknesses DROP FOREIGN KEY FK_6A354B265B3C800A');
        $this->addSql('ALTER TABLE pkmn_types_no_effect DROP FOREIGN KEY FK_C3E8FA9742D9D085');
        $this->addSql('ALTER TABLE pkmn_types_no_effect DROP FOREIGN KEY FK_C3E8FA975B3C800A');
        $this->addSql('ALTER TABLE pkmn_types_super_effective DROP FOREIGN KEY FK_F8C5999142D9D085');
        $this->addSql('ALTER TABLE pkmn_types_super_effective DROP FOREIGN KEY FK_F8C599915B3C800A');
        $this->addSql('ALTER TABLE pkmn_types_not_very_effective DROP FOREIGN KEY FK_B66E00B042D9D085');
        $this->addSql('ALTER TABLE pkmn_types_not_very_effective DROP FOREIGN KEY FK_B66E00B05B3C800A');
        $this->addSql('DROP TABLE pkmn_types');
        $this->addSql('DROP TABLE pkmn_types_immunities');
        $this->addSql('DROP TABLE pkmn_types_resistances');
        $this->addSql('DROP TABLE pkmn_types_weaknesses');
        $this->addSql('DROP TABLE pkmn_types_no_effect');
        $this->addSql('DROP TABLE pkmn_types_super_effective');
        $this->addSql('DROP TABLE pkmn_types_not_very_effective');
    }
}
