<?php

/**
 * This is the model class for table "{{tags}}".
 *
 * The followings are the available columns in table '{{tags}}':
 * @property integer $tag_link_id
 * @property string $tag_lang
 * @property string $tag_date
 * @property string $tag_words
 */
class Tags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tags the static model class
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
		return '{{tags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_date', 'required'),
			array('tag_link_id', 'numerical', 'integerOnly'=>true),
			array('tag_lang', 'length', 'max'=>4),
			array('tag_words', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tag_link_id, tag_lang, tag_date, tag_words', 'safe', 'on'=>'search'),
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
			'tag_link_id' => 'Tag Link',
			'tag_lang' => 'Tag Lang',
			'tag_date' => 'Tag Date',
			'tag_words' => 'Tag Words',
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

		$criteria->compare('tag_link_id',$this->tag_link_id);
		$criteria->compare('tag_lang',$this->tag_lang,true);
		$criteria->compare('tag_date',$this->tag_date,true);
		$criteria->compare('tag_words',$this->tag_words,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}