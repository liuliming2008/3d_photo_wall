<?php

/**
 * This is the model class for table "{{files}}".
 *
 * The followings are the available columns in table '{{files}}':
 * @property integer $file_id
 * @property string $file_name
 * @property string $file_size
 * @property integer $file_user_id
 * @property integer $file_link_id
 * @property integer $file_orig_id
 * @property integer $file_real_size
 * @property integer $file_number
 * @property integer $file_ispicture
 * @property string $file_fields
 * @property integer $file_hide_thumb
 * @property integer $file_hide_file
 */
class File extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Files the static model class
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
		return '{{files}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_user_id, file_link_id, file_real_size, file_ispicture', 'required'),
			array('file_user_id, file_link_id, file_orig_id, file_real_size, file_number, file_ispicture, file_hide_thumb, file_hide_file', 'numerical', 'integerOnly'=>true),
			array('file_name', 'length', 'max'=>255),
			array('file_size', 'length', 'max'=>20),
			array('file_fields', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('file_id, file_name, file_size, file_user_id, file_link_id, file_orig_id, file_real_size, file_number, file_ispicture, file_fields, file_hide_thumb, file_hide_file', 'safe', 'on'=>'search'),
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
			'file_id' => 'File',
			'file_name' => 'File Name',
			'file_size' => 'File Size',
			'file_user_id' => 'File User',
			'file_link_id' => 'File Link',
			'file_orig_id' => 'File Orig',
			'file_real_size' => 'File Real Size',
			'file_number' => 'File Number',
			'file_ispicture' => 'File Ispicture',
			'file_fields' => 'File Fields',
			'file_hide_thumb' => 'File Hide Thumb',
			'file_hide_file' => 'File Hide File',
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

		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_size',$this->file_size,true);
		$criteria->compare('file_user_id',$this->file_user_id);
		$criteria->compare('file_link_id',$this->file_link_id);
		$criteria->compare('file_orig_id',$this->file_orig_id);
		$criteria->compare('file_real_size',$this->file_real_size);
		$criteria->compare('file_number',$this->file_number);
		$criteria->compare('file_ispicture',$this->file_ispicture);
		$criteria->compare('file_fields',$this->file_fields,true);
		$criteria->compare('file_hide_thumb',$this->file_hide_thumb);
		$criteria->compare('file_hide_file',$this->file_hide_file);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}