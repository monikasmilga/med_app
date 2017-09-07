<?php namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoreModel extends Model {

	public $incrementing = false;

	use SoftDeletes;

	use UuidTrait;
}
