<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Item extends Model
    {
        protected $fillable = [
            'name', 'brand', 'picture', 'serialnumber', 'status', 'item_group_id'
        ];
    
        public function itemGroup()
        {
            return $this->belongsTo(ItemGroup::class);
        }
    }
    
    