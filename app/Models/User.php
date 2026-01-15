<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'username',
        'password',
        'role_id', // link to role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ---------- Role Relationship ----------
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Check if user has a specific role
    public function hasRole($roleName): bool
    {
        return $this->role && $this->role->role_name === $roleName;
    }

    // Assign a role to user
    public function assignRole($roleName)
    {
        $role = Role::where('role_name', $roleName)->firstOrFail();
        $this->role_id = $role->id;
        $this->save();
    }

    // Remove role
    public function removeRole()
    {
        $this->role_id = null;
        $this->save();
    }

    // ---------- Task Relationships ----------
    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }
}
