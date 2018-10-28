<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181024093503 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quotation ADD object_subproduct VARCHAR(255) DEFAULT NULL, ADD web_subproduct VARCHAR(255) DEFAULT NULL, ADD marketing_subproduct VARCHAR(255) DEFAULT NULL, ADD motion_subproduct VARCHAR(255) DEFAULT NULL, ADD infographic_subproduct VARCHAR(255) DEFAULT NULL, ADD exe_subproduct VARCHAR(255) DEFAULT NULL, CHANGE subproduct print_subproduct VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quotation ADD subproduct VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP print_subproduct, DROP object_subproduct, DROP web_subproduct, DROP marketing_subproduct, DROP motion_subproduct, DROP infographic_subproduct, DROP exe_subproduct');
    }
}
