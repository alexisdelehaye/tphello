<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110094205 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9975F8742E');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A460BB6FE6');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779481FBEEF7B');
        $this->addSql('ALTER TABLE suite DROP FOREIGN KEY FK_153CE426C5905AF8');
        $this->addSql('ALTER TABLE suite DROP FOREIGN KEY FK_153CE426E4C89235');
        $this->addSql('ALTER TABLE histoire DROP FOREIGN KEY FK_FD74CD684296D31F');
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B0259B94373');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779489B94373');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251ECE11AAC7');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB8CEBACA0');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091DC304035');
        $this->addSql('ALTER TABLE histoire DROP FOREIGN KEY FK_FD74CD68A76ED395');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C1677948A76ED395');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE auteurs');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE histoire');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('DROP TABLE lecture');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE livres');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE suite');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE types');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE weapon_user CHANGE quality quality INT NOT NULL, CHANGE ammunition ammunition INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, prenom VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE auteurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, prenom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, histoire_id INT DEFAULT NULL, texte TEXT NOT NULL COLLATE utf8mb4_unicode_ci, titre VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, titre_court VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, photo VARCHAR(256) NOT NULL COLLATE utf8mb4_unicode_ci, question VARCHAR(256) DEFAULT NULL COLLATE utf8mb4_unicode_ci, premier SMALLINT NOT NULL, INDEX IDX_8C62B0259B94373 (histoire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE histoire (id INT AUTO_INCREMENT NOT NULL, genre_id INT DEFAULT NULL, user_id INT DEFAULT NULL, titre VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, pitch TEXT NOT NULL COLLATE utf8mb4_unicode_ci, photo VARCHAR(256) NOT NULL COLLATE utf8mb4_unicode_ci, actif TINYINT(1) NOT NULL, INDEX IDX_FD74CD68A76ED395 (user_id), INDEX IDX_FD74CD684296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, item_type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity INT NOT NULL, INDEX IDX_1F1B251EA76ED395 (user_id), INDEX IDX_1F1B251ECE11AAC7 (item_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, weight INT NOT NULL, picture VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lecture (id INT AUTO_INCREMENT NOT NULL, chapitre_id INT DEFAULT NULL, user_id INT DEFAULT NULL, histoire_id INT DEFAULT NULL, date_lecture DATETIME NOT NULL, num_sequence INT NOT NULL, INDEX IDX_C1677948A76ED395 (user_id), INDEX IDX_C16779481FBEEF7B (chapitre_id), INDEX IDX_C16779489B94373 (histoire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, auteur_id_id INT NOT NULL, titre VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, editeur VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_AC634F9975F8742E (auteur_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livres (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, editeur VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, date_publication DATE NOT NULL, INDEX IDX_927187A460BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, nom_loueur VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, email_loueur VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, date_debut_location DATE NOT NULL, duree_jours VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:dateinterval)\', INDEX IDX_5E9E89CB8CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, salle_id INT DEFAULT NULL, numero VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_18D2B091DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, batiment VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE suite (id INT AUTO_INCREMENT NOT NULL, chapitre_source_id INT DEFAULT NULL, chapitre_destination_id INT DEFAULT NULL, reponse VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_153CE426C5905AF8 (chapitre_destination_id), INDEX IDX_153CE426E4C89235 (chapitre_source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, weight INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, weight INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nom VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, prenom VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B0259B94373 FOREIGN KEY (histoire_id) REFERENCES histoire (id)');
        $this->addSql('ALTER TABLE histoire ADD CONSTRAINT FK_FD74CD684296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE histoire ADD CONSTRAINT FK_FD74CD68A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251ECE11AAC7 FOREIGN KEY (item_type_id) REFERENCES item_type (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779481FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779489B94373 FOREIGN KEY (histoire_id) REFERENCES histoire (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C1677948A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9975F8742E FOREIGN KEY (auteur_id_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A460BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteurs (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE suite ADD CONSTRAINT FK_153CE426C5905AF8 FOREIGN KEY (chapitre_destination_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE suite ADD CONSTRAINT FK_153CE426E4C89235 FOREIGN KEY (chapitre_source_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE weapon_user CHANGE quality quality INT DEFAULT NULL, CHANGE ammunition ammunition INT DEFAULT NULL');
    }
}
