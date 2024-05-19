<?php
namespace App\Traits;

trait HasActiveStatus
{
    public function getStatusBadgeAttribute()
    {
        return $this->is_active ? '<span class="badge bg-blue text-blue-fg">'.$this->status_string.'</span>' : '<span class="badge bg-danger text-danger-fg">'.$this->status_string.'</span>';
    }

    public function getStatusStringAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }
}

