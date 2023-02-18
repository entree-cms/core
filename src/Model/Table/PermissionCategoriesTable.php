<?php
declare(strict_types=1);

namespace EntreeCore\Model\Table;

use Cake\ORM\Query;
use Cake\Validation\Validator;
use EntreeCore\ORM\Table;

/**
 * PermissionCategories Model
 *
 * @property \EntreeCore\Model\Table\PermissionsTable&\Cake\ORM\Association\HasMany $Permissions
 * @method \EntreeCore\Model\Entity\PermissionCategory newEmptyEntity()
 * @method \EntreeCore\Model\Entity\PermissionCategory newEntity(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory[] newEntities(array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory get($primaryKey, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \EntreeCore\Model\Entity\PermissionCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @method \Cake\ORM\Query findDetailById($id)
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TranslateBehavior
 */
class PermissionCategoriesTable extends Table
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

        $this->setTable('permission_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Permissions', [
            'foreignKey' => 'permission_category_id',
            'className' => 'EntreeCore.Permissions',
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
        return $query->where(['deleted IS' => null]);
    }
}
