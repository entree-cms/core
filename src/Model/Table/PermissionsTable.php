<?php
declare(strict_types=1);

namespace EntreeCore\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use EntreeCore\ORM\Table;

/**
 * Permissions Model
 *
 * @property \EntreeCore\Model\Table\PermissionCategoriesTable&\Cake\ORM\Association\BelongsTo $PermissionCategories
 * @property \EntreeCore\Model\Table\RolesTable&\Cake\ORM\Association\BelongsToMany $Roles
 * @method \EntreeCore\Model\Entity\Permission newEmptyEntity()
 * @method \EntreeCore\Model\Entity\Permission newEntity(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Permission[] newEntities(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Permission get($primaryKey, $options = [])
 * @method \EntreeCore\Model\Entity\Permission findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \EntreeCore\Model\Entity\Permission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Permission[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\Permission|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\Permission saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\Permission[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\Permission[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\Permission[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\Permission[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @method \Cake\ORM\Query findByPermissionCategoryId($id)
 * @method \Cake\ORM\Query findDetailById($id)
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TranslateBehavior
 */
class PermissionsTable extends Table
{
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

        $this->setTable('permissions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PermissionCategories', [
            'foreignKey' => 'permission_category_id',
            'joinType' => 'INNER',
            'className' => 'EntreeCore.PermissionCategories',
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'permission_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'permissions_roles',
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
            ->notEmptyString('permission_category_id');

        $validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

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
        $rules->add(
            $rules->existsIn('permission_category_id', 'PermissionCategories'),
            ['errorField' => 'permission_category_id']
        );

        return $rules;
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

        return $query;
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
        return $query->where(['Permissions.deleted IS' => null]);
    }
}
