<?php

namespace App\Modules\Admins\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Admins\Observers\AdminObserver;
use App\Modules\Admins\Traits\AdminScopesTrait;
use App\Modules\Admins\Traits\AdminRelationshipsTrait;
use App\Modules\Admins\Traits\AdminAttributesTrait;
use App\Modules\Admins\Database\factories\AdminFactory;
use App\Modules\Admins\Filters\GenderFilter;
use App\Modules\admins\Filters\StatusFilter;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tur1\modules\Models\Authenticatable;

class Avatar extends Authenticatable {}
