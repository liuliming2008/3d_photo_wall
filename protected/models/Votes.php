<?php

/**
 * This is the model class for table "{{votes}}".
 *
 * The followings are the available columns in table '{{votes}}':
 * @property integer $vote_id
 * @property string $vote_type
 * @property string $vote_date
 * @property integer $vote_link_id
 * @property integer $vote_user_id
 * @property integer $vote_value
 * @property integer $vote_karma
 * @property string $vote_ip
 */
class Votes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Votes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{votes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vote_date', 'required'),
			array('vote_link_id, vote_user_id, vote_value, vote_karma', 'numerical', 'integerOnly'=>true),
			array('vote_type', 'length', 'max'=>8),
			array('vote_ip', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('vote_id, vote_type, vote_date, vote_link_id, vote_user_id, vote_value, vote_karma, vote_ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'vote_id' => 'Vote',
			'vote_type' => 'Vote Type',
			'vote_date' => 'Vote Date',
			'vote_link_id' => 'Vote Link',
			'vote_user_id' => 'Vote User',
			'vote_value' => 'Vote Value',
			'vote_karma' => 'Vote Karma',
			'vote_ip' => 'Vote Ip',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('vote_id',$this->vote_id);
		$criteria->compare('vote_type',$this->vote_type,true);
		$criteria->compare('vote_date',$this->vote_date,true);
		$criteria->compare('vote_link_id',$this->vote_link_id);
		$criteria->compare('vote_user_id',$this->vote_user_id);
		$criteria->compare('vote_value',$this->vote_value);
		$criteria->compare('vote_karma',$this->vote_karma);
		$criteria->compare('vote_ip',$this->vote_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}