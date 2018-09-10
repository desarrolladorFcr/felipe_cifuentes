<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180910081618 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE procesos (id INT AUTO_INCREMENT NOT NULL, sede_id INT DEFAULT NULL, serial VARCHAR(8) NOT NULL, descripcion VARCHAR(200) NOT NULL, creacion DATE NOT NULL, presupuesto DOUBLE PRECISION DEFAULT NULL, INDEX IDX_E493B93FE19F41BF (sede_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE procesos ADD CONSTRAINT FK_E493B93FE19F41BF FOREIGN KEY (sede_id) REFERENCES sedes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE procesos');
    }
}
