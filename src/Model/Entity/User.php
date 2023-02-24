<?php
declare(strict_types=1);

namespace EntreeCore\Model\Entity;

use Authentication\IdentityInterface as AuthenticationIdentity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authorization\IdentityInterface as AuthorizationIdentity;
use Cake\Core\Configure;
use Cake\Http\Exception\InternalErrorException;
use Cake\ORM\Entity;
use Cake\Routing\Router;
use EntreeCore\Model\EntityTrait\AuthenticationEntityTrait;
use EntreeCore\Model\EntityTrait\AuthorizationEntityTrait;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $nickname
 * @property string|null $email
 * @property string|null $avatar
 * @property string|null $locale
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property string|null $avatar_path
 * @property string|null $full_name
 */
class User extends Entity implements AuthenticationIdentity, AuthorizationIdentity
{
    use AuthenticationEntityTrait;
    use AuthorizationEntityTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'nickname' => true,
        'email' => true,
        'avatar' => true,
        'avatar_file' => true,
        'locale' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    // *********************************************************
    // * Virtual fields
    // *********************************************************

    /**
     * Get avatar file path (full)
     *
     * @return ?string
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    protected function _getAvatarPath(): ?string
    {
        $fileName = $this->avatar;
        if ($fileName === null) {
            return null;
        }

        $dir = Configure::read('Entree.paths.avatars');
        if (!is_string($dir)) {
            throw new InternalErrorException();
        }
        if (substr($dir, -1) === DS) {
            $dir = substr($dir, 0 - 1);
        }

        return $dir . DS . $fileName;
    }

    /**
     * Get avatar url
     *
     * @return ?string
     */
    protected function _getAvatarUrl(): ?string
    {
        $fileName = $this->avatar;
        if ($fileName === null) {
            return null;
        }

        return Router::url([
            'plugin' => 'EntreeCore',
            'prefix' => '',
            'controller' => 'Users',
            'action' => 'avatar',
            $fileName,
        ]);
    }

    /**
     * Get full name
     *
     * @return ?string
     */
    protected function _getFullName(): ?string
    {
        $order = Configure::read('Entree.personalNameOrder');
        $names = [];
        foreach ($order as $namePrefix) {
            $field = "{$namePrefix}_name";
            $name = $this->{$field};
            if (is_string($name) && $name !== '') {
                $names[] = $name;
            }
        }

        if (count($names) === 0) {
            return null;
        }

        return implode(' ', $names);
    }

    /**
     * Get display name
     *
     * @return string
     */
    protected function _getName(): ?string
    {
        if (is_string($this->nickname) && $this->nickname !== '') {
            return $this->nickname;
        }

        $fullName = $this->full_name;
        if (is_string($fullName) && $fullName !== '') {
            return $fullName;
        }

        return $this->username;
    }

    /**
     * Get role names
     *
     * @return array|null
     */
    protected function _getRoleNames(): ?array
    {
        if (!isset($this->roles)) {
            return null;
        }

        $names = [];
        foreach ($this->roles as $role) {
            $names[] = $role->name;
        }

        return $names;
    }

    // *********************************************************
    // * Mutators
    // *********************************************************

    /**
     * Password (Hash)
     *
     * @param string $password The password
     * @return string|null
     */
    protected function _setPassword(string $password): ?string
    {
        if (is_string($password) && strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }

        return null;
    }
}
