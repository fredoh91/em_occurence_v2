<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200821180749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE em_denom_v2 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) NOT NULL, nbr INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE em_occ_produit_v2 ADD CONSTRAINT FK_DAA854C9770B1109 FOREIGN KEY (cat_grille_id) REFERENCES grille_occ_em_v2 (id)');
        $this->addSql('CREATE INDEX IDX_DAA854C9770B1109 ON em_occ_produit_v2 (cat_grille_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE em_denom_v2');
        $this->addSql('ALTER TABLE em_occ_produit_v2 DROP FOREIGN KEY FK_DAA854C9770B1109');
        $this->addSql('DROP INDEX IDX_DAA854C9770B1109 ON em_occ_produit_v2');
    }
}
