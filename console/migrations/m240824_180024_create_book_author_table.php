<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m240824_180024_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-book_author-book_id', '{{%book_author}}', 'book_id');
        $this->createIndex('idx-book_author-author_id', '{{%book_author}}', 'author_id');

        $this->addForeignKey('fk-book_author-book', '{{%book_author}}', 'book_id', '{{%books}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-book_author-author', '{{%book_author}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'RESTRICT');

        $this->addCommentOnTable('{{%book_author}}', 'Авторы');
        $this->addCommentOnColumn('{{%book_author}}', 'book_id', 'Идентификатор книги');
        $this->addCommentOnColumn('{{%book_author}}', 'author_id', 'Идентификатор автора');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
