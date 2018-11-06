<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\components;

use akiraz2\blog\traits\StaticCacheTrait;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class AdvancedActiveQuery
 *
 * @package akiraz2\models
 *
 */
class AdvancedActiveQuery extends ActiveQuery
{
    use StaticCacheTrait;

    /**
     * @var int Счетчик параметров в запросах, нужно для уникальности
     */
    private static $paramCounter = 0;
    /**
     * @var string|bool
     */
    private $tableAlias = null;

    public function __toString()
    {
        return $this->createCommand()->getRawSql();
    }

    /**
     * @inheritdoc
     * @return static|mixed
     */
    public function alias($alias)
    {
        $this->tableAlias = $alias;

        return parent::alias($alias);
    }

    /**
     * @param $value
     * @param $inverse
     *
     * @return static|ActiveQuery|$this
     */
    public function byPk($value, bool $inverse = null)
    {
        if ($value === null && !$inverse) {
            $this->inCache();
        }

        $primaryKey = $this->getPrimaryKeyField();
        if ($primaryKey !== false) {
            $this->byField($primaryKey, $value, $inverse);
        }

        return $this;
    }

    /**
     * @return int
     */
    protected function getPrimaryKeyField()
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = new $this->modelClass();

        $primaryKey = $modelClass->primaryKey();

        if (isset($primaryKey[0])) {
            return $primaryKey[0];
        }

        return null;
    }

    /**
     * @param            $field
     * @param            $value
     * @param bool|false $inverse
     *
     * @return $this
     */
    public function byField($field, $value, bool $inverse = null)
    {
        $fieldName = $this->field($field);
        if ($inverse) {
            if (is_null($value) || is_object($value)) {
                $this->andWhere(['not', [$fieldName => $value]]);
            } else {
                $inverseCondition = is_array($value) ? 'not in' : '!=';
                $this->andWhere([$inverseCondition, $fieldName, $value]);
            }

        } else {
            $this->andWhere([$fieldName => $value]);
        }

        return $this;
    }

    /**
     *
     * @param $attribute
     *
     * @return string
     */
    protected function field($attribute)
    {
        return implode('.', [$this->getTableAlias(), $attribute]);
    }

    /**
     *
     * @return mixed|string
     */
    protected function getTableAlias()
    {
        if (is_null($this->tableAlias)) {
            $tableName = call_user_func([$this->modelClass, 'tableName']);
            $result = $tableName;

            foreach ((array)$this->from as $alias => $table) {
                if ($table == $tableName && is_string($alias)) {
                    $result = $alias;
                    break;
                }
            }

            $this->tableAlias = $result;
        }

        return $this->tableAlias;
    }

    /**
     * @param null $db
     *
     * @return ActiveRecord|mixed
     */
    public function one($db = null)
    {
        $cacheKey = $this->getCacheKey($db);
        $cacheRows = null;

        if ($this->isUseStaticCache() && empty($this->with)) {
            $cacheRows = $this->getCacheValue($cacheKey);
        }

        if (!$cacheRows) {
            $cacheRows = parent::one($db);
        }

        $this->setCacheValue($cacheKey, $cacheRows);

        return $cacheRows;
    }

    /**
     * @param null $db
     *
     * @return string
     */
    protected function getCacheKey($db = null)
    {
        $sql = $this->createCommand($db)->getRawSql();

        return md5($sql);
    }

    /**
     * Высчитывает среднее среди не null полей из $arFields
     *
     * @param array $arFields
     * @param null $db
     *
     * @return mixed
     */
    public function averageByFields(array $arFields, $db = null)
    {
        return $this->average($this->getFieldsAverageCondition($arFields), $db);
    }

    /**
     * Получает select condition Для рассчета среднего значения по нескольким полям,
     * не использует в рассчете поля, значение которых IS NULL
     *
     * @param $arFields
     *
     * @return string
     */
    protected function getFieldsAverageCondition($arFields)
    {
        $valueFields = [];
        $countFields = [];

        foreach ($arFields as $fieldName) {
            $field = $this->field($fieldName);
            $valueFields[] = new Expression("IF($field IS NULL, 0, $field)");
            $countFields[] = new Expression("IF($field IS NULL, 0, 1)");
        }

        $valueCondition = "(" . implode(' + ', $valueFields) . ")";
        $countCondition = "(" . implode(' + ', $countFields) . ")";

        return $valueCondition . '/' . $countCondition;
    }

    /**
     * Добавляет выборку для поля unixtime, имеющем значение сегодняшнего дня
     *
     * @param      $fieldName
     *
     * @param bool $checkFutureDays Выбрать даты с последнего дня, включая даты в будущем
     *
     * @return $this
     */
    public function todayField($fieldName, $checkFutureDays = false)
    {
        return $this->lastDaysField($fieldName, 0, $checkFutureDays);
    }

    /**
     * Добавляет фильтрацию по полю, содержащего дату за последние $days дней
     *
     * @param      $fieldName
     * @param int $days
     *
     * @param bool $afterDays
     *
     * @return $this
     */
    public function lastDaysField($fieldName, $days = 0, $afterDays = true)
    {
        $compareSign = $afterDays ? '<=' : '=';
        $this->andWhere(new Expression('TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(' . $this->field($fieldName) . ')) ' . $compareSign . ' ' . $days));

        return $this;
    }

    /**
     * @return int|string
     */
    public function countByPk()
    {
        $pkField = $this->getPrimaryKeyField();

        if ($pkField !== false) {
            if ($this->isSimpleQuery()) {
                $field = $this->field($pkField);
            } else {
                $field = 'c.' . $pkField;
            }


            return $this->count('DISTINCT ' . $field);
        }

        return $this->count();
    }

    /**
     * @return bool
     */
    protected function isSimpleQuery()
    {
        return !$this->distinct
            && empty($this->groupBy)
            && empty($this->having)
            && empty($this->union)
            && empty($this->orderBy);
    }

    /**
     * @param int $sort
     *
     * @return $this
     */
    public function orderByPk($sort = SORT_DESC)
    {
        $primaryKey = $this->getPrimaryKeyField();

        return $this->addOrderBy([$this->field($primaryKey) => $sort]);
    }

    /**
     * @return $this
     */
    public function selectPk()
    {
        return $this->select($this->field($this->getPrimaryKeyField()));
    }

    /**
     *
     * @return string
     */
    protected function getUniqParamName()
    {
        return ':alias' . self::$paramCounter++;
    }
}