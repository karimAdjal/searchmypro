<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231017195639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, secteur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emplacement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_emplacement (entreprise_id INT NOT NULL, emplacement_id INT NOT NULL, INDEX IDX_F7B8C99DA4AEAFEA (entreprise_id), INDEX IDX_F7B8C99DC4598A51 (emplacement_id), PRIMARY KEY(entreprise_id, emplacement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_category (entreprise_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_549C1F44A4AEAFEA (entreprise_id), INDEX IDX_549C1F4412469DE2 (category_id), PRIMARY KEY(entreprise_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_entreprise (user_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_AA7E3C8CA76ED395 (user_id), INDEX IDX_AA7E3C8CA4AEAFEA (entreprise_id), PRIMARY KEY(user_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_emplacement ADD CONSTRAINT FK_F7B8C99DA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_emplacement ADD CONSTRAINT FK_F7B8C99DC4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_category ADD CONSTRAINT FK_549C1F44A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_category ADD CONSTRAINT FK_549C1F4412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_entreprise ADD CONSTRAINT FK_AA7E3C8CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_entreprise ADD CONSTRAINT FK_AA7E3C8CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_emplacement DROP FOREIGN KEY FK_F7B8C99DA4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_emplacement DROP FOREIGN KEY FK_F7B8C99DC4598A51');
        $this->addSql('ALTER TABLE entreprise_category DROP FOREIGN KEY FK_549C1F44A4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_category DROP FOREIGN KEY FK_549C1F4412469DE2');
        $this->addSql('ALTER TABLE user_entreprise DROP FOREIGN KEY FK_AA7E3C8CA76ED395');
        $this->addSql('ALTER TABLE user_entreprise DROP FOREIGN KEY FK_AA7E3C8CA4AEAFEA');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_emplacement');
        $this->addSql('DROP TABLE entreprise_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_entreprise');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
