<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311074203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recherche (id INT AUTO_INCREMENT NOT NULL, type_logement_id INT NOT NULL, localisation_id INT NOT NULL, vente_id INT NOT NULL, field VARCHAR(255) NOT NULL, nombre_piece INT NOT NULL, prix NUMERIC(10, 2) NOT NULL, surface_totale NUMERIC(10, 2) NOT NULL, INDEX IDX_B4271B4613B22EC4 (type_logement_id), INDEX IDX_B4271B46C68BE09C (localisation_id), INDEX IDX_B4271B467DC7170A (vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B4613B22EC4 FOREIGN KEY (type_logement_id) REFERENCES type_logement (id)');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B46C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B467DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE logement ADD vente_id INT NOT NULL');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD44577DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE INDEX IDX_F0FD44577DC7170A ON logement (vente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recherche');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD44577DC7170A');
        $this->addSql('DROP INDEX IDX_F0FD44577DC7170A ON logement');
        $this->addSql('ALTER TABLE logement DROP vente_id');
    }
}
