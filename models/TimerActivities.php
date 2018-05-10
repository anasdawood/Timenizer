<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timer_activities".
 *
 * @property int $id
 * @property string $activity_description
 * @property string $activity_time
 */
class TimerActivities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timer_activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_time'], 'safe'],
            [['activity_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_description' => 'Activity Description',
            'activity_time' => 'Activity Time',
        ];
    }
}
