<?php
declare(strict_types=1);

namespace EntreeCore\Model\Table;

use ArrayObject;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Http\Exception\InternalErrorException;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use EntreeCore\Model\Entity\User;
use EntreeCore\ORM\Table;

/**
 * Users Model
 *
 * @method \EntreeCore\Model\Entity\User newEmptyEntity()
 * @method \EntreeCore\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\User get($primaryKey, $options = [])
 * @method \EntreeCore\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \EntreeCore\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Allowed mime types of avatar file
     *
     * @var array<string>
     */
    protected $avatarMimeTypes = [
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'bmp' => 'image/bmp',
    ];

    /**
     * initialize callback
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('EntreeCore.Nullable');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Roles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'roles_users',
            'className' => 'EntreeCore.Roles',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        $validator
            ->scalar('nickname')
            ->maxLength('nickname', 255)
            ->allowEmptyString('nickname');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('avatar')
            ->maxLength('avatar', 255)
            ->allowEmptyString('avatar');

        $validator
            ->allowEmptyFile('avatar_file')
            ->add('avatar_file', 'mimetype', [
                'rule' => ['mimeType', $this->avatarMimeTypes],
            ]);

        $validator
            ->scalar('locale')
            ->maxLength('locale', 255)
            ->allowEmptyString('locale');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->validCount('roles', 0, '>', __d('cake', 'This field cannot be left empty')));

        return $rules;
    }

    /**
     * afterSave callback
     *
     * @param \Cake\Event\Event $event The event
     * @param \EntreeCore\Model\Entity\User $user The user
     * @param \ArrayObject $options The options
     * @return void
     */
    public function afterSaveCommit(Event $event, User $user, ArrayObject $options)
    {
        // Delete old avatar file
        if ($user->isDirty('avatar')) {
            $tmpUser = clone $user;
            $tmpUser->avatar = $user->getOriginal('avatar');
            $filePath = $tmpUser->avatar_path;
            if ($filePath && file_exists($filePath)) {
                unlink($filePath);
            }
            unset($tmpUser);
        }
    }

    /**
     * beforeMarshal callback
     *
     * @param \Cake\Event\Event $event The event
     * @param \ArrayObject $data The data
     * @param \ArrayObject $options The options
     * @return void
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        $password = $data['password'] ?? null;
        if (is_string($password)) {
            $password = trim($data['password']);
            if ($password === '') {
                unset($data['password']);
            }
        }

        $noAvatar = $data['no_avatar'] ?? null;
        if ($noAvatar === '1') {
            $data['avatar'] = null;
            unset($data['no_avatar']);
        }
    }

    /**
     * beforeSave callback
     *
     * @param \Cake\Event\Event $event The event
     * @param \EntreeCore\Model\Entity\User $user The user
     * @param \ArrayObject $options The options
     * @return void
     */
    public function beforeSave(Event $event, User $user, ArrayObject $options)
    {
        $avatarFile = $user->avatar_file ?? null;
        if ($avatarFile && $avatarFile->getError() === UPLOAD_ERR_OK) {
            $mime = $avatarFile->getClientMediaType();
            $user->avatar = $this->makeAvatarFilePath($user, $mime);
            $avatarFile->moveTo($user->avatar_path);
        }
    }

    // *********************************************************
    // * Custom finders
    // *********************************************************

    /**
     * For authentication
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options The options
     * @return \Cake\ORM\Query
     */
    public function findAuthentication(Query $query, array $options): Query
    {
        return $query->find('notDeleted')
            ->contain(['Roles' => ['Permissions'],]);
    }

    /**
     * Find not deleted
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options The options
     * @return \Cake\ORM\Query
     */
    public function findNotDeleted(Query $query, array $options): Query
    {
        return $query->where(['Users.deleted IS' => null]);
    }

    // *********************************************************
    // * User-defined functions
    // *********************************************************

    /**
     * Get extention from mime type
     *
     * @param string $mime The mime type
     * @return string|false
     */
    protected function getExtention($mime)
    {
        $ext = array_search($mime, $this->avatarMimeTypes);
        if (!is_string($ext)) {
            return false;
        }

        return $ext;
    }

    /**
     * Make avatar file path
     *
     * @param \EntreeCore\Model\Entity\User $user The user
     * @param string $mime Mime type of the avatar file
     * @return string
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    protected function makeAvatarFilePath($user, $mime): string
    {
        $ext = $this->getExtention($mime);
        if ($ext === false) {
            throw new InternalErrorException();
        }

        $dir = Configure::read('Entree.paths.avatars');
        if (!is_string($dir)) {
            throw new InternalErrorException();
        }
        if (substr($dir, -1) === DS) {
            $dir = substr($dir, 0, -1);
        }

        $fileName = null;
        $limit = 10;
        while ($fileName === null && $limit > 0) {
            $uuid = Text::uuid();
            $fileName = $uuid . '.' . $ext;
            if (file_exists($dir . DS . $fileName)) {
                $fileName = null;
            }
            $limit -= 1;
        }

        if ($fileName === null) {
            throw new InternalErrorException();
        }

        return $fileName;
    }
}
