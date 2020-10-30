<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201030165249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE em_date_preparation_data');
        $this->addSql('DROP TABLE em_denom');
        $this->addSql('DROP TABLE em_denom_20200427');
        $this->addSql('DROP TABLE em_denom_2802019');
        $this->addSql('DROP TABLE em_denom_map');
        $this->addSql('DROP TABLE em_denom_map_todo');
        $this->addSql('DROP TABLE em_grille_occ');
        $this->addSql('DROP TABLE em_grille_occ_old');
        $this->addSql('DROP TABLE em_occ_deno');
        $this->addSql('DROP TABLE em_occ_deno_old');
        $this->addSql('DROP TABLE em_occ_deno_v2_20201027_233553');
        $this->addSql('DROP TABLE em_occ_deno_v2_20201027_234048');
        $this->addSql('DROP TABLE em_occ_deno_v2_20201030_010611');
        $this->addSql('DROP TABLE em_occ_deno_v2_20201030_011243');
        $this->addSql('DROP TABLE em_occ_deno_v2_20201030_172355');
        $this->addSql('DROP TABLE em_occ_produit');
        $this->addSql('DROP TABLE em_occ_produit_old');
        $this->addSql('DROP TABLE em_occ_produit_v2_20201027_233553');
        $this->addSql('DROP TABLE em_occ_produit_v2_20201027_234048');
        $this->addSql('DROP TABLE em_occ_produit_v2_20201030_010611');
        $this->addSql('DROP TABLE em_occ_produit_v2_20201030_011243');
        $this->addSql('DROP TABLE em_occ_produit_v2_20201030_172355');
        $this->addSql('DROP TABLE freq_deno');
        $this->addSql('DROP TABLE freq_deno_old');
        $this->addSql('DROP TABLE freq_produit');
        $this->addSql('DROP TABLE freq_produit_old');
        $this->addSql('DROP TABLE grille_occ_em');
        $this->addSql('DROP TABLE grille_occ_em_v2_20201027_233553');
        $this->addSql('DROP TABLE grille_occ_em_v2_20201027_234048');
        $this->addSql('DROP TABLE grille_occ_em_v2_20201030_010611');
        $this->addSql('DROP TABLE grille_occ_em_v2_20201030_011243');
        $this->addSql('DROP TABLE grille_occ_em_v2_20201030_172355');
        $this->addSql('DROP TABLE onlyfreq_deno');
        $this->addSql('DROP TABLE onlyfreq_produit');
        $this->addSql('DROP TABLE onlygrille_occ_em');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE em_date_preparation_data (id INT AUTO_INCREMENT NOT NULL, date_preparation_data DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_denom (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_denom_20200427 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_denom_2802019 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_denom_map (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CIS VARCHAR(8) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, label VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, BNlabel VARCHAR(59) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ATC7 VARCHAR(7) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Similarity VARCHAR(11) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CQ VARCHAR(4) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_denom_map_todo (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_grille_occ (id INT AUTO_INCREMENT NOT NULL, cat_lib TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_grille_occ_old (id INT AUTO_INCREMENT NOT NULL, cat_lib TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(500) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, produit VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno_old (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(500) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, produit VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno_v2_20201027_233553 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno_v2_20201027_234048 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno_v2_20201030_010611 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno_v2_20201030_011243 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_deno_v2_20201030_172355 (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit_old (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit_v2_20201027_233553 (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, cat_grille_id INT NOT NULL, INDEX IDX_DAA854C9770B1109 (cat_grille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit_v2_20201027_234048 (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, cat_grille_id INT NOT NULL, INDEX IDX_DAA854C9770B1109 (cat_grille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit_v2_20201030_010611 (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, cat_grille_id INT NOT NULL, INDEX IDX_DAA854C9770B1109 (cat_grille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit_v2_20201030_011243 (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, cat_grille_id INT NOT NULL, INDEX IDX_DAA854C9770B1109 (cat_grille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE em_occ_produit_v2_20201030_172355 (id INT AUTO_INCREMENT NOT NULL, produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nbr INT DEFAULT NULL, cat_grille_id INT NOT NULL, INDEX IDX_DAA854C9770B1109 (cat_grille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE freq_deno (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(262) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, BNlabel VARCHAR(46) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, natureErreur VARCHAR(53) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE freq_deno_old (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(262) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, BNlabel VARCHAR(46) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, natureErreur VARCHAR(53) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, Cumul INT DEFAULT NULL, Cumul_pct VARCHAR(4) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE freq_produit (id INT AUTO_INCREMENT NOT NULL, BNlabel VARCHAR(46) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, natureErreur VARCHAR(53) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE freq_produit_old (id INT AUTO_INCREMENT NOT NULL, BNlabel VARCHAR(46) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, natureErreur VARCHAR(53) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, Cumul INT DEFAULT NULL, Cumul_pct VARCHAR(4) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Cat INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grille_occ_em (id INT AUTO_INCREMENT NOT NULL, cat_lib TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grille_occ_em_v2_20201027_233553 (id INT AUTO_INCREMENT NOT NULL, cat_lib VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grille_occ_em_v2_20201027_234048 (id INT AUTO_INCREMENT NOT NULL, cat_lib VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grille_occ_em_v2_20201030_010611 (id INT AUTO_INCREMENT NOT NULL, cat_lib VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grille_occ_em_v2_20201030_011243 (id INT AUTO_INCREMENT NOT NULL, cat_lib VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grille_occ_em_v2_20201030_172355 (id INT AUTO_INCREMENT NOT NULL, cat_lib VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE onlyfreq_deno (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(262) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, BNlabel VARCHAR(46) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE onlyfreq_produit (id INT AUTO_INCREMENT NOT NULL, BNlabel VARCHAR(46) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Nbr INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE onlygrille_occ_em (id INT AUTO_INCREMENT NOT NULL, cat_lib TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, cat_idx INT NOT NULL, vmin INT NOT NULL, vmax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
    }
}
