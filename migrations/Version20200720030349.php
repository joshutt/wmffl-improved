<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720030349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activations CHANGE TeamID TeamID INT NOT NULL, CHANGE Week Week TINYINT(1) NOT NULL, CHANGE HC HC INT NOT NULL, CHANGE QB QB INT NOT NULL, CHANGE RB1 RB1 INT NOT NULL, CHANGE RB2 RB2 INT NOT NULL, CHANGE WR1 WR1 INT NOT NULL, CHANGE WR2 WR2 INT NOT NULL, CHANGE TE TE INT NOT NULL, CHANGE K K INT NOT NULL, CHANGE OL OL INT NOT NULL, CHANGE DL1 DL1 INT NOT NULL, CHANGE DL2 DL2 INT NOT NULL, CHANGE LB1 LB1 INT NOT NULL, CHANGE LB2 LB2 INT NOT NULL, CHANGE DB1 DB1 INT NOT NULL, CHANGE DB2 DB2 INT NOT NULL');
        $this->addSql('ALTER TABLE articles CHANGE active active TINYINT(1) NOT NULL, CHANGE priority priority INT NOT NULL');
        $this->addSql('ALTER TABLE ballot DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ballot CHANGE TeamID TeamID INT NOT NULL, CHANGE IssueID IssueID INT NOT NULL');
        $this->addSql('ALTER TABLE ballot ADD PRIMARY KEY (TeamID, IssueID)');
        $this->addSql('ALTER TABLE chat CHANGE userid userid INT NOT NULL');
        $this->addSql('ALTER TABLE comments CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE config CHANGE `key` `key` VARCHAR(255) DEFAULT \'\'\'\'\'\' NOT NULL');
        $this->addSql('ALTER TABLE division CHANGE DivisionID DivisionID INT NOT NULL');
        $this->addSql('ALTER TABLE draftdate CHANGE UserID UserID INT NOT NULL');
        $this->addSql('ALTER TABLE draftpickhold CHANGE teamid teamid INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE draftpicks CHANGE Round Round TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE expansionlost CHANGE teamid teamid INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE forum CHANGE userid userid INT NOT NULL');
        $this->addSql('DROP INDEX Season_Week_Team ON gameplan');
        $this->addSql('ALTER TABLE injuries DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE injuries ADD PRIMARY KEY (playerid, season, week)');
        $this->addSql('ALTER TABLE issues CHANGE Sponsor Sponsor INT NOT NULL');
        $this->addSql('ALTER TABLE newplayers CHANGE flmid flmid INT NOT NULL, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE nflgames CHANGE week week INT NOT NULL, CHANGE secRemain secRemain INT NOT NULL, CHANGE complete complete INT NOT NULL');
        $this->addSql('ALTER TABLE nflrosters CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE nflstatus CHANGE week week INT NOT NULL');
        $this->addSql('ALTER TABLE nflteams CHANGE nflteam nflteam CHAR(3) DEFAULT \'\'\'\'\'\' NOT NULL');
        $this->addSql('ALTER TABLE nfltransactions CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE TeamAID TeamAID INT NOT NULL, CHANGE TeamBID TeamBID INT NOT NULL, CHANGE LastOfferID LastOfferID INT NOT NULL');
        $this->addSql('ALTER TABLE offeredpicks CHANGE OfferID OfferID INT NOT NULL, CHANGE TeamFromID TeamFromID INT NOT NULL, CHANGE Round Round TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE offeredplayers CHANGE OfferID OfferID INT NOT NULL, CHANGE TeamFromID TeamFromID INT NOT NULL, CHANGE PlayerID PlayerID INT NOT NULL');
        $this->addSql('ALTER TABLE offeredpoints CHANGE OfferID OfferID INT NOT NULL, CHANGE TeamFromID TeamFromID INT NOT NULL, CHANGE Points Points TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE owners CHANGE teamid teamid INT NOT NULL, CHANGE userid userid INT NOT NULL');
        $this->addSql('ALTER TABLE paid CHANGE previous previous DOUBLE PRECISION DEFAULT NULL, CHANGE late_fee late_fee DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE playeroverride DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE playeroverride ADD PRIMARY KEY (playerid, season, teamid)');
        $this->addSql('ALTER TABLE playerscores CHANGE playerid playerid INT NOT NULL, CHANGE season season INT NOT NULL, CHANGE week week INT NOT NULL');
        $this->addSql('ALTER TABLE playerteams CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE positioncost CHANGE years years INT NOT NULL, CHANGE cost cost INT DEFAULT NULL');
        $this->addSql('ALTER TABLE protectionallocation CHANGE TeamID TeamID INT NOT NULL, CHANGE HC HC TINYINT(1) NOT NULL, CHANGE QB QB TINYINT(1) NOT NULL, CHANGE RB RB TINYINT(1) NOT NULL, CHANGE WR WR TINYINT(1) NOT NULL, CHANGE TE TE TINYINT(1) NOT NULL, CHANGE K K TINYINT(1) NOT NULL, CHANGE OL OL TINYINT(1) NOT NULL, CHANGE DL DL TINYINT(1) NOT NULL, CHANGE LB LB TINYINT(1) NOT NULL, CHANGE DB DB TINYINT(1) NOT NULL, CHANGE General General TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE protectioncost CHANGE playerid playerid INT NOT NULL, CHANGE years years INT DEFAULT NULL');
        $this->addSql('ALTER TABLE protections CHANGE teamid teamid INT NOT NULL, CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE rankedvote CHANGE issueid issueid INT NOT NULL, CHANGE teamid teamid INT NOT NULL, CHANGE `rank` `rank` INT NOT NULL');
        $this->addSql('DROP INDEX revisedactivations_season_week_playerid_index ON revisedactivations');
        $this->addSql('DROP INDEX revisedactivations_teamid_index ON revisedactivations');
        $this->addSql('ALTER TABLE revisedactivations CHANGE week week INT NOT NULL, CHANGE teamid teamid INT NOT NULL, CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE roster CHANGE PlayerID PlayerID INT NOT NULL, CHANGE TeamID TeamID INT NOT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE Week Week TINYINT(1) NOT NULL, CHANGE TeamA TeamA INT NOT NULL, CHANGE TeamB TeamB INT NOT NULL, CHANGE overtime overtime TINYINT(1) NOT NULL, CHANGE playoffs playoffs TINYINT(1) NOT NULL, CHANGE postseason postseason TINYINT(1) NOT NULL, CHANGE championship championship TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE stats DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE stats CHANGE statid statid INT NOT NULL, CHANGE week week INT NOT NULL, CHANGE yards yards INT DEFAULT NULL, CHANGE intthrow intthrow INT DEFAULT NULL, CHANGE rec rec INT DEFAULT NULL, CHANGE fum fum INT DEFAULT NULL, CHANGE tackles tackles INT DEFAULT NULL, CHANGE sacks sacks DOUBLE PRECISION DEFAULT NULL, CHANGE intcatch intcatch INT DEFAULT NULL, CHANGE passdefend passdefend INT DEFAULT NULL, CHANGE returnyards returnyards INT DEFAULT NULL, CHANGE fumrec fumrec INT DEFAULT NULL, CHANGE forcefum forcefum INT DEFAULT NULL, CHANGE tds tds INT DEFAULT NULL, CHANGE 2pt 2pt INT DEFAULT NULL, CHANGE specTD specTD INT DEFAULT NULL, CHANGE Safety Safety INT NOT NULL, CHANGE XP XP INT NOT NULL, CHANGE MissXP MissXP INT NOT NULL, CHANGE FG30 FG30 INT NOT NULL, CHANGE FG40 FG40 INT NOT NULL, CHANGE FG50 FG50 INT NOT NULL, CHANGE FG60 FG60 INT NOT NULL, CHANGE MissFG30 MissFG30 INT NOT NULL, CHANGE blockpunt blockpunt INT NOT NULL, CHANGE blockfg blockfg INT NOT NULL, CHANGE blockxp blockxp INT NOT NULL, CHANGE penalties penalties INT NOT NULL');
        $this->addSql('ALTER TABLE stats ADD PRIMARY KEY (statid, week, Season)');
        $this->addSql('ALTER TABLE team CHANGE DivisionID DivisionID INT NOT NULL, CHANGE fulllogo fulllogo TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE teamnames CHANGE teamid teamid INT NOT NULL, CHANGE divisionId divisionId INT NOT NULL');
        $this->addSql('ALTER TABLE titles CHANGE teamid teamid INT NOT NULL');
        $this->addSql('ALTER TABLE trade CHANGE TeamFromID TeamFromID INT NOT NULL, CHANGE TeamToID TeamToID INT NOT NULL, CHANGE TradeGroup TradeGroup INT NOT NULL');
        $this->addSql('ALTER TABLE transactions CHANGE TeamID TeamID INT NOT NULL, CHANGE PlayerID PlayerID INT NOT NULL');
        $this->addSql('ALTER TABLE transpoints DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE transpoints CHANGE season season INT NOT NULL, CHANGE TeamID TeamID INT NOT NULL, CHANGE ProtectionPts ProtectionPts INT NOT NULL, CHANGE TransPts TransPts INT NOT NULL, CHANGE TotalPts TotalPts INT NOT NULL');
        $this->addSql('ALTER TABLE transpoints ADD PRIMARY KEY (season, TeamID)');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, CHANGE primaryowner primaryowner TINYINT(1) NOT NULL, CHANGE commish commish TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE waiveraward CHANGE week week TINYINT(1) NOT NULL, CHANGE pick pick TINYINT(1) NOT NULL, CHANGE teamid teamid TINYINT(1) NOT NULL, CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE waiverorder CHANGE week week INT NOT NULL, CHANGE ordernumber ordernumber INT NOT NULL, CHANGE teamid teamid INT NOT NULL');
        $this->addSql('ALTER TABLE waiverpicks CHANGE teamid teamid INT NOT NULL, CHANGE week week INT NOT NULL, CHANGE priority priority INT NOT NULL, CHANGE playerid playerid INT NOT NULL');
        $this->addSql('ALTER TABLE weekmap CHANGE Week Week INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activations CHANGE TeamID TeamID INT DEFAULT 0 NOT NULL, CHANGE Week Week TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE HC HC INT DEFAULT 0 NOT NULL, CHANGE QB QB INT DEFAULT 0 NOT NULL, CHANGE RB1 RB1 INT DEFAULT 0 NOT NULL, CHANGE RB2 RB2 INT DEFAULT 0 NOT NULL, CHANGE WR1 WR1 INT DEFAULT 0 NOT NULL, CHANGE WR2 WR2 INT DEFAULT 0 NOT NULL, CHANGE TE TE INT DEFAULT 0 NOT NULL, CHANGE K K INT DEFAULT 0 NOT NULL, CHANGE OL OL INT DEFAULT 0 NOT NULL, CHANGE DL1 DL1 INT DEFAULT 0 NOT NULL, CHANGE DL2 DL2 INT DEFAULT 0 NOT NULL, CHANGE LB1 LB1 INT DEFAULT 0 NOT NULL, CHANGE LB2 LB2 INT DEFAULT 0 NOT NULL, CHANGE DB1 DB1 INT DEFAULT 0 NOT NULL, CHANGE DB2 DB2 INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE articles CHANGE active active TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE priority priority INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ballot DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ballot CHANGE TeamID TeamID INT DEFAULT 0 NOT NULL, CHANGE IssueID IssueID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ballot ADD PRIMARY KEY (IssueID, TeamID)');
        $this->addSql('ALTER TABLE chat CHANGE userid userid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE comments CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE config CHANGE `key` `key` VARCHAR(255) CHARACTER SET latin1 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE division CHANGE DivisionID DivisionID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE draftdate CHANGE UserID UserID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE draftpickhold CHANGE teamid teamid INT NOT NULL');
        $this->addSql('ALTER TABLE draftpicks CHANGE Round Round TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE expansionlost CHANGE teamid teamid INT NOT NULL');
        $this->addSql('ALTER TABLE forum CHANGE userid userid INT DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX Season_Week_Team ON gameplan (season, week, teamid, side)');
        $this->addSql('ALTER TABLE injuries DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE injuries ADD PRIMARY KEY (season, week, playerid)');
        $this->addSql('ALTER TABLE issues CHANGE Sponsor Sponsor INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE newplayers CHANGE flmid flmid INT DEFAULT 0 NOT NULL, CHANGE active active TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE nflgames CHANGE week week INT DEFAULT 0 NOT NULL, CHANGE secRemain secRemain INT DEFAULT 0 NOT NULL, CHANGE complete complete INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE nflrosters CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE nflstatus CHANGE week week INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE nflteams CHANGE nflteam nflteam CHAR(3) CHARACTER SET latin1 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE nfltransactions CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE TeamAID TeamAID INT DEFAULT 0 NOT NULL, CHANGE TeamBID TeamBID INT DEFAULT 0 NOT NULL, CHANGE LastOfferID LastOfferID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE offeredpicks CHANGE OfferID OfferID INT DEFAULT 0 NOT NULL, CHANGE TeamFromID TeamFromID INT DEFAULT 0 NOT NULL, CHANGE Round Round TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE offeredplayers CHANGE OfferID OfferID INT DEFAULT 0 NOT NULL, CHANGE TeamFromID TeamFromID INT DEFAULT 0 NOT NULL, CHANGE PlayerID PlayerID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE offeredpoints CHANGE OfferID OfferID INT DEFAULT 0 NOT NULL, CHANGE TeamFromID TeamFromID INT DEFAULT 0 NOT NULL, CHANGE Points Points TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE owners CHANGE teamid teamid INT DEFAULT 0 NOT NULL, CHANGE userid userid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE paid CHANGE previous previous DOUBLE PRECISION DEFAULT \'0\', CHANGE late_fee late_fee DOUBLE PRECISION DEFAULT \'0\'');
        $this->addSql('ALTER TABLE playeroverride DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE playeroverride ADD PRIMARY KEY (playerid, teamid, season)');
        $this->addSql('ALTER TABLE playerscores CHANGE playerid playerid INT DEFAULT 0 NOT NULL, CHANGE season season INT DEFAULT 0 NOT NULL, CHANGE week week INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE playerteams CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE positioncost CHANGE years years INT DEFAULT 0 NOT NULL, CHANGE cost cost INT DEFAULT 0');
        $this->addSql('ALTER TABLE protectionallocation CHANGE TeamID TeamID INT DEFAULT 0 NOT NULL, CHANGE HC HC TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE QB QB TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE RB RB TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE WR WR TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE TE TE TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE K K TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE OL OL TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE DL DL TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE LB LB TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE DB DB TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE General General TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE protectioncost CHANGE playerid playerid INT DEFAULT 0 NOT NULL, CHANGE years years INT DEFAULT 0');
        $this->addSql('ALTER TABLE protections CHANGE teamid teamid INT DEFAULT 0 NOT NULL, CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE rankedvote CHANGE issueid issueid INT DEFAULT 0 NOT NULL, CHANGE teamid teamid INT DEFAULT 0 NOT NULL, CHANGE `rank` `rank` INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE revisedactivations CHANGE week week INT DEFAULT 0 NOT NULL, CHANGE teamid teamid INT DEFAULT 0 NOT NULL, CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX revisedactivations_season_week_playerid_index ON revisedactivations (season, week, playerid)');
        $this->addSql('CREATE INDEX revisedactivations_teamid_index ON revisedactivations (teamid)');
        $this->addSql('ALTER TABLE roster CHANGE PlayerID PlayerID INT DEFAULT 0 NOT NULL, CHANGE TeamID TeamID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE Week Week TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE TeamA TeamA INT DEFAULT 0 NOT NULL, CHANGE TeamB TeamB INT DEFAULT 0 NOT NULL, CHANGE overtime overtime TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE playoffs playoffs TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE postseason postseason TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE championship championship TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE stats DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE stats CHANGE statid statid INT DEFAULT 0 NOT NULL, CHANGE week week INT DEFAULT 0 NOT NULL, CHANGE yards yards INT DEFAULT 0, CHANGE intthrow intthrow INT DEFAULT 0, CHANGE rec rec INT DEFAULT 0, CHANGE fum fum INT DEFAULT 0, CHANGE tackles tackles INT DEFAULT 0, CHANGE sacks sacks DOUBLE PRECISION DEFAULT \'0\', CHANGE intcatch intcatch INT DEFAULT 0, CHANGE passdefend passdefend INT DEFAULT 0, CHANGE returnyards returnyards INT DEFAULT 0, CHANGE fumrec fumrec INT DEFAULT 0, CHANGE forcefum forcefum INT DEFAULT 0, CHANGE tds tds INT DEFAULT 0, CHANGE 2pt 2pt INT DEFAULT 0, CHANGE specTD specTD INT DEFAULT 0, CHANGE Safety Safety INT DEFAULT 0 NOT NULL, CHANGE XP XP INT DEFAULT 0 NOT NULL, CHANGE MissXP MissXP INT DEFAULT 0 NOT NULL, CHANGE FG30 FG30 INT DEFAULT 0 NOT NULL, CHANGE FG40 FG40 INT DEFAULT 0 NOT NULL, CHANGE FG50 FG50 INT DEFAULT 0 NOT NULL, CHANGE FG60 FG60 INT DEFAULT 0 NOT NULL, CHANGE MissFG30 MissFG30 INT DEFAULT 0 NOT NULL, CHANGE blockpunt blockpunt INT DEFAULT 0 NOT NULL, CHANGE blockfg blockfg INT DEFAULT 0 NOT NULL, CHANGE blockxp blockxp INT DEFAULT 0 NOT NULL, CHANGE penalties penalties INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE stats ADD PRIMARY KEY (statid, Season, week)');
        $this->addSql('ALTER TABLE team CHANGE DivisionID DivisionID INT DEFAULT 0 NOT NULL, CHANGE fulllogo fulllogo TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE teamnames CHANGE teamid teamid INT DEFAULT 0 NOT NULL, CHANGE divisionId divisionId INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE titles CHANGE teamid teamid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE trade CHANGE TeamFromID TeamFromID INT DEFAULT 0 NOT NULL, CHANGE TeamToID TeamToID INT DEFAULT 0 NOT NULL, CHANGE TradeGroup TradeGroup INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE transactions CHANGE TeamID TeamID INT DEFAULT 0 NOT NULL, CHANGE PlayerID PlayerID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE transpoints DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE transpoints CHANGE season season INT DEFAULT 0 NOT NULL, CHANGE TeamID TeamID INT DEFAULT 0 NOT NULL, CHANGE ProtectionPts ProtectionPts INT DEFAULT 0 NOT NULL, CHANGE TransPts TransPts INT DEFAULT 0 NOT NULL, CHANGE TotalPts TotalPts INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE transpoints ADD PRIMARY KEY (TeamID, season)');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE primaryowner primaryowner TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE commish commish TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE waiveraward CHANGE week week TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE pick pick TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE teamid teamid TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE waiverorder CHANGE week week INT DEFAULT 0 NOT NULL, CHANGE ordernumber ordernumber INT DEFAULT 0 NOT NULL, CHANGE teamid teamid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE waiverpicks CHANGE teamid teamid INT DEFAULT 0 NOT NULL, CHANGE week week INT DEFAULT 0 NOT NULL, CHANGE priority priority INT DEFAULT 0 NOT NULL, CHANGE playerid playerid INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE weekmap CHANGE Week Week INT DEFAULT 0 NOT NULL');
    }
}
