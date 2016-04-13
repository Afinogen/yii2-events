<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property EventHasType[] $eventHasTypes
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventHasTypes()
    {
        return $this->hasMany(EventHasType::className(), ['type_id' => 'id']);
    }
}
