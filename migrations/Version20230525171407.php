<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525171407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, cin VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant_module (enseignant_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_75D33C4AE455FCC0 (enseignant_id), INDEX IDX_75D33C4AAFC2B591 (module_id), PRIMARY KEY(enseignant_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, cne VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filliere (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, id_filliere_id INT NOT NULL, id_semestre_id INT NOT NULL, nom VARCHAR(20) NOT NULL, INDEX IDX_C2426288BE8F7FD (id_filliere_id), INDEX IDX_C2426284D65622C (id_semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, id_etudiant_id INT NOT NULL, id_module_id INT NOT NULL, note VARCHAR(20) NOT NULL, INDEX IDX_CFBDFA14C5F87C54 (id_etudiant_id), INDEX IDX_CFBDFA142FF709B6 (id_module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseignant_module ADD CONSTRAINT FK_75D33C4AE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant_module ADD CONSTRAINT FK_75D33C4AAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426288BE8F7FD FOREIGN KEY (id_filliere_id) REFERENCES filliere (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426284D65622C FOREIGN KEY (id_semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14C5F87C54 FOREIGN KEY (id_etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA142FF709B6 FOREIGN KEY (id_module_id) REFERENCES module (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant_module DROP FOREIGN KEY FK_75D33C4AE455FCC0');
        $this->addSql('ALTER TABLE enseignant_module DROP FOREIGN KEY FK_75D33C4AAFC2B591');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426288BE8F7FD');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426284D65622C');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14C5F87C54');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA142FF709B6');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE enseignant_module');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE filliere');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
