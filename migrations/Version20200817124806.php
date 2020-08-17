<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817124806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grille_occ_em_v2 CHANGE cat_idx cat_idx INT NOT NULL, CHANGE vmin vmin INT NOT NULL, CHANGE vmax vmax INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grille_occ_em_v2 CHANGE cat_idx cat_idx INT DEFAULT NULL, CHANGE vmin vmin INT DEFAULT NULL, CHANGE vmax vmax INT DEFAULT NULL');
    }
}
