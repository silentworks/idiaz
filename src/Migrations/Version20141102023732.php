<?php

namespace Idiaz\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141102023732 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable('ideas');
        $table->addColumn('id', 'integer', ['unsigned' => true]);
        $table->addColumn('title', 'string', ['length' => 150]);
        $table->addColumn('content', 'text');
        $table->addColumn('public', 'smallint', ['default' => 1]);
        $table->addColumn('display', 'smallint', ['default' => 1]);
        $table->addColumn('user_id', 'integer');
        $table->addColumn('ip_address', 'string', ['length' => 20]);
        $table->addColumn('created_by', 'integer');
        $table->addColumn('updated_by', 'integer');
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('deleted_at', 'datetime');
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('ideas');
    }
}
