<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214155114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pkmn_evolutions (id INT AUTO_INCREMENT NOT NULL, evolution_category VARCHAR(255) NOT NULL, evolution_website_desc LONGTEXT NOT NULL, evolving_pkmn_id INT NOT NULL, evolved_pkmn_id INT NOT NULL, INDEX IDX_E05028F0F3C1F8D1 (evolving_pkmn_id), INDEX IDX_E05028F0B1CC4884 (evolved_pkmn_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pkmn_evolutions ADD CONSTRAINT FK_E05028F0F3C1F8D1 FOREIGN KEY (evolving_pkmn_id) REFERENCES pkmn (id)');
        $this->addSql('ALTER TABLE pkmn_evolutions ADD CONSTRAINT FK_E05028F0B1CC4884 FOREIGN KEY (evolved_pkmn_id) REFERENCES pkmn (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pkmn_evolutions DROP FOREIGN KEY FK_E05028F0F3C1F8D1');
        $this->addSql('ALTER TABLE pkmn_evolutions DROP FOREIGN KEY FK_E05028F0B1CC4884');
        $this->addSql('DROP TABLE pkmn_evolutions');
    }
}
