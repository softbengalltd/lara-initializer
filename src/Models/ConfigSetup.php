<?php
namespace Softbengal\LaraInitializer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigSetup extends Model
{
    use HasFactory;

    protected $fillable=['name','value'];
}
