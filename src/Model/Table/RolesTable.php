<?php
declare(strict_types=1);

namespace EntreeCore\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use EntreeCore\Model\Entity\Role;
use EntreeCore\ORM\Table;

/**
 * Roles Model
 *
 * @property \EntreeCore\Model\Table\PermissionsTable&\Cake\ORM\Association\BelongsToMany $Permissions
 * @property \EntreeCore\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 * @method \EntreeCore\Model\Entity\Role newEmptyEntity()
 * @method \EntreeCore\Model\Entity\Role newEntity(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Role get($primaryKey, $options = [])
 * @method \EntreeCore\Model\Entity\Role findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \EntreeCore\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Role[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Role|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\Role saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @method \Cake\ORM\Query findDetailById($id)
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TranslateBehavior
 */
class RolesTable extends Table
{
    public const ADMIN = 1;
    public const MANAGER = 2;
    public const MEMBER = 3;

    /**
     * @var array Privileged role IDs
     */
    public static $privilegedIds = [
        self::ADMIN,
    ];

    /**
     * @var array Fields to translate
     */
    public static $translationFields = ['name', 'description'];

    /**
     * initialize callback
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Permissions', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'permission_id',
            'joinTable' => 'permissions_roles',
            'className' => 'EntreeCore.Permissions',
            'saveStrategy' => 'replace',
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'roles_users',
            'className' => 'EntreeCore.Users',
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
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmptyString('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        return $validator;
    }

    /**
     * Validation rules for translation.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationTranslated(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

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
        $rules->add($rules->isUnique(['code']), ['errorField' => 'code']);

        return $rules;
    }

    /**
     * beforeSave callback
     *
     * @param \Cake\Event\Event $event The event
     * @param \EntreeCore\Model\Entity\Role $role The Role
     * @param \ArrayObject $options The options
     * @return void
     */
    public function beforeSave(Event $event, Role $role, ArrayObject $options)
    {
        if ($role->isDirty('permissions') && $role->is_privileged) {
            $role->permissions = [];
        }
    }

    // *********************************************************
    // * Custom finders
    // *********************************************************

    /**
     * Find detail
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options The options
     * @return \Cake\ORM\Query
     */
    public function findDetail(Query $query, array $options): Query
    {
        if ($this->isTranslationEnabled()) {
            $query->find('translations');
        }

        return $query->contain('Permissions');
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
        return $query->where(['Roles.deleted IS' => null]);
    }
}
