<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $nama
 * @property string $alamat
 * @property string $tgl_lahir
 * @property string $email
 * @property string $no_telp
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $password;
	public $password_repeat;
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('username', 'required'),
                array('username', 'unique'),
                array('username', 'length', 'min'=>3, 'max'=>40),
                array('password, password_repeat', 'required', 'on' => 'passwordset'),
                array('password', 'length', 'min'=>8, 'max'=>40, 'on' => 'passwordset'),
                array('password', 'compare', 'compareAttribute' => 'password_repeat'),
                array('username, password, password_repeat', 'safe'),
                array('level', 'numerical', 'integerOnly'=>true),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('username, level', 'safe', 'on'=>'search'),
            );

		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('id, username, password, nama, alamat, tgl_lahir, email, no_telp', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('username, password, nama, email', 'length', 'max'=>225),
			array('no_telp', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, nama, alamat, tgl_lahir, email, no_telp', 'safe', 'on'=>'search'),
		);*/
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
    public function hashPassword($phrase)
    {
        return hash('md5',$phrase);
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'password_repeat' => 'Password Repeat',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'tgl_lahir' => 'Tgl Lahir',
            'email' => 'Email',
            'no_telp' => 'No Telp',
        );

	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('no_telp',$this->no_telp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
