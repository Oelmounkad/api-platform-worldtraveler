<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606164529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, recommandation_id INT DEFAULT NULL, likes INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C61AAE789 (recommandation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, requester_id INT NOT NULL, hoster_id INT NOT NULL, location VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F515E139ED442CF4 (requester_id), INDEX IDX_F515E1394CAE8C6C (hoster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, full_name VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, birth_date VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8157AA0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, rater_id INT NOT NULL, rated_id INT NOT NULL, rating VARCHAR(255) NOT NULL, opinion VARCHAR(255) NOT NULL, INDEX IDX_D88926223FC1CD0A (rater_id), INDEX IDX_D88926224AB3C549 (rated_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C61AAE789 FOREIGN KEY (recommandation_id) REFERENCES recommandation (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139ED442CF4 FOREIGN KEY (requester_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E1394CAE8C6C FOREIGN KEY (hoster_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926223FC1CD0A FOREIGN KEY (rater_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926224AB3C549 FOREIGN KEY (rated_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recommandation ADD user_id INT NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD location VARCHAR(255) NOT NULL, ADD theme VARCHAR(255) NOT NULL, ADD picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A28A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C7782A28A76ED395 ON recommandation (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139ED442CF4');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E1394CAE8C6C');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926223FC1CD0A');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926224AB3C549');
        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A28A76ED395');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_C7782A28A76ED395 ON recommandation');
        $this->addSql('ALTER TABLE recommandation DROP user_id, DROP description, DROP city, DROP location, DROP theme, DROP picture');
    }
}
