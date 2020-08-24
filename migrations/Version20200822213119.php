<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200822213119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE em_denom_map_todo_v2 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) NOT NULL, nbr INT NOT NULL, cis VARCHAR(255) DEFAULT NULL, label LONGTEXT DEFAULT NULL, bn_label VARCHAR(255) DEFAULT NULL, atc7 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE em_denom_map_v2 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) NOT NULL, nbr INT NOT NULL, cis VARCHAR(255) DEFAULT NULL, label LONGTEXT DEFAULT NULL, bn_label VARCHAR(255) DEFAULT NULL, atc7 VARCHAR(255) DEFAULT NULL, similarity DOUBLE PRECISION DEFAULT NULL, cq VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE em_denom_map_todo_v2');
        $this->addSql('DROP TABLE em_denom_map_v2');
    }
}
