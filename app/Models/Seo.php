<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{


    use HasFactory;
    protected $fillable = ['name', 'usage_count', 'subcategory_id'];
    protected $table = 'seo';



     /**
     * Define the relationship with the Subcategory model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    /**
     * Scope to order results based on name, subcategory, and usage count.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByPriority($query)
    {
        return $query->with('subcategory')
            ->orderBy('name', 'asc')
            ->orderBy('subcategories.name', 'asc') // Assuming the subcategories table has a 'name' column
            ->orderBy('usage_count', 'desc');
    }

    /**
     * Set the priority of the SEO record.
     *
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->update(['usage_count' => $priority]);
        return $this;
    }
}
