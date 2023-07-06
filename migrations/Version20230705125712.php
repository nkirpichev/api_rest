<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705125712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur_ouvrage (auteur_id INT NOT NULL, ouvrage_id INT NOT NULL, INDEX IDX_EC8A08BD60BB6FE6 (auteur_id), INDEX IDX_EC8A08BD15D884B5 (ouvrage_id), PRIMARY KEY(auteur_id, ouvrage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ouvrage (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(100) NOT NULL, INDEX IDX_52A8CBD8BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur_ouvrage ADD CONSTRAINT FK_EC8A08BD60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteur_ouvrage ADD CONSTRAINT FK_EC8A08BD15D884B5 FOREIGN KEY (ouvrage_id) REFERENCES ouvrage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ouvrage ADD CONSTRAINT FK_52A8CBD8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur_ouvrage DROP FOREIGN KEY FK_EC8A08BD60BB6FE6');
        $this->addSql('ALTER TABLE auteur_ouvrage DROP FOREIGN KEY FK_EC8A08BD15D884B5');
        $this->addSql('ALTER TABLE ouvrage DROP FOREIGN KEY FK_52A8CBD8BCF5E72D');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE auteur_ouvrage');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE ouvrage');
    }
}
