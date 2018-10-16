<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181015143826 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, relation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD newsletter_id INT DEFAULT NULL, DROP news_suscribed');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64922DB1917 FOREIGN KEY (newsletter_id) REFERENCES newsletter (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64922DB1917 ON user (newsletter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64922DB1917');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP INDEX IDX_8D93D64922DB1917 ON user');
        $this->addSql('ALTER TABLE user ADD news_suscribed TINYINT(1) NOT NULL, DROP newsletter_id');
    }
}
