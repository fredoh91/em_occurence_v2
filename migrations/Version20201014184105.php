<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014184105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE em_grille_occ_v2 (id INT AUTO_INCREMENT NOT NULL, cat_lib VARCHAR(255) DEFAULT NULL, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE em_occ_deno_v2 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) DEFAULT NULL, produit VARCHAR(255) DEFAULT NULL, nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE em_grille_occ_v2');
        $this->addSql('DROP TABLE em_occ_deno_v2');
    }
}
