<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408201840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ano_academico (id INT AUTO_INCREMENT NOT NULL, curso_id INT DEFAULT NULL, nome_ano_academico VARCHAR(30) NOT NULL, INDEX IDX_71DC1E3787CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ano_lectivo (id INT AUTO_INCREMENT NOT NULL, nome_ano_lectivo VARCHAR(50) NOT NULL, data_inicio DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, ano_lectivo_id INT DEFAULT NULL, nome_curso VARCHAR(50) NOT NULL, coordinador VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(10) NOT NULL, INDEX IDX_CA3B40ECBDBCD812 (ano_lectivo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dicsiplina (id INT AUTO_INCREMENT NOT NULL, semestre_id INT DEFAULT NULL, nome_discilpina VARCHAR(50) NOT NULL, cant_horas INT NOT NULL, INDEX IDX_69B687C35577AFDB (semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante (id INT AUTO_INCREMENT NOT NULL, nome_estudiante VARCHAR(80) NOT NULL, edad INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante_dicsiplina (estudiante_id INT NOT NULL, dicsiplina_id INT NOT NULL, INDEX IDX_80C3196959590C39 (estudiante_id), INDEX IDX_80C31969A368F575 (dicsiplina_id), PRIMARY KEY(estudiante_id, dicsiplina_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, ano_academico_id INT DEFAULT NULL, nome_semestre VARCHAR(30) NOT NULL, INDEX IDX_71688FBC1C419774 (ano_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turma (id INT AUTO_INCREMENT NOT NULL, semestre_id INT DEFAULT NULL, nome_turma VARCHAR(30) NOT NULL, delegado VARCHAR(60) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(10) NOT NULL, INDEX IDX_2B0219A65577AFDB (semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turma_estudiante (turma_id INT NOT NULL, estudiante_id INT NOT NULL, INDEX IDX_10ED437ACEBA2CFD (turma_id), INDEX IDX_10ED437A59590C39 (estudiante_id), PRIMARY KEY(turma_id, estudiante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ano_academico ADD CONSTRAINT FK_71DC1E3787CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
        $this->addSql('ALTER TABLE curso ADD CONSTRAINT FK_CA3B40ECBDBCD812 FOREIGN KEY (ano_lectivo_id) REFERENCES ano_lectivo (id)');
        $this->addSql('ALTER TABLE dicsiplina ADD CONSTRAINT FK_69B687C35577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE estudiante_dicsiplina ADD CONSTRAINT FK_80C3196959590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estudiante_dicsiplina ADD CONSTRAINT FK_80C31969A368F575 FOREIGN KEY (dicsiplina_id) REFERENCES dicsiplina (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBC1C419774 FOREIGN KEY (ano_academico_id) REFERENCES ano_academico (id)');
        $this->addSql('ALTER TABLE turma ADD CONSTRAINT FK_2B0219A65577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE turma_estudiante ADD CONSTRAINT FK_10ED437ACEBA2CFD FOREIGN KEY (turma_id) REFERENCES turma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turma_estudiante ADD CONSTRAINT FK_10ED437A59590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBC1C419774');
        $this->addSql('ALTER TABLE curso DROP FOREIGN KEY FK_CA3B40ECBDBCD812');
        $this->addSql('ALTER TABLE ano_academico DROP FOREIGN KEY FK_71DC1E3787CB4A1F');
        $this->addSql('ALTER TABLE estudiante_dicsiplina DROP FOREIGN KEY FK_80C31969A368F575');
        $this->addSql('ALTER TABLE estudiante_dicsiplina DROP FOREIGN KEY FK_80C3196959590C39');
        $this->addSql('ALTER TABLE turma_estudiante DROP FOREIGN KEY FK_10ED437A59590C39');
        $this->addSql('ALTER TABLE dicsiplina DROP FOREIGN KEY FK_69B687C35577AFDB');
        $this->addSql('ALTER TABLE turma DROP FOREIGN KEY FK_2B0219A65577AFDB');
        $this->addSql('ALTER TABLE turma_estudiante DROP FOREIGN KEY FK_10ED437ACEBA2CFD');
        $this->addSql('DROP TABLE ano_academico');
        $this->addSql('DROP TABLE ano_lectivo');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE dicsiplina');
        $this->addSql('DROP TABLE estudiante');
        $this->addSql('DROP TABLE estudiante_dicsiplina');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE turma');
        $this->addSql('DROP TABLE turma_estudiante');
        $this->addSql('DROP TABLE user');
    }
}
