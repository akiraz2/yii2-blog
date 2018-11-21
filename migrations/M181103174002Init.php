<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\migrations;

use akiraz2\blog\Module;
use akiraz2\blog\traits\ModuleTrait;
use yii\db\Migration;

/**
 * Class M181103174002Init
 */
class M181103174002Init extends Migration
{
    use ModuleTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // table blog_category
        $this->createTable(
            '{{%blog_category}}',
            [
                'id' => $this->primaryKey(),
                'parent_id' => $this->integer()->null(),
                'lang' => $this->string(8)->notNull(),
                'title' => $this->string(255)->unique()->notNull(),
                'banner' => $this->string(255)->null(),
                'is_nav' => $this->tinyInteger()->defaultValue(0),
                'sort_order' => $this->tinyInteger()->defaultValue(0),
                'page_size' => $this->tinyInteger()->defaultValue(20),
                'template' => $this->string(128)->null(),
                'status' => $this->tinyInteger()->defaultValue(0),
                'seo_title' => $this->string(255)->null(),
                'seo_keywords' => $this->string(255)->null(),
                'seo_description' => $this->string(255)->null(),
                'seo_img' => $this->string(255)->null(),
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('ind_is_nav', '{{%blog_category}}', 'is_nav');
        $this->createIndex('ind_sort_order', '{{%blog_category}}', 'sort_order');
        $this->createIndex('ind_status', '{{%blog_category}}', 'status');

        // table blog_post
        $this->createTable(
            '{{%blog_post}}',
            [
                'id' => $this->primaryKey(),
                'parent_id' => $this->integer()->null(),
                'category_id' => $this->integer()->notNull(),
                'lang' => $this->string(8)->notNull(),
                'title' => $this->string(255)->unique()->notNull(),
                'brief' => $this->text()->null(),
                'content' => $this->text()->notNull(),
                'banner' => $this->string(255)->null(),
                'click' => $this->integer()->defaultValue(0),
                'rate' => $this->integer()->defaultValue(0),
                'user_id' => $this->integer()->null(),
                'status' => $this->tinyInteger()->defaultValue(0),
                'seo_title' => $this->string(255)->null(),
                'seo_keywords' => $this->string(255)->null(),
                'seo_description' => $this->string(255)->null(),
                'seo_img' => $this->string(255)->null(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->null(),
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('ind_category_id', '{{%blog_post}}', 'category_id');
        $this->createIndex('ind_status', '{{%blog_post}}', 'status');
        $this->createIndex('ind_created_at', '{{%blog_post}}', 'created_at');

        // Foreign Keys
        $this->addForeignKey('{{%FK_post_category}}', '{{%blog_post}}', 'category_id', '{{%blog_category}}', 'id', 'CASCADE', 'CASCADE');
        if ($this->getModule()->userModel) {
            $userClass = $this->getModule()->userModel;
            $this->addForeignKey('{{%FK_post_user}}', '{{%blog_post}}', 'user_id', $userClass::tableName(), $this->getModule()->userPK, 'CASCADE', 'CASCADE');
        }


        // table blog_comment
        $this->createTable(
            '{{%blog_comment}}',
            [
                'id' => $this->primaryKey(),
                'post_id' => $this->integer()->notNull(),
                'lang' => $this->string(8)->notNull(),
                'content' => $this->text()->notNull(),
                'author' => $this->string(128)->notNull(),
                'email' => $this->string(128)->notNull(),
                'status' => $this->tinyInteger()->defaultValue(0),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->null(),
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('ind_post_id', '{{%blog_comment}}', 'post_id');
        $this->createIndex('ind_status', '{{%blog_comment}}', 'status');
        $this->createIndex('ind_created_at', '{{%blog_comment}}', 'created_at');

        // Foreign Keys
        $this->addForeignKey('{{%FK_comment_post}}', '{{%blog_comment}}', 'post_id', '{{%blog_post}}', 'id', 'CASCADE', 'CASCADE');


        // table blog_tag
        $this->createTable(
            '{{%blog_tag}}',
            [
                'id' => $this->primaryKey(),
                'lang' => $this->string(8)->notNull(),
                'name' => $this->string(128)->notNull(),
                'frequency' => $this->integer()->defaultValue(0),
            ],
            $tableOptions
        );

        $this->insert('{{%blog_category}}', [
            'title' => Module::t('blog', 'Uncategorized'),
            'status' => 1,
            'lang' => \Yii::$app->language,
        ]);

        // table blog_tag
        $this->createTable(
            '{{%blog_rating}}',
            [
                'id' => $this->primaryKey(),
                'post_id' => $this->integer()->notNull(),
                'user_id' => $this->integer()->notNull(),
                'rating' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
        // Foreign Keys
        $this->addForeignKey('{{%FK_post_rating}}', '{{%blog_rating}}', 'post_id', '{{%blog_post}}', 'id', 'CASCADE', 'CASCADE');
        if ($this->getModule()->userModel) {
            $userClass = $this->getModule()->userModel;
            $this->addForeignKey('{{%FK_rating_user}}', '{{%blog_rating}}', 'user_id', $userClass::tableName(), $this->getModule()->userPK, 'CASCADE', 'CASCADE');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%FK_comment_post}}', '{{%blog_comment}}');
        if ($this->getModule()->userModel) {
            $userClass = $this->getModule()->userModel;
            $this->dropForeignKey('{{%FK_post_user}}', '{{%blog_post}}');
        }
        $this->dropForeignKey('{{%FK_post_category}}', '{{%blog_post}}');
        $this->dropForeignKey('{{%FK_post_rating}}', '{{%blog_rating}}');
        $this->dropTable('{{%blog_tag}}');
        $this->dropTable('{{%blog_comment}}');
        $this->dropTable('{{%blog_post}}');
        $this->dropTable('{{%blog_category}}');
        $this->dropTable('{{%blog_rating}}');
    }
}
