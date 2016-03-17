<?php

namespace frontend\modules\schoolmate\models;

/**
 * This is the ActiveQuery class for [[Schoolmate]].
 *
 * @see Schoolmate
 */
class SchoolmateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Schoolmate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Schoolmate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}