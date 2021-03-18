<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class CatNotMigration_104
 */
class CatNotMigration_104 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('cat_not', [
                'columns' => [
                    new Column(
                        'id_juncao',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 3,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'id_noticia',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'id_juncao'
                        ]
                    ),
                    new Column(
                        'id_categoria',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 3,
                            'after' => 'id_noticia'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id_juncao'], 'PRIMARY'),
                    new Index('fk_id_noticia', ['id_noticia'], null),
                    new Index('fk_id_categoria', ['id_categoria'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_id_categoria',
                        [
                            'referencedTable' => 'categoria',
                            'referencedSchema' => 'phalcont_teste01',
                            'columns' => ['id_categoria'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    ),
                    new Reference(
                        'fk_id_noticia',
                        [
                            'referencedTable' => 'noticia',
                            'referencedSchema' => 'phalcont_teste01',
                            'columns' => ['id_noticia'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '4',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
