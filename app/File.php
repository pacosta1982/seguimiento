<?php

// File.php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class File extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
      'title',
      'overview',
      'price'
    ];

    protected $auditInclude = [
      'title',
      'file_path',
  ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}