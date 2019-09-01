<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215232135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, folder_name VARCHAR(150) DEFAULT NULL, folder_qth VARCHAR(150) DEFAULT NULL, folder_gps VARCHAR(50) DEFAULT NULL, folder_grid VARCHAR(10) DEFAULT NULL, folder_contest VARCHAR(150) DEFAULT NULL, folder_contest_from DATETIME DEFAULT NULL, folder_contest_to DATETIME DEFAULT NULL, folder_contest_cat VARCHAR(150) DEFAULT NULL, folder_tx VARCHAR(150) DEFAULT NULL, folder_tx_power INT NOT NULL, folder_tx_ant VARCHAR(150) DEFAULT NULL, folder_rx VARCHAR(150) DEFAULT NULL, folder_remakrs LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE folders');
        $this->addSql('DROP INDEX `Call` ON station');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE name name VARCHAR(105) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE folders (id INT AUTO_INCREMENT NOT NULL, folder_name VARCHAR(150) NOT NULL COLLATE utf8_czech_ci, folder_qth VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci, folder_gps VARCHAR(50) DEFAULT NULL COLLATE utf8_czech_ci, folder_grid VARCHAR(10) DEFAULT NULL COLLATE utf8_czech_ci, folder_contest VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci, folder_contest_from DATETIME DEFAULT NULL, folder_contest_to DATETIME DEFAULT NULL, folder_contest_cat VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci, folder_tx VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci, folder_tx_power INT DEFAULT NULL, folder_tx_ant VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci, folder_rx VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci, folder_remarks TEXT DEFAULT NULL COLLATE utf8_czech_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE folder');
        $this->addSql('CREATE UNIQUE INDEX `Call` ON station (callsign)');
        $this->addSql('ALTER TABLE user CHANGE roles roles TEXT NOT NULL COLLATE utf8_czech_ci, CHANGE name name VARCHAR(150) DEFAULT NULL COLLATE utf8_czech_ci');
    }
}
