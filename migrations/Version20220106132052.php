<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106132052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(30) NOT NULL, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_options (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, native_language_id INT NOT NULL, language_to_learn_id INT NOT NULL, UNIQUE INDEX UNIQ_8838E48D9D86650F (user_id_id), UNIQUE INDEX UNIQ_8838E48DF44D7B10 (native_language_id), UNIQUE INDEX UNIQ_8838E48D97B41181 (language_to_learn_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_options ADD CONSTRAINT FK_8838E48D9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_options ADD CONSTRAINT FK_8838E48DF44D7B10 FOREIGN KEY (native_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE user_options ADD CONSTRAINT FK_8838E48D97B41181 FOREIGN KEY (language_to_learn_id) REFERENCES language (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_options DROP FOREIGN KEY FK_8838E48DF44D7B10');
        $this->addSql('ALTER TABLE user_options DROP FOREIGN KEY FK_8838E48D97B41181');
        $this->addSql('ALTER TABLE user_options DROP FOREIGN KEY FK_8838E48D9D86650F');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_options');
    }
}
