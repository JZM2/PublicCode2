<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190216220055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_station (user_id INT NOT NULL, station_id INT NOT NULL, PRIMARY KEY(user_id, station_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE station_folder');
        $this->addSql('DROP INDEX folder_station_2 ON folder');
        $this->addSql('DROP INDEX folder_station ON folder');
        $this->addSql('ALTER TABLE station_user ADD PRIMARY KEY (station_id, user_id)');
        $this->addSql('ALTER TABLE station_user ADD CONSTRAINT FK_63A0F17421BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE station_user ADD CONSTRAINT FK_63A0F174A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX station_id ON station_user');
        $this->addSql('CREATE INDEX IDX_63A0F17421BDB235 ON station_user (station_id)');
        $this->addSql('DROP INDEX user_id ON station_user');
        $this->addSql('CREATE INDEX IDX_63A0F174A76ED395 ON station_user (user_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles TEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE station_folder (station_id INT NOT NULL, folder_station INT NOT NULL, INDEX folder_station (folder_station)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user_station');
        $this->addSql('CREATE INDEX folder_station_2 ON folder (folder_station)');
        $this->addSql('CREATE UNIQUE INDEX folder_station ON folder (folder_station)');
        $this->addSql('ALTER TABLE station_user DROP FOREIGN KEY FK_63A0F17421BDB235');
        $this->addSql('ALTER TABLE station_user DROP FOREIGN KEY FK_63A0F174A76ED395');
        $this->addSql('ALTER TABLE station_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE station_user DROP FOREIGN KEY FK_63A0F17421BDB235');
        $this->addSql('ALTER TABLE station_user DROP FOREIGN KEY FK_63A0F174A76ED395');
        $this->addSql('DROP INDEX idx_63a0f174a76ed395 ON station_user');
        $this->addSql('CREATE INDEX user_id ON station_user (user_id)');
        $this->addSql('DROP INDEX idx_63a0f17421bdb235 ON station_user');
        $this->addSql('CREATE INDEX station_id ON station_user (station_id)');
        $this->addSql('ALTER TABLE station_user ADD CONSTRAINT FK_63A0F17421BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE station_user ADD CONSTRAINT FK_63A0F174A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles TEXT NOT NULL COLLATE utf8_czech_ci');
    }
}
