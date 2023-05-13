<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512200101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce_comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', count_like INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_6E1BC80CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_comment_like (id INT AUTO_INCREMENT NOT NULL, annonce_comment_id INT DEFAULT NULL, author_id INT DEFAULT NULL, count_annonce_comment_likes INT DEFAULT NULL, INDEX IDX_6C4211F8E61DA890 (annonce_comment_id), UNIQUE INDEX UNIQ_6C4211F8F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_comment_like (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, post_comment_id INT DEFAULT NULL, count_post_comment_like INT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_21689F8CF675F31B (author_id), INDEX IDX_21689F8CDB1174D2 (post_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', count_comment INT NOT NULL, image LONGTEXT DEFAULT NULL, INDEX IDX_CC794C66F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usercomment_like (id INT AUTO_INCREMENT NOT NULL, user_comment_id INT DEFAULT NULL, count_like INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7DF399345F0EBBFF (user_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce_comment ADD CONSTRAINT FK_6E1BC80CF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE annonce_comment_like ADD CONSTRAINT FK_6C4211F8E61DA890 FOREIGN KEY (annonce_comment_id) REFERENCES annonce_comment (id)');
        $this->addSql('ALTER TABLE annonce_comment_like ADD CONSTRAINT FK_6C4211F8F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE post_comment_like ADD CONSTRAINT FK_21689F8CF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE post_comment_like ADD CONSTRAINT FK_21689F8CDB1174D2 FOREIGN KEY (post_comment_id) REFERENCES post_comment (id)');
        $this->addSql('ALTER TABLE user_comment ADD CONSTRAINT FK_CC794C66F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE usercomment_like ADD CONSTRAINT FK_7DF399345F0EBBFF FOREIGN KEY (user_comment_id) REFERENCES user_comment (id)');
        $this->addSql('ALTER TABLE post ADD image LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE post_comment ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post_comment ADD CONSTRAINT FK_A99CE55F4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_A99CE55F4B89032C ON post_comment (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_comment DROP FOREIGN KEY FK_6E1BC80CF675F31B');
        $this->addSql('ALTER TABLE annonce_comment_like DROP FOREIGN KEY FK_6C4211F8E61DA890');
        $this->addSql('ALTER TABLE annonce_comment_like DROP FOREIGN KEY FK_6C4211F8F675F31B');
        $this->addSql('ALTER TABLE post_comment_like DROP FOREIGN KEY FK_21689F8CF675F31B');
        $this->addSql('ALTER TABLE post_comment_like DROP FOREIGN KEY FK_21689F8CDB1174D2');
        $this->addSql('ALTER TABLE user_comment DROP FOREIGN KEY FK_CC794C66F675F31B');
        $this->addSql('ALTER TABLE usercomment_like DROP FOREIGN KEY FK_7DF399345F0EBBFF');
        $this->addSql('DROP TABLE annonce_comment');
        $this->addSql('DROP TABLE annonce_comment_like');
        $this->addSql('DROP TABLE post_comment_like');
        $this->addSql('DROP TABLE user_comment');
        $this->addSql('DROP TABLE usercomment_like');
        $this->addSql('ALTER TABLE post_comment DROP FOREIGN KEY FK_A99CE55F4B89032C');
        $this->addSql('DROP INDEX IDX_A99CE55F4B89032C ON post_comment');
        $this->addSql('ALTER TABLE post_comment DROP post_id');
        $this->addSql('ALTER TABLE post DROP image');
    }
}
