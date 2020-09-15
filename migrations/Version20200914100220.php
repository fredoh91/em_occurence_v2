<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200914100220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE em_denom_map_catego_v2 (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE em_denom_map_todo_v2 ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE em_denom_map_todo_v2 ADD CONSTRAINT FK_E58C0F04BCF5E72D FOREIGN KEY (categorie_id) REFERENCES em_denom_map_catego_v2 (id)');
        $this->addSql('CREATE INDEX IDX_E58C0F04BCF5E72D ON em_denom_map_todo_v2 (categorie_id)');
        $this->addSql('ALTER TABLE em_denom_map_v2 ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE em_denom_map_v2 ADD CONSTRAINT FK_C6B2DAAEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES em_denom_map_catego_v2 (id)');
        $this->addSql('CREATE INDEX IDX_C6B2DAAEBCF5E72D ON em_denom_map_v2 (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE em_denom_map_todo_v2 DROP FOREIGN KEY FK_E58C0F04BCF5E72D');
        $this->addSql('ALTER TABLE em_denom_map_v2 DROP FOREIGN KEY FK_C6B2DAAEBCF5E72D');
        $this->addSql('DROP TABLE em_denom_map_catego_v2');
        $this->addSql('DROP INDEX IDX_E58C0F04BCF5E72D ON em_denom_map_todo_v2');
        $this->addSql('ALTER TABLE em_denom_map_todo_v2 DROP categorie_id');
        $this->addSql('DROP INDEX IDX_C6B2DAAEBCF5E72D ON em_denom_map_v2');
        $this->addSql('ALTER TABLE em_denom_map_v2 DROP categorie_id');
    }
}
