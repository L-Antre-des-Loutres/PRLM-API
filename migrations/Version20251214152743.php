<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214152743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movesets (id INT AUTO_INCREMENT NOT NULL, evolution_learned TINYINT NOT NULL, ct_learned TINYINT NOT NULL, egg_move_learned TINYINT NOT NULL, learn_at_level INT DEFAULT NULL, pkmn_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_6A52DA23306CDF22 (pkmn_id), INDEX IDX_6A52DA236DC541A8 (move_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE movesets ADD CONSTRAINT FK_6A52DA23306CDF22 FOREIGN KEY (pkmn_id) REFERENCES pkmn (id)');
        $this->addSql('ALTER TABLE movesets ADD CONSTRAINT FK_6A52DA236DC541A8 FOREIGN KEY (move_id) REFERENCES moves (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movesets DROP FOREIGN KEY FK_6A52DA23306CDF22');
        $this->addSql('ALTER TABLE movesets DROP FOREIGN KEY FK_6A52DA236DC541A8');
        $this->addSql('DROP TABLE movesets');
    }
}
