<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817164050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE em_occ_produit_v2 ADD cat_grille_id INT NOT NULL');
        $this->addSql('ALTER TABLE em_occ_produit_v2 ADD CONSTRAINT FK_DAA854C9770B1109 FOREIGN KEY (cat_grille_id) REFERENCES grille_occ_em_v2 (id)');
        $this->addSql('CREATE INDEX IDX_DAA854C9770B1109 ON em_occ_produit_v2 (cat_grille_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE em_occ_produit_v2 DROP FOREIGN KEY FK_DAA854C9770B1109');
        $this->addSql('DROP INDEX IDX_DAA854C9770B1109 ON em_occ_produit_v2');
        $this->addSql('ALTER TABLE em_occ_produit_v2 DROP cat_grille_id');
    }
}
