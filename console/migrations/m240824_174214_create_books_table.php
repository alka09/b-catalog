<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m240824_174214_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year_of_issue' => $this->integer()->notNull(),
            'description' => $this->string(),
            'isbn' => $this->boolean(),
            'photo' => $this->string(),
        ]);

        $this->addCommentOnTable('{{%books}}', 'Авторы');
        $this->addCommentOnColumn('{{%books}}', 'title', 'Название');
        $this->addCommentOnColumn('{{%books}}', 'year_of_issue', 'Год выпуска');
        $this->addCommentOnColumn('{{%books}}', 'description', 'Описание');
        $this->addCommentOnColumn('{{%books}}', 'isbn', '');
        $this->addCommentOnColumn('{{%books}}', 'photo', 'Фото обложки');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
