<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924154500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sell_amount (id INT AUTO_INCREMENT NOT NULL, selldatebreak INT DEFAULT NULL, tourcategory INT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_EC64C5D1BE20104A (selldatebreak), INDEX IDX_EC64C5D132EE7D3D (tourcategory), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sell_date_break (id INT AUTO_INCREMENT NOT NULL, tour INT DEFAULT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, mon TINYINT(1) NOT NULL, tue TINYINT(1) NOT NULL, wed TINYINT(1) NOT NULL, thu TINYINT(1) NOT NULL, fri TINYINT(1) NOT NULL, sat TINYINT(1) NOT NULL, sun TINYINT(1) NOT NULL, INDEX IDX_CFDDE9986AD1F969 (tour), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour_category (id INT AUTO_INCREMENT NOT NULL, tour INT DEFAULT NULL, code VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, min INT NOT NULL, max INT NOT NULL, pricing VARCHAR(2) NOT NULL, INDEX IDX_9CB340F26AD1F969 (tour), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour_feature (id INT AUTO_INCREMENT NOT NULL, tour INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_5F3DF0E76AD1F969 (tour), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour_itinerary (id INT AUTO_INCREMENT NOT NULL, tour INT DEFAULT NULL, header VARCHAR(255) NOT NULL, description VARCHAR(1048) NOT NULL, INDEX IDX_4068A6B96AD1F969 (tour), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sell_amount ADD CONSTRAINT FK_EC64C5D1BE20104A FOREIGN KEY (selldatebreak) REFERENCES sell_date_break (id)');
        $this->addSql('ALTER TABLE sell_amount ADD CONSTRAINT FK_EC64C5D132EE7D3D FOREIGN KEY (tourcategory) REFERENCES tour_category (id)');
        $this->addSql('ALTER TABLE sell_date_break ADD CONSTRAINT FK_CFDDE9986AD1F969 FOREIGN KEY (tour) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE tour_category ADD CONSTRAINT FK_9CB340F26AD1F969 FOREIGN KEY (tour) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE tour_feature ADD CONSTRAINT FK_5F3DF0E76AD1F969 FOREIGN KEY (tour) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE tour_itinerary ADD CONSTRAINT FK_4068A6B96AD1F969 FOREIGN KEY (tour) REFERENCES tour (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sell_amount DROP FOREIGN KEY FK_EC64C5D1BE20104A');
        $this->addSql('ALTER TABLE sell_amount DROP FOREIGN KEY FK_EC64C5D132EE7D3D');
        $this->addSql('DROP TABLE sell_amount');
        $this->addSql('DROP TABLE sell_date_break');
        $this->addSql('DROP TABLE tour_category');
        $this->addSql('DROP TABLE tour_feature');
        $this->addSql('DROP TABLE tour_itinerary');
    }
}
