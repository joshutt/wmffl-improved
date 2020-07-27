<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200725200633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE config CHANGE `key` `key` VARCHAR(255) DEFAULT \'\'\'\'\'\' NOT NULL');
        $this->addSql('ALTER TABLE nflteams CHANGE nflteam nflteam CHAR(3) DEFAULT \'\'\'\'\'\' NOT NULL');
        $this->addSql('ALTER TABLE paid CHANGE previous previous DOUBLE PRECISION DEFAULT NULL, CHANGE late_fee late_fee DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE positioncost CHANGE cost cost INT DEFAULT NULL');
        $this->addSql('ALTER TABLE protectioncost CHANGE years years INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stats CHANGE yards yards INT DEFAULT NULL, CHANGE intthrow intthrow INT DEFAULT NULL, CHANGE rec rec INT DEFAULT NULL, CHANGE fum fum INT DEFAULT NULL, CHANGE tackles tackles INT DEFAULT NULL, CHANGE sacks sacks DOUBLE PRECISION DEFAULT NULL, CHANGE intcatch intcatch INT DEFAULT NULL, CHANGE passdefend passdefend INT DEFAULT NULL, CHANGE returnyards returnyards INT DEFAULT NULL, CHANGE fumrec fumrec INT DEFAULT NULL, CHANGE forcefum forcefum INT DEFAULT NULL, CHANGE tds tds INT DEFAULT NULL, CHANGE 2pt 2pt INT DEFAULT NULL, CHANGE specTD specTD INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE config CHANGE `key` `key` VARCHAR(255) CHARACTER SET latin1 DEFAULT \'\'\'\'\'\'\'\'\'\'\'\'\'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE nflteams CHANGE nflteam nflteam CHAR(3) CHARACTER SET latin1 DEFAULT \'\'\'\'\'\'\'\'\'\'\'\'\'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE paid CHANGE previous previous DOUBLE PRECISION DEFAULT \'NULL\', CHANGE late_fee late_fee DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE positioncost CHANGE cost cost INT DEFAULT NULL');
        $this->addSql('ALTER TABLE protectioncost CHANGE years years INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stats CHANGE yards yards INT DEFAULT NULL, CHANGE intthrow intthrow INT DEFAULT NULL, CHANGE rec rec INT DEFAULT NULL, CHANGE fum fum INT DEFAULT NULL, CHANGE tackles tackles INT DEFAULT NULL, CHANGE sacks sacks DOUBLE PRECISION DEFAULT \'NULL\', CHANGE intcatch intcatch INT DEFAULT NULL, CHANGE passdefend passdefend INT DEFAULT NULL, CHANGE returnyards returnyards INT DEFAULT NULL, CHANGE fumrec fumrec INT DEFAULT NULL, CHANGE forcefum forcefum INT DEFAULT NULL, CHANGE tds tds INT DEFAULT NULL, CHANGE 2pt 2pt INT DEFAULT NULL, CHANGE specTD specTD INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
