<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512200815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_comment_like (id INT AUTO_INCREMENT NOT NULL, user_comment_id INT DEFAULT NULL, count_like INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A999E5D5F0EBBFF (user_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_comment_like ADD CONSTRAINT FK_A999E5D5F0EBBFF FOREIGN KEY (user_comment_id) REFERENCES user_comment (id)');
        $this->addSql('ALTER TABLE usercomment_like DROP FOREIGN KEY FK_7DF399345F0EBBFF');
        $this->addSql('DROP TABLE usercomment_like');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usercomment_like (id INT AUTO_INCREMENT NOT NULL, user_comment_id INT DEFAULT NULL, count_like INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7DF399345F0EBBFF (user_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE usercomment_like ADD CONSTRAINT FK_7DF399345F0EBBFF FOREIGN KEY (user_comment_id) REFERENCES user_comment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_comment_like DROP FOREIGN KEY FK_A999E5D5F0EBBFF');
        $this->addSql('DROP TABLE user_comment_like');
    }
}
